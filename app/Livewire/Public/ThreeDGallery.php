<?php

namespace App\Livewire\Public;

use Livewire\Component;

use App\Models\ThreeDModel;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class ThreeDGallery extends Component
{
    public function render()
    {
        return view('livewire.public.three-d-gallery', [
            'models' => ThreeDModel::where('is_active', true)
                ->orderBy('sort_order')
                ->latest()
                ->get()
        ]);
    }
}
