<?php

namespace App\Livewire\Admin\ThreeD;

use Livewire\Component;

use App\Models\ThreeDModel;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Traits\HandlesFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class Edit extends Component
{
    use WithFileUploads, HandlesFileUploads;

    public ThreeDModel $model;
    public $title;
    public $description;
    public $model_file;
    public $thumbnail;
    public $is_active;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'model_file' => 'nullable|file|max:51200',
        'thumbnail' => 'nullable|image|max:2048',
        'is_active' => 'boolean',
    ];

    public function mount($id)
    {
        $this->model = ThreeDModel::findOrFail($id);
        $this->title = $this->model->title;
        $this->description = $this->model->description;
        $this->is_active = $this->model->is_active;
    }

    public function update()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'description' => $this->description,
            'is_active' => $this->is_active,
        ];

        if ($this->model_file) {
            $ext = strtolower($this->model_file->getClientOriginalExtension());
            if (!in_array($ext, ['glb', 'gltf', 'obj'])) {
                $this->addError('model_file', 'The file must be a .glb, .gltf, or .obj file.');
                return;
            }

            if ($this->model->model_path) {
                Storage::disk('public')->delete($this->model->model_path);
            }
            $data['model_path'] = $this->handleFileUpload($this->model_file, '3d-models', 'public');
        }

        if ($this->thumbnail) {
            if ($this->model->thumbnail_path) {
                Storage::disk('public')->delete($this->model->thumbnail_path);
            }
            $data['thumbnail_path'] = $this->handleFileUpload($this->thumbnail, '3d-thumbnails', 'public');
        }

        $this->model->update($data);

        session()->flash('message', '3D Model updated successfully.');
        return redirect()->route('admin.three-d.index');
    }

    public function render()
    {
        return view('livewire.admin.three-d.edit');
    }
}
