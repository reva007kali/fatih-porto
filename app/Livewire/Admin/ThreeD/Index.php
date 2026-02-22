<?php

namespace App\Livewire\Admin\ThreeD;

use Livewire\Component;

use App\Models\ThreeDModel;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class Index extends Component
{
    public function delete($id)
    {
        $model = ThreeDModel::findOrFail($id);
        
        if ($model->model_path) {
            Storage::disk('public')->delete($model->model_path);
        }
        if ($model->thumbnail_path) {
            Storage::disk('public')->delete($model->thumbnail_path);
        }
        
        $model->delete();
        session()->flash('message', '3D Model deleted successfully.');
    }

    public function toggleActive($id)
    {
        $model = ThreeDModel::findOrFail($id);
        $model->is_active = !$model->is_active;
        $model->save();
    }

    public function render()
    {
        return view('livewire.admin.three-d.index', [
            'models' => ThreeDModel::orderBy('sort_order')->latest()->get()
        ]);
    }
}
