<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use App\Models\Cms as CmsModel;
use Livewire\WithPagination;

class Cms extends Component
{
    use WithPagination;
    
    protected $listeners = ['reload-cms' => '$refresh'];

    public $gridLayout = 3; // Default to 3-column layout

    public function render()
    {
        return view('livewire.cms.cms', [
            'cms' => CmsModel::latest()->paginate(10),
        ]);
    }

    public function delete($id)
    {
        $content = CmsModel::find($id);
        if ($content) {
            $title = $content->title;
            $content->delete();
            $this->dispatch('reload-cms');
            // Fix the notification dispatch format
            $this->dispatch('notify', message: "\"$title\" has been deleted successfully", type: 'success');
        } else {
            $this->dispatch('notify', message: 'Content not found', type: 'error');
        }
    }

    public function edit($id)
    {
        // Add edit functionality here
        $this->dispatch('notify', message: 'Edit functionality coming soon', type: 'info');
    }
}