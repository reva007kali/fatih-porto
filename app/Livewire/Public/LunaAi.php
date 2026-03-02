<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\LunaSession;
use App\Models\AiSetting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use OpenAI;
use Illuminate\Support\Str;

class LunaAi extends Component
{
    public $messages = [];
    public $userInput = '';
    public $sessionId;
    public $isThinking = false;

    public function mount()
    {
        $this->sessionId = Session::getId();
        $this->cleanupOldSessions();
        $this->loadChatHistory();
    }

    public function cleanupOldSessions()
    {
        // Delete sessions older than 24 hours
        LunaSession::where('expires_at', '<', now())->delete();
    }

    public function loadChatHistory()
    {
        $session = LunaSession::where('session_id', $this->sessionId)->first();

        if ($session && !empty($session->messages)) {
            $this->messages = $session->messages;
        } else {
            // Initial greeting
            $this->messages = [
                [
                    'role' => 'assistant',
                    'content' => "Hello! I'm Luna AI. How can I help you today? I can write code, draft text, or answer your questions."
                ]
            ];
            $this->saveChatHistory();
        }
    }

    public function saveChatHistory()
    {
        LunaSession::updateOrCreate(
            ['session_id' => $this->sessionId],
            [
                'ip_address' => Request::ip(),
                'messages' => $this->messages,
                'expires_at' => now()->addHours(24)
            ]
        );
    }

    public function sendMessage()
    {
        if (empty(trim($this->userInput))) {
            return;
        }

        // Add user message
        $this->messages[] = ['role' => 'user', 'content' => $this->userInput];
        $this->userInput = '';
        $this->isThinking = true;
        $this->saveChatHistory();
        $this->dispatch('scroll-to-bottom');

        // Trigger AI processing in next request
        $this->dispatch('process-ai-response');
    }

    #[On('process-ai-response')] 
    public function processAI()
    {
        try {
            $apiKey = config('services.openai.key');
            if (empty($apiKey)) {
                throw new \Exception("OpenAI API Key is missing.");
            }

            $client = OpenAI::client($apiKey);
            
            // Get settings or defaults
            $settings = AiSetting::first();
            $model = $settings?->model ?? 'gpt-4o-mini';
            $temperature = 0.7; // Standard creative but focused
            $maxTokens = 4000; // Allow long responses for code

            $systemPrompt = "You are Luna AI, an advanced AI assistant created by Revaldy Adhitya. 
            You are helpful, intelligent, and creative. 
            You can generate code, write text, analyze data, and assist with various tasks. 
            You DO NOT generate images or videos. 
            Your responses should be clear, accurate, and formatted using Markdown. 
            When writing code, ALWAYS use code blocks with language identifiers (e.g., ```php ... ```).
            Be concise but thorough.";

            $response = $client->chat()->create([
                'model' => $model,
                'messages' => array_merge(
                    [['role' => 'system', 'content' => $systemPrompt]],
                    array_slice($this->messages, -10) // Keep context manageable
                ),
                'temperature' => $temperature,
                'max_tokens' => $maxTokens,
            ]);

            $aiContent = $response->choices[0]->message->content;

            $this->messages[] = ['role' => 'assistant', 'content' => $aiContent];
            $this->saveChatHistory();

        } catch (\Exception $e) {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => "I apologize, but I encountered an error processing your request. Please try again later. Error: " . $e->getMessage()
            ];
            $this->saveChatHistory();
        }

        $this->isThinking = false;
        $this->dispatch('scroll-to-bottom');
    }

    public function clearChat()
    {
        $this->messages = [
            [
                'role' => 'assistant',
                'content' => "Chat history cleared. How can I help you now?"
            ]
        ];
        $this->saveChatHistory();
        $this->dispatch('scroll-to-bottom');
    }

    public function render()
    {
        return view('livewire.public.luna-ai')->layout('layouts.luna');
    }
}
