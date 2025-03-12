<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux\Flux;

class Posts extends Component
{
    public $posts, $postId;

    public function mount()
    {
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.posts');
    }

    #[On('reload-posts')]
    public function reloadPosts()
    {
        $this->posts = Post::all();
    }

    public function edit($id)
    {
        $this->dispatch('edit-post', $id);
    }

    public function delete($id)
    {
        $this->postId = $id;
        Flux::modal('delete-post')->show();
    }

    public function destroy()
    {
        Post::find($this->postId)->delete();
        $this->reloadPosts();
        Flux::modal('delete-post')->close();
    }
}
