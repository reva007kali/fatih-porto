<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';

    /**
     * Handles column-based sorting (Name, Date, etc.)
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Updates the manual sort_order via Drag and Drop
     */
    public function updateOrder($items)
    {
        // Manual reordering only makes sense if we are currently 
        // viewing the "sort_order" field.
        if ($this->sortField !== 'sort_order') return;

        foreach ($items as $item) {
            Project::where('id', $item['id'])->update(['sort_order' => $item['order']]);
        }

        session()->flash('message', 'Manual order updated successfully.');
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        session()->flash('message', 'Project deleted successfully.');
    }

    public function render()
    {
        $projects = Project::with('media')
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        return view('livewire.admin.projects.index', [
            'projects' => $projects,
        ]);
    }
}