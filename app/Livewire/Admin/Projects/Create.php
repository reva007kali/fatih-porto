<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use App\Models\ProjectMedia;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Traits\HandlesFileUploads;

#[Layout('layouts.app')]
class Create extends Component
{
    use WithFileUploads, HandlesFileUploads;

    public $title;
    public $description;
    public $content;
    public $category;
    public $role;
    public $year;
    public $client;
    public $link;
    public $sort_order = 0;
    public $is_featured = false;
    public $is_archived = false;

    // Cover Image
    public $coverImage;

    // For Quill editor file uploads
    public $quillFile;
    public $quillFileUrl;

    // Multiple file uploads
    public $mediaFiles = []; // Temporary files
    public $captions = []; // Captions for new files

    public function render()
    {
        return view('livewire.admin.projects.create');
    }

    public function updatedQuillFile()
    {
        $this->validate(['quillFile' => 'file|max:51200']); // 50MB Max
        $path = $this->handleFileUpload($this->quillFile, 'quill-uploads');
        $this->quillFileUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($path);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:4',
            'client' => 'nullable|string|max:255',
            'link' => 'nullable|string',
            'sort_order' => 'integer',
            'is_featured' => 'boolean',
            'is_archived' => 'boolean',
            'coverImage' => 'nullable|image|max:10240', // 10MB Max
            'mediaFiles.*' => 'nullable|file|max:51200', // Max 50MB per file
        ]);

        $coverPath = null;
        if ($this->coverImage) {
            $coverPath = $this->handleFileUpload($this->coverImage, 'projects/covers');
        }

        $project = Project::create([
            'title' => $this->title,
            'description' => $this->description,
            'cover_image' => $coverPath,
            'image' => $coverPath, // Keep for backward compatibility or as fallback
            'content' => $this->content,
            'category' => $this->category,
            'role' => $this->role,
            'year' => $this->year,
            'client' => $this->client,
            'link' => $this->link,
            'sort_order' => $this->sort_order,
            'is_featured' => $this->is_featured,
            'is_archived' => $this->is_archived,
        ]);

        foreach ($this->mediaFiles as $index => $file) {
            $path = $this->handleFileUpload($file, 'projects');
            $type = $this->isVideo($file) ? 'video' : 'image';

            // If it's the first file and no cover image was uploaded, set it as the main thumbnail
            if (!$coverPath && $index === 0) {
                $project->update([
                    'image' => $path,
                    'cover_image' => $path
                ]);
            }

            $project->media()->create([
                'file_path' => $path,
                'file_type' => $type,
                'caption' => $this->captions[$index] ?? null,
            ]);
        }

        session()->flash('message', 'Project created successfully.');
        return redirect()->route('admin.projects');
    }
    
    public function cancel()
    {
        return redirect()->route('admin.projects');
    }
}
