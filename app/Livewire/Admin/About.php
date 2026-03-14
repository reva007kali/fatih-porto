<?php

namespace App\Livewire\Admin;

use App\Models\AboutSection;
use App\Models\WorkExperience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Achievement;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Traits\HandlesFileUploads;

#[Layout('layouts.app')]
class About extends Component
{
    use WithFileUploads, HandlesFileUploads;

    // About Section
    public $title;
    public $description;
    public $motto; // New
    public $content;
    public $location;
    public $image;
    public $currentImage;
    public $cv_file; // New
    public $currentCvFile; // New
    public $availability_status = 'Available for Work'; // New
    public $button_text;
    public $button_link;

    // For Quill editor file uploads
    public $quillFile;

    // Work Experience Form
    public $work_id;
    public $work_company;
    public $work_role;
    public $work_period;
    public $work_description;
    public $isEditingWork = false;

    // Education Form
    public $edu_id;
    public $edu_institution;
    public $edu_degree;
    public $edu_period;
    public $edu_description;
    public $isEditingEdu = false;

    // Skill Form
    public $skill_id;
    public $skill_name;
    public $skill_category = 'General';
    public $skill_proficiency = 0;
    public $isEditingSkill = false;

    // Certification Form
    public $cert_id;
    public $cert_name;
    public $cert_issuer;
    public $cert_date;
    public $cert_link;
    public $isEditingCert = false;

    // Achievement Form
    public $ach_id;
    public $ach_title;
    public $ach_description;
    public $ach_date;
    public $isEditingAch = false;

    public function mount()
    {
        $about = AboutSection::first();
        if ($about) {
            $this->title = $about->title;
            $this->description = $about->description;
            $this->motto = $about->motto;
            $this->content = $about->content;
            $this->location = $about->location;
            $this->currentImage = $about->image;
            $this->currentCvFile = $about->cv_file;
            $this->availability_status = $about->availability_status;
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
            'motto' => 'nullable|string',
            'content' => 'nullable|string',
            'location' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
            'cv_file' => 'nullable|file|mimes:pdf|max:10240',
            'availability_status' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
        ]);

        $about = AboutSection::first();
        $imagePath = $this->currentImage;
        $cvPath = $this->currentCvFile;

        if ($this->image) {
            $imagePath = $this->handleFileUpload($this->image, 'about');
        }

        if ($this->cv_file) {
            $extension = $this->cv_file->getClientOriginalExtension();
            $filename = 'CV-' . date('dmY') . '.' . $extension;
            $cvPath = $this->cv_file->storeAs('about/cv', $filename, 'public');
        }

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'motto' => $this->motto,
            'content' => $this->content,
            'location' => $this->location,
            'image' => $imagePath,
            'cv_file' => $cvPath,
            'availability_status' => $this->availability_status,
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
        $this->cv_file = null;
        $this->currentImage = $imagePath;
        $this->currentCvFile = $cvPath;

        session()->flash('message', 'About section updated successfully.');
    }

    // Work Experience Methods
    public function saveWork()
    {
        $this->validate([
            'work_company' => 'required|string',
            'work_role' => 'required|string',
            'work_period' => 'required|string',
            'work_description' => 'nullable|string',
        ]);

        $data = [
            'company' => $this->work_company,
            'role' => $this->work_role,
            'period' => $this->work_period,
            'description' => $this->work_description,
        ];

        if ($this->isEditingWork) {
            WorkExperience::find($this->work_id)->update($data);
        } else {
            WorkExperience::create($data);
        }

        $this->resetWork();
        session()->flash('message', 'Work experience saved.');
    }

    public function editWork($id)
    {
        $work = WorkExperience::find($id);
        $this->work_id = $work->id;
        $this->work_company = $work->company;
        $this->work_role = $work->role;
        $this->work_period = $work->period;
        $this->work_description = $work->description;
        $this->isEditingWork = true;
    }

    public function deleteWork($id)
    {
        WorkExperience::find($id)->delete();
        session()->flash('message', 'Work experience deleted.');
    }

    public function resetWork()
    {
        $this->work_id = null;
        $this->work_company = '';
        $this->work_role = '';
        $this->work_period = '';
        $this->work_description = '';
        $this->isEditingWork = false;
    }

    // Education Methods
    public function saveEdu()
    {
        $this->validate([
            'edu_institution' => 'required|string',
            'edu_degree' => 'required|string',
            'edu_period' => 'required|string',
            'edu_description' => 'nullable|string',
        ]);

        $data = [
            'institution' => $this->edu_institution,
            'degree' => $this->edu_degree,
            'period' => $this->edu_period,
            'description' => $this->edu_description,
        ];

        if ($this->isEditingEdu) {
            Education::find($this->edu_id)->update($data);
        } else {
            Education::create($data);
        }

        $this->resetEdu();
        session()->flash('message', 'Education saved.');
    }

    public function editEdu($id)
    {
        $edu = Education::find($id);
        $this->edu_id = $edu->id;
        $this->edu_institution = $edu->institution;
        $this->edu_degree = $edu->degree;
        $this->edu_period = $edu->period;
        $this->edu_description = $edu->description;
        $this->isEditingEdu = true;
    }

    public function deleteEdu($id)
    {
        Education::find($id)->delete();
        session()->flash('message', 'Education deleted.');
    }

    public function resetEdu()
    {
        $this->edu_id = null;
        $this->edu_institution = '';
        $this->edu_degree = '';
        $this->edu_period = '';
        $this->edu_description = '';
        $this->isEditingEdu = false;
    }

    // Skill Methods
    public function saveSkill()
    {
        $this->validate([
            'skill_name' => 'required|string',
            'skill_category' => 'required|string',
            'skill_proficiency' => 'required|integer|min:0|max:100',
        ]);

        $data = [
            'name' => $this->skill_name,
            'category' => $this->skill_category,
            'proficiency' => $this->skill_proficiency,
        ];

        if ($this->isEditingSkill) {
            Skill::find($this->skill_id)->update($data);
        } else {
            Skill::create($data);
        }

        $this->resetSkill();
        session()->flash('message', 'Skill saved.');
    }

    public function editSkill($id)
    {
        $skill = Skill::find($id);
        $this->skill_id = $skill->id;
        $this->skill_name = $skill->name;
        $this->skill_category = $skill->category;
        $this->skill_proficiency = $skill->proficiency;
        $this->isEditingSkill = true;
    }

    public function deleteSkill($id)
    {
        Skill::find($id)->delete();
        session()->flash('message', 'Skill deleted.');
    }

    public function resetSkill()
    {
        $this->skill_id = null;
        $this->skill_name = '';
        $this->skill_category = 'General';
        $this->skill_proficiency = 0;
        $this->isEditingSkill = false;
    }

    // Certification Methods
    public function saveCert()
    {
        $this->validate([
            'cert_name' => 'required|string',
            'cert_issuer' => 'required|string',
            'cert_date' => 'nullable|string',
            'cert_link' => 'nullable|string',
        ]);

        $data = [
            'name' => $this->cert_name,
            'issuer' => $this->cert_issuer,
            'date' => $this->cert_date,
            'link' => $this->cert_link,
        ];

        if ($this->isEditingCert) {
            Certification::find($this->cert_id)->update($data);
        } else {
            Certification::create($data);
        }

        $this->resetCert();
        session()->flash('message', 'Certification saved.');
    }

    public function editCert($id)
    {
        $cert = Certification::find($id);
        $this->cert_id = $cert->id;
        $this->cert_name = $cert->name;
        $this->cert_issuer = $cert->issuer;
        $this->cert_date = $cert->date;
        $this->cert_link = $cert->link;
        $this->isEditingCert = true;
    }

    public function deleteCert($id)
    {
        Certification::find($id)->delete();
        session()->flash('message', 'Certification deleted.');
    }

    public function resetCert()
    {
        $this->cert_id = null;
        $this->cert_name = '';
        $this->cert_issuer = '';
        $this->cert_date = '';
        $this->cert_link = '';
        $this->isEditingCert = false;
    }

    // Achievement Methods
    public function saveAch()
    {
        $this->validate([
            'ach_title' => 'required|string',
            'ach_description' => 'nullable|string',
            'ach_date' => 'nullable|string',
        ]);

        $data = [
            'title' => $this->ach_title,
            'description' => $this->ach_description,
            'date' => $this->ach_date,
        ];

        if ($this->isEditingAch) {
            Achievement::find($this->ach_id)->update($data);
        } else {
            Achievement::create($data);
        }

        $this->resetAch();
        session()->flash('message', 'Achievement saved.');
    }

    public function editAch($id)
    {
        $ach = Achievement::find($id);
        $this->ach_id = $ach->id;
        $this->ach_title = $ach->title;
        $this->ach_description = $ach->description;
        $this->ach_date = $ach->date;
        $this->isEditingAch = true;
    }

    public function deleteAch($id)
    {
        Achievement::find($id)->delete();
        session()->flash('message', 'Achievement deleted.');
    }

    public function resetAch()
    {
        $this->ach_id = null;
        $this->ach_title = '';
        $this->ach_description = '';
        $this->ach_date = '';
        $this->isEditingAch = false;
    }

    public function render()
    {
        return view('livewire.admin.about', [
            'work_experiences' => WorkExperience::orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get(),
            'educations' => Education::orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get(),
            'skills' => Skill::orderBy('sort_order', 'asc')->orderBy('proficiency', 'desc')->get(),
            'certifications' => Certification::orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get(),
            'achievements' => Achievement::orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
