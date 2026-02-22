<?php

namespace App\Livewire\Admin\ThreeD;

use Livewire\Component;

use App\Models\ThreeDModel;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Traits\HandlesFileUploads;

#[Layout('layouts.app')]
class Create extends Component
{
    use WithFileUploads, HandlesFileUploads;

    public $title;
    public $description;
    public $model_file;
    public $thumbnail;
    public $is_active = true;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'model_file' => 'required|file|max:51200', // 50MB max, accept all for now but should be .glb/.gltf
        'thumbnail' => 'nullable|image|max:2048',
        'is_active' => 'boolean',
    ];

    public function store()
    {
        $this->validate();

        // Custom extension check for model
        $ext = strtolower($this->model_file->getClientOriginalExtension());
        if (!in_array($ext, ['glb', 'gltf', 'obj'])) {
            $this->addError('model_file', 'The file must be a .glb, .gltf, or .obj file.');
            return;
        }

        $modelPath = $this->handleFileUpload($this->model_file, '3d-models', 'public');
        
        $thumbnailPath = null;
        if ($this->thumbnail) {
            $thumbnailPath = $this->handleFileUpload($this->thumbnail, '3d-thumbnails', 'public');
        }

        ThreeDModel::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'description' => $this->description,
            'model_path' => $modelPath,
            'thumbnail_path' => $thumbnailPath,
            'is_active' => $this->is_active,
        ]);

        session()->flash('message', '3D Model uploaded successfully.');
        return redirect()->route('admin.three-d.index');
    }

    public function render()
    {
        return view('livewire.admin.three-d.create');
    }
}
