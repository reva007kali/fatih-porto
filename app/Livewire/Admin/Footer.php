<?php

namespace App\Livewire\Admin;

use App\Models\FooterSetting;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Footer extends Component
{
    public $about_text;
    public $copyright_text;
    public $email;
    public $phone;
    public $availability_text;
    public $watermark_text;

    public function mount()
    {
        $setting = FooterSetting::first();

        if ($setting) {
            $this->about_text = $setting->about_text;
            $this->copyright_text = $setting->copyright_text;
            
            $details = is_array($setting->social_links) ? $setting->social_links : [];

            $this->email = $details['email'] ?? '';
            $this->phone = $details['phone'] ?? '';
            $this->availability_text = $details['availability_text'] ?? '';
            $this->watermark_text = $details['watermark_text'] ?? '';
        }
    }

    public function save()
    {
        $this->validate([
            'about_text' => 'nullable|string|max:255',
            'copyright_text' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'availability_text' => 'nullable|string|max:255',
            'watermark_text' => 'nullable|string|max:255',
        ]);

        $setting = FooterSetting::firstOrCreate([]);

        $details = is_array($setting->social_links) ? $setting->social_links : [];
        $details['email'] = $this->email;
        $details['phone'] = $this->phone;
        $details['availability_text'] = $this->availability_text;
        $details['watermark_text'] = $this->watermark_text;

        $setting->update([
            'about_text' => $this->about_text,
            'copyright_text' => $this->copyright_text,
            'social_links' => $details,
        ]);

        session()->flash('message', 'Footer settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.footer');
    }
}