<?php

namespace App\Livewire\Public;

use Livewire\Component;

use App\Models\ThreeDModel;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class ThreeDViewer extends Component
{
    public ThreeDModel $model;

    public function mount($slug)
    {
        $this->model = ThreeDModel::where('slug', $slug)->where('is_active', true)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.three-d-viewer');
    }
}
