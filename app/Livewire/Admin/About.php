<?php

namespace App\Livewire\Admin;

use App\Models\AboutSection;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Traits\HandlesFileUploads;

#[Layout('layouts.app')]
class About extends Component
{
    use WithFileUploads, HandlesFileUploads;

    public $title;
    public $description;
    public $content;
    public $image;
    public $currentImage;
    public $button_text;
    public $button_link;

    // For Quill editor file uploads
    public $quillFile;

    public function mount()
    {
        $about = AboutSection::first();
        if ($about) {
            $this->title = $about->title;
            $this->description = $about->description;
            $this->content = $about->content;
            $this->currentImage = $about->image;
            $this->button_text = $about->button_text;
            $this->button_link = $about->button_link;
        }
    }

    public function updatedQuillFile()
    {
        $this->validate(['quillFile' => 'file|max:51200']); // 50MB Max
        $path = $this->handleFileUpload($this->quillFile, 'quill-uploads');
        $url = \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        
        $mime = $this->quillFile->getMimeType();
        $type = str_starts_with($mime, 'image') ? 'image' : 'video';

        $this->dispatch('quill-upload-finished', url: $url, type: $type);
    }

    public function save()
    {
        $this->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
        ]);

        $about = AboutSection::first();
        $imagePath = $this->currentImage;

        if ($this->image) {
            $imagePath = $this->handleFileUpload($this->image, 'about');
        }

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'image' => $imagePath,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
        ];

        if ($about) {
            $about->update($data);
        } else {
            AboutSection::create($data);
        }

        // Reset the file input
        $this->image = null;
        $this->currentImage = $imagePath;

        session()->flash('message', 'About section updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.about');
    }
}
