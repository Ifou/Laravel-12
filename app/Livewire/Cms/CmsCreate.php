<?php

namespace App\Livewire\Cms;

use Livewire\Component;
use Flux\Flux;
use App\Models\Cms;

class CmsCreate extends Component
{
    public $title, $description;

    public function render()
    {
        // Fix the path to match the directory structure (case-sensitive)
        return view('livewire.cms.cms-create');
    }
    
    public function submit()
    {
        $this->validate([
            "title" => "required",
            "description" => "required",
        ]);
        
        Cms::create([
            "title" => $this->title,
            "description" => $this->description
        ]);

        $this->resetForm();

        Flux::modal('cms-add')->close();
        $this->dispatch("reload-cms");
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
    }
}