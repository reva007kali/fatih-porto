<?php

namespace App\Livewire\Public;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class Gallery extends Component
{
    public $media = [];

    public $sortField = 'date';

    public $sortDirection = 'desc';

    public $filter = 'all'; // all, image, video

    // Modal State
    public $selectedMedia = null;

    public function mount()
    {
        $this->loadMedia();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->loadMedia();
    }

    public function setFilter($type)
    {
        $this->filter = $type;
        $this->loadMedia();
    }

    public function openMedia($item)
    {
        $this->selectedMedia = $item;
    }

    public function closeModal()
    {
        $this->selectedMedia = null;
    }

    public function loadMedia()
    {
        if (! Storage::disk('public')->exists('gallery')) {
            Storage::disk('public')->makeDirectory('gallery');
        }

        $files = Storage::disk('public')->files('gallery');
        $allMedia = [];

        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
            $isVideo = in_array($ext, ['mp4', 'webm', 'ogg', 'mov']);

            $type = null;
            if ($isImage) {
                $type = 'image';
            }
            if ($isVideo) {
                $type = 'video';
            }

            if ($type) {
                // Apply Filter
                if ($this->filter !== 'all' && $this->filter !== $type) {
                    continue;
                }

                $allMedia[] = [
                    'path' => $file,
                    'url' => Storage::url($file),
                    'type' => $type,
                    'name' => basename($file),
                    'size' => Storage::disk('public')->size($file),
                    'date' => Storage::disk('public')->lastModified($file),
                ];
            }
        }

        // Sorting
        usort($allMedia, function ($a, $b) {
            $valA = $a[$this->sortField];
            $valB = $b[$this->sortField];

            if ($valA == $valB) {
                return 0;
            }

            if ($this->sortDirection === 'asc') {
                return $valA < $valB ? -1 : 1;
            } else {
                return $valA > $valB ? -1 : 1;
            }
        });

        $this->media = $allMedia;
    }

    public function render()
    {
        return view('livewire.public.gallery');
    }
}
