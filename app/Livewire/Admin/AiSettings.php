<?php

namespace App\Livewire\Admin;

use App\Models\AiSetting;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class AiSettings extends Component
{
    public $assistant_name;
    public $system_prompt;
    public $behavior_description;
    public $temperature = 0.70;
    public $max_tokens = 2048;
    public $is_active = true;
    public $model = 'gpt-4o-mini';

    public $available_models = [
        'gpt-4o' => 'GPT-4o (Most Intelligent, Fast)',
        'gpt-4o-mini' => 'GPT-4o Mini (Cost Effective, Fast)',
        'gpt-4-turbo' => 'GPT-4 Turbo (Legacy High Intelligence)',
        'gpt-4' => 'GPT-4 (Legacy)',
        'gpt-3.5-turbo' => 'GPT-3.5 Turbo (Legacy Fast)',
    ];

    public function mount()
    {
        $settings = AiSetting::first();
        if ($settings) {
            $this->assistant_name = $settings->assistant_name;
            $this->system_prompt = $settings->system_prompt;
            $this->behavior_description = $settings->behavior_description;
            $this->temperature = $settings->temperature;
            $this->max_tokens = $settings->max_tokens;
            $this->is_active = $settings->is_active;
            $this->model = $settings->model ?? 'gpt-4o-mini';
        } else {
            // Defaults
            $this->assistant_name = 'Reva AI';
            $this->system_prompt = "You are a helpful AI assistant for Reva Adhitya's portfolio website. You are knowledgeable about web development, design, and Reva's work.";
            $this->temperature = 0.70;
            $this->max_tokens = 2048;
            $this->is_active = true;
            $this->model = 'gpt-4o-mini';
        }
    }

    public function save()
    {
        $this->validate([
            'assistant_name' => 'required|string|max:255',
            'system_prompt' => 'required|string',
            'behavior_description' => 'nullable|string',
            'temperature' => 'required|numeric|min:0|max:2',
            'max_tokens' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'model' => 'required|string',
        ]);

        $settings = AiSetting::first();

        $data = [
            'assistant_name' => $this->assistant_name,
            'system_prompt' => $this->system_prompt,
            'behavior_description' => $this->behavior_description,
            'temperature' => $this->temperature,
            'max_tokens' => $this->max_tokens,
            'is_active' => $this->is_active,
            'model' => $this->model,
        ];

        if ($settings) {
            $settings->update($data);
        } else {
            AiSetting::create($data);
        }

        session()->flash('message', 'AI Settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.ai-settings');
    }
}
