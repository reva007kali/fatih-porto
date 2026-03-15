<?php

namespace App\Livewire\Admin;

use App\Models\WebsiteSetting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class WebsiteSettings extends Component
{
    use WithFileUploads;

    public $site_name;
    public $favicon;
    public $logo;
    public $meta_description;

    public $existing_favicon;
    public $existing_logo;

    public function mount()
    {
        $settings = WebsiteSetting::first();
        if ($settings) {
            $this->site_name = $settings->site_name;
            $this->meta_description = $settings->meta_description;
            $this->existing_favicon = $settings->favicon;
            $this->existing_logo = $settings->logo;
        }
    }

    public function save()
    {
        $this->validate([
            'site_name' => 'nullable|string|max:255',
            'favicon' => 'nullable|image|max:1024', // 1MB Max
            'logo' => 'nullable|image|max:2048', // 2MB Max
            'meta_description' => 'nullable|string',
        ]);

        $settings = WebsiteSetting::firstOrNew();

        $settings->site_name = $this->site_name;
        $settings->meta_description = $this->meta_description;

        if ($this->favicon) {
            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $settings->favicon = $this->favicon->store('favicons', 'public');
        }

        if ($this->logo) {
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $settings->logo = $this->logo->store('logos', 'public');
        }

        $settings->save();

        // Update existing values to show the new images
        $this->existing_favicon = $settings->favicon;
        $this->existing_logo = $settings->logo;

        // Reset file inputs
        $this->favicon = null;
        $this->logo = null;

        session()->flash('message', 'Website settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.website-settings');
    }
}
