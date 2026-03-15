<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\AboutSection;
use App\Models\Project;
use App\Models\Service;
use App\Models\PricingPlan;
use App\Models\Lead;
use App\Models\Website;
use App\Models\ChatSession;
use App\Models\AiSetting;
use OpenAI;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewLeadNotification;

class ChatBot extends Component
{
    public $isOpen = false;
    public $userInput = '';
    public $messages = [];
    public $maxHistory = 15; // Sedikit lebih panjang untuk konteks yang lebih baik
    public $sessionId;
    public $assistantName = 'Reva AI'; // Default name

    // FORM STATES
    public $showLeadForm = false;
    public $leadForm = [
        'name' => '',
        'contact' => '',
        'budget' => '',
        'description' => '',
    ];

    public function mount()
    {
        $this->sessionId = Session::getId();

        $settings = AiSetting::first();
        if ($settings) {
            $this->assistantName = $settings->assistant_name;
        }

        $this->loadChatHistory();
    }

    public function submitLeadForm()
    {
        $this->validate([
            'leadForm.name' => 'required|string|min:2',
            'leadForm.contact' => 'required|string|min:8',
            'leadForm.description' => 'required|string|min:10',
            'leadForm.budget' => 'required|string',
        ]);

        $result = $this->handleCaptureLead($this->leadForm);

        $this->showLeadForm = false;
        $this->messages[] = [
            'role' => 'assistant',
            'content' => 'Terima kasih! Datamu sudah aku simpan. Reva akan segera menghubungi kamu via WhatsApp/Email ya! 👌'
        ];
        $this->saveChatHistory();

        // Reset form
        $this->leadForm = ['name' => '', 'contact' => '', 'budget' => '', 'description' => ''];
    }

    public function triggerLeadForm()
    {
        $this->showLeadForm = true;
        $this->dispatch('scroll-to-bottom');
    }

    private function loadChatHistory()
    {
        $chatSession = ChatSession::where('session_id', $this->sessionId)->first();

        if ($chatSession && !empty($chatSession->messages)) {
            $this->messages = $chatSession->messages;
        } else {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => "Halo! Saya {$this->assistantName}. Ada yang bisa saya bantu mengenai pembuatan website, katalog contoh, atau estimasi biaya?"
            ];
            $this->saveChatHistory();
        }
    }

    private function saveChatHistory()
    {
        ChatSession::updateOrCreate(
            ['session_id' => $this->sessionId],
            [
                'ip_address' => Request::ip(),
                'messages' => $this->messages
            ]
        );
    }

    // HANDLERS (LOGIC)
    private function handleGetWebsiteExamples($tag = null, $color = null)
    {
        $q = Website::query();
        if ($tag)
            $q->where('tags', 'like', "%$tag%")->orWhere('description', 'like', "%$tag%");
        if ($color)
            $q->where('color', 'like', "%$color%");
        return $q->limit(3)->get(['title', 'description', 'tags', 'color'])->toJson();
    }

    private function handleGetPortfolio($keyword = null)
    {
        return Project::when($keyword, fn($q) => $q->where('title', 'like', "%$keyword%"))
            ->limit(3)->get(['title', 'description'])->toJson();
    }

    private function handleGetPricing($type)
    {
        return "Daftar Paket Harga Revaldy: " . PricingPlan::all()->toJson();
    }

    private function handleCaptureLead($data)
    {
        try {
            // Check if contact already exists recently (simple spam prevention)
            $existing = Lead::where('contact', $data['contact'] ?? '')
                ->where('created_at', '>=', now()->subMinutes(10))
                ->first();

            if ($existing)
                return "DATA_ALREADY_EXISTS";

            // Sesuaikan mapping dengan kolom di migration kamu
            $lead = Lead::create([
                'name' => $data['name'] ?? 'Guest',
                'contact' => $data['contact'] ?? 'Unknown',
                'project_type' => 'AI Inquiry',
                'budget_range' => $data['budget'] ?? 'TBD',
                'project_description' => $data['description'] ?? 'No description provided',
                'status' => 'new',
                'ai_notes' => 'Captured via Chat Form'
            ]);

            // Send Email Notification
            try {
                Mail::to('le.revaldy@gmail.com')->send(new NewLeadNotification($lead));
            } catch (\Exception $e) {
                Log::error("Failed to send lead email: " . $e->getMessage());
            }

            return "SUCCESS: Lead berhasil disimpan ke database Revaldy dengan ID #" . $lead->id;
        } catch (\Exception $e) {
            Log::error("Capture Lead Database Error: " . $e->getMessage());
            return "ERROR: Gagal simpan ke database. Pastikan tidak ada kolom timestamps.";
        }
    }

    public function sendMessage()
    {
        if (empty($this->userInput))
            return;
        $this->messages[] = ['role' => 'user', 'content' => $this->userInput];
        $this->saveChatHistory(); // Save user message
        $this->userInput = '';
        $this->processAI();
    }

    private function getTools()
    {
        return [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'get_portfolio',
                    'description' => 'Cari project yang pernah dikerjakan Revaldy untuk meyakinkan user.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'keyword' => ['type' => 'string', 'description' => 'Contoh: landing page, sekolah, fintech']
                        ]
                    ]
                ]
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'get_website_examples',
                    'description' => 'Cari contoh website dari katalog berdasarkan tag atau warna (seperti pink, dark, clean).',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'tag' => ['type' => 'string'],
                            'color' => ['type' => 'string']
                        ]
                    ]
                ]
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'get_pricing_and_estimate',
                    'description' => 'Ambil data harga untuk memberikan estimasi kepada user.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'type' => ['type' => 'string', 'description' => 'Tipe website']
                        ]
                    ]
                ]
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'trigger_lead_form',
                    'description' => 'Tampilkan formulir pemesanan/konsultasi agar user bisa isi data sendiri dengan mudah. Gunakan ini jika user ingin order atau konsultasi.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'dummy' => ['type' => 'string', 'description' => 'Field dummy wajib ada karena OpenAI tidak suka object kosong.']
                        ]
                    ]
                ]
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'capture_lead',
                    'description' => 'DEPRECATED: Gunakan trigger_lead_form saja.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'name' => ['type' => 'string'],
                            'contact' => ['type' => 'string'],
                            'description' => ['type' => 'string'],
                            'budget' => ['type' => 'string']
                        ],
                        'required' => ['description', 'contact']
                    ]
                ]
            ]
        ];
    }

    protected function processAI($retryCount = 0)
    {
        // Safety break
        if ($retryCount > 3) {
            $this->messages[] = ['role' => 'assistant', 'content' => 'Aku sudah catat detailnya, tapi sistem perangkum lagi sibuk. Langsung WA Reva aja ya di 082260894009!'];
            return;
        }

        try {
            $settings = AiSetting::first();

            if ($settings && !$settings->is_active) {
                $this->messages[] = ['role' => 'assistant', 'content' => 'Maaf, saat ini saya sedang istirahat. Silahkan hubungi Reva via WhatsApp ya!'];
                $this->saveChatHistory();
                return;
            }

            $about = AboutSection::first();
            $basePrompt = $settings->system_prompt ?? "Anda adalah AI Sales Consultant Revaldy Adhitya (Web Developer). Gunakan bahasa gaul/kekinian yang sopan (pake 'aku-kamu'). Identitas Reva: Expert Web Developer. WA: 082260894009.";

            // Append context if it's not likely in the custom prompt, or assume custom prompt is complete.
            // But to ensure tools work, we must instruct it to use tools.
            // Let's prepend the dynamic data to ensure the AI knows about Reva's current state.
            $systemPrompt = $basePrompt . "\n\n[CONTEXT DATA]\n" .
                "About Reva: " . ($about?->description ?? 'Expert Web Developer') . "\n" .
                "Tools Instruction: Jika user tertarik memesan, ingin konsultasi serius, atau tanya harga detail: JANGAN tanya data manual satu-satu. PANGGIL fungsi 'trigger_lead_form'.";

            $apiKey = config('services.openai.key');
            if (empty($apiKey)) {
                throw new \Exception("OpenAI API Key is missing.");
            }

            // --- USE OFFICIAL PHP CLIENT ---
            $client = OpenAI::client($apiKey);

            $response = $client->chat()->create([
                'model' => $settings ? $settings->model : 'gpt-4o-mini',
                'messages' => array_merge([['role' => 'system', 'content' => $systemPrompt]], array_slice($this->messages, -$this->maxHistory)),
                'tools' => $this->getTools(),
                'tool_choice' => 'auto',
                'temperature' => $settings ? (float) $settings->temperature : 0.7,
                'max_tokens' => $settings ? (int) $settings->max_tokens : 2048,
            ]);

            $aiMessage = $response->choices[0]->message;

            // --- LOGIC TOOL CALLING ---
            if ($aiMessage->toolCalls) {
                // Convert toolCalls object to array format for history
                $toolCallsArray = [];
                foreach ($aiMessage->toolCalls as $toolCall) {
                    $toolCallsArray[] = [
                        'id' => $toolCall->id,
                        'type' => 'function',
                        'function' => [
                            'name' => $toolCall->function->name,
                            'arguments' => $toolCall->function->arguments
                        ]
                    ];
                }

                // Append AI's intent to call tools to history
                $this->messages[] = [
                    'role' => 'assistant',
                    'content' => null,
                    'tool_calls' => $toolCallsArray
                ];

                foreach ($aiMessage->toolCalls as $tool) {
                    $name = $tool->function->name;
                    $args = json_decode($tool->function->arguments, true);

                    $output = match ($name) {
                        'get_website_examples' => $this->handleGetWebsiteExamples($args['tag'] ?? null, $args['color'] ?? null),
                        'get_portfolio' => $this->handleGetPortfolio($args['keyword'] ?? null),
                        'get_pricing_and_estimate' => $this->handleGetPricing($args['type'] ?? ''),
                        'capture_lead' => $this->handleCaptureLead($args),
                        'trigger_lead_form' => $this->triggerLeadForm() ?? 'Formulir ditampilkan.',
                        default => 'Function not found'
                    };

                    $this->messages[] = [
                        'tool_call_id' => $tool->id,
                        'role' => 'tool',
                        'name' => $name,
                        'content' => $output
                    ];
                }

                // Recursive call
                $this->saveChatHistory(); // Save tool calls
                return $this->processAI($retryCount + 1);
            }

            // --- TEXT RESPONSE ---
            if ($aiMessage->content) {
                $this->messages[] = ['role' => 'assistant', 'content' => $aiMessage->content];
                $this->saveChatHistory(); // Save AI response
            }

        } catch (\Exception $e) {
            Log::error("ChatBot Fatal Error: " . $e->getMessage());
            $this->messages[] = [
                'role' => 'assistant',
                'content' => 'Aduh sorry, koneksi otak AI-ku lagi drop. Chat Reva langsung di WA 082260894009 aja ya, dia fast respon kok! 😊'
            ];
            $this->saveChatHistory(); // Save error message
        }

        $this->dispatch('scroll-to-bottom');
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen)
            $this->dispatch('scroll-to-bottom');
    }

    public function render()
    {
        return view('livewire.chat-bot');
    }
}
