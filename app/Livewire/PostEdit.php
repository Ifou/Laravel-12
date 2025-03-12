<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Flux\Flux;
use App\Models\Post;

class PostEdit extends Component
{
    public $title, $body, $postId;

    public function render()
    {
        return view('livewire.post-edit');
    }

    #[On('edit-post')]
    public function edit($id)
    {
        $post = Post::find($id);
        $this->title = $post->title;
        $this->body = $post->body;
        $this->postId = $id;
        Flux::modal('edit-post')->show();
    }

    public function update()
    {
        $this->validate([
            "title" => "required",
            "body" => "required",
        ]);

        Post::find($this->postId)->update([
            "title" => $this->title,
            "body" => $this->body
        ]);

        $this->resetForm();

        Flux::modal('edit-post')->close();
        $this->dispatch("reload-posts");
    }
    public function resetForm()
    {
        $this->title = '';
        $this->body = '';
    }
}
