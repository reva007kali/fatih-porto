<?php

namespace App\Livewire\Public;

use App\Models\AboutSection;
use App\Models\WorkExperience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Achievement;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class About extends Component
{
    public function render()
    {
        return view('livewire.public.about', [
            'about' => AboutSection::first(),
            'work_experiences' => WorkExperience::orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get(),
            'educations' => Education::orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get(),
            'skills' => Skill::orderBy('sort_order', 'asc')->orderBy('proficiency', 'desc')->get(),
            'certifications' => Certification::orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get(),
            'achievements' => Achievement::orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
