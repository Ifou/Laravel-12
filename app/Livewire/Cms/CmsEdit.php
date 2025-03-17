<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Livewire\Attributes\On;
use Flux\Flux;
use App\Models\Cms;

class CmsEdit extends Component
{
    public $title;
    public $description;
    public $contentId;

    public function render()
    {
        return view('livewire.Cms.cms-edit');
    }

    #[On('cms-edit')]
    public function edit($id)
    {
        $content = Cms::find($id);
        
        if ($content) {
            $this->title = $content->title;
            $this->description = $content->description;
            $this->contentId = $id;
            
            // Use dispatch for modal-show to ensure compatibility
            $this->dispatch('modal-show', name: 'cms-edit');
            
            // Also try the Flux way as a fallback
            Flux::modal('cms-edit')->show();
        } else {
            $this->dispatch('notify', message: 'Content not found', type: 'error');
        }
    }

    public function update()
    {
        $this->validate([
            "title" => "required",
            "description" => "required",
        ]);

        $content = Cms::find($this->contentId);
        
        if ($content) {
            $content->update([
                "title" => $this->title,
                "description" => $this->description
            ]);
            
            $this->resetForm();
            
            Flux::modal('cms-edit')->close();
            $this->dispatch('reload-cms');
            // Dispatch a specific event for content updates
            $this->dispatch('content-updated');
            $this->dispatch('notify', message: 'Content updated successfully', type: 'success');
        } else {
            $this->dispatch('notify', message: 'Content not found', type: 'error');
        }
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->contentId = null;
    }
}