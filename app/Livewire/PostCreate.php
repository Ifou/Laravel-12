<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Flux\Flux;

class PostCreate extends Component
{

    public $title, $body;
    public function render()
    {
        return view('livewire.post-create');
    }

    public function submit()
    {
        $this->validate([
            "title" => "required",
            "body" => "required",
        ]);
        
        Post::create([
            "title" => $this->title,
            "body" => $this->body
        ]);

        $this->resetForm();

        Flux::modal('create-post')->close();
        $this->dispatch("reload-posts");   
    }

    public function resetForm()
    {
        $this->title = '';
        $this->body = '';
    }
}
