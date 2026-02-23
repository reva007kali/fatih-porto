<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use App\Models\ProjectMedia;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Traits\HandlesFileUploads;

#[Layout('layouts.app')]
class Edit extends Component
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
    public $projectId;

    // For Quill editor file uploads
    public $quillFile;

    // Multiple file uploads
    public $mediaFiles = []; // Temporary files
    public $captions = []; // Captions for new files

    // Existing media management
    public $existingMedia = [];

    public function mount($id)
    {
        $project = Project::with('media')->findOrFail($id);
        $this->projectId = $id;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->content = $project->content;
        $this->category = $project->category;
        $this->role = $project->role;
        $this->year = $project->year;
        $this->client = $project->client;
        $this->link = $project->link;
        $this->sort_order = $project->sort_order;
        $this->is_featured = $project->is_featured;
        $this->is_archived = $project->is_archived;
        $this->existingMedia = $project->media;
    }

    public function render()
    {
        return view('livewire.admin.projects.edit');
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

    public function update()
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
            'mediaFiles.*' => 'nullable|file|max:51200',
        ]);

        $project = Project::findOrFail($this->projectId);
        $project->update([
            'title' => $this->title,
            'description' => $this->description,
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

        // Add new media
        foreach ($this->mediaFiles as $index => $file) {
            $path = $this->handleFileUpload($file, 'projects');
            $type = $this->isVideo($file) ? 'video' : 'image';

            $project->media()->create([
                'file_path' => $path,
                'file_type' => $type,
                'caption' => $this->captions[$index] ?? null,
            ]);

            // If project has no main image, set this new file (video or image) as main
            if (!$project->image && $index === 0) {
                 $project->update(['image' => $path]);
            }
        }

        // Update main thumbnail if needed and not set (fallback)
        if (!$project->image && $project->media()->where('file_type', 'image')->exists()) {
            $project->update(['image' => $project->media()->where('file_type', 'image')->first()->file_path]);
        }

        session()->flash('message', 'Project updated successfully.');
        return redirect()->route('admin.projects');
    }

    public function deleteMedia($mediaId)
    {
        $media = ProjectMedia::findOrFail($mediaId);
        
        // Delete file from storage
        if ($media->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($media->file_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($media->file_path);
        }

        // Check if this was the main image for the project
        $project = Project::findOrFail($this->projectId);
        if ($project->image === $media->file_path) {
             $project->update(['image' => null]);
             
             // Try to set another media as main if available
             $nextMedia = $project->media()->where('id', '!=', $mediaId)->first();
             if ($nextMedia) {
                 $project->update(['image' => $nextMedia->file_path]);
             }
        }

        $media->delete();

        // Refresh existing media list
        if ($this->projectId) {
            $this->existingMedia = Project::findOrFail($this->projectId)->media;
        }
    }
    
    public function cancel()
    {
        return redirect()->route('admin.projects');
    }
}