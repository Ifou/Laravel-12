<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use App\Models\Cms as CmsModel;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Cms extends Component
{
    use WithPagination;
    
    protected $listeners = ['reload-cms' => '$refresh'];

    public $gridLayout = 3; // Default to 3-column layout
    public $title;
    public $description;
    public $viewingContent = null;
    public $viewingContentId = null;

    public function render()
    {
        // If we're currently viewing content and it's been updated, refresh it
        if ($this->viewingContentId) {
            $this->refreshViewingContent();
        }
        
        return view('livewire.Cms.cms', [
            'cms' => CmsModel::latest()->paginate(10),
        ]);
    }

    #[On('content-updated')]
    public function refreshViewingContent()
    {
        // Only refresh if we're currently viewing something
        if ($this->viewingContentId) {
            $content = CmsModel::find($this->viewingContentId);
            if ($content) {
                $this->viewingContent = $content;
                $this->title = $content->title;
                $this->description = $content->description;
            }
        }
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

    public function view($id)
    {
        $content = CmsModel::find($id);

        if ($content) {
            // Store the entire content object and set individual properties
            $this->viewingContent = $content;
            $this->viewingContentId = $id;
            $this->title = $content->title;
            $this->description = $content->description;
            
            // Add debug information
            session()->flash('debug_info', [
                'title' => $this->title,
                'description' => $this->description,
            ]);
            
            // Dispatch the event to show the modal
            $this->dispatch('modal-show', name: 'cms-view');
        } else {
            $this->dispatch('notify', message: 'Content not found', type: 'error');
        }
    }

}