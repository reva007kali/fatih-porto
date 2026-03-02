<?php

namespace App\Livewire\Admin\Navigation;

use App\Models\NavigationItem;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public $label;
    public $url;
    public $is_active = true;
    public $sort_order = 0;
    public $navId;
    public $parent_id = null;
    public $isEditing = false;

    public function render()
    {
        return view('livewire.admin.navigation.index', [
            'navItems' => NavigationItem::with('children')->whereNull('parent_id')->orderBy('sort_order')->get(),
            'parentItems' => NavigationItem::whereNull('parent_id')->orderBy('sort_order')->get(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'sort_order' => 'integer',
            'parent_id' => 'nullable|exists:navigation_items,id',
        ]);

        NavigationItem::create([
            'label' => $this->label,
            'url' => $this->url,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'parent_id' => $this->parent_id ?: null,
        ]);

        $this->reset(['label', 'url', 'is_active', 'sort_order', 'parent_id']);
        session()->flash('message', 'Menu item added successfully.');
    }

    public function edit($id)
    {
        $item = NavigationItem::findOrFail($id);
        $this->navId = $id;
        $this->label = $item->label;
        $this->url = $item->url;
        $this->is_active = $item->is_active;
        $this->sort_order = $item->sort_order;
        $this->parent_id = $item->parent_id;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'sort_order' => 'integer',
            'parent_id' => 'nullable|exists:navigation_items,id',
        ]);

        $item = NavigationItem::findOrFail($this->navId);
        
        // Prevent setting parent to itself
        if ($this->parent_id == $item->id) {
            $this->addError('parent_id', 'A menu item cannot be its own parent.');
            return;
        }

        $item->update([
            'label' => $this->label,
            'url' => $this->url,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'parent_id' => $this->parent_id ?: null,
        ]);

        $this->reset(['label', 'url', 'is_active', 'sort_order', 'navId', 'isEditing', 'parent_id']);
        session()->flash('message', 'Menu item updated successfully.');
    }

    public function delete($id)
    {
        $item = NavigationItem::findOrFail($id);
        $item->delete();
        session()->flash('message', 'Menu item deleted successfully.');
    }

    public function cancel()
    {
        $this->reset(['label', 'url', 'is_active', 'sort_order', 'navId', 'isEditing', 'parent_id']);
    }

    public function toggleActive($id)
    {
        $item = NavigationItem::findOrFail($id);
        $item->update(['is_active' => !$item->is_active]);
    }
}
