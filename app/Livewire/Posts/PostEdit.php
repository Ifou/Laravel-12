<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\Attributes\On;
use Flux\Flux;
use App\Models\Post;

class PostEdit extends Component
{
    public $title = '';
    public $body = '';
    public $postId;
    
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'body' => 'required|min:10',
    ];
    
    protected $messages = [
        'title.required' => 'The post title is required.',
        'title.min' => 'The title must be at least 3 characters.',
        'title.max' => 'The title cannot exceed 255 characters.',
        'body.required' => 'The post content is required.',
        'body.min' => 'The content must be at least 10 characters.',
    ];

    public function render()
    {
        return view('livewire.Posts.post-edit');
    }

    #[On('edit-post')]
    public function edit($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            try {
                Flux::toast('Post not found.')->error()->send();
            } catch (\Exception $e) {
                logger()->error('Flux toast error: ' . $e->getMessage());
            }
            return;
        }
        
        $this->title = $post->title;
        $this->body = $post->body;
        $this->postId = $id;
        
        Flux::modal('edit-post')->show();
    }

    public function update()
    {
        $this->validate();

        try {
            $post = Post::find($this->postId);
            
            if (!$post) {
                try {
                    Flux::toast('Post not found.')->error()->send();
                } catch (\Exception $e) {
                    logger()->error('Flux toast error: ' . $e->getMessage());
                }
                return;
            }
            
            $post->update([
                "title" => $this->title,
                "body" => $this->body,
            ]);

            $this->resetForm();

            Flux::modal('edit-post')->close();
            try {
                // Make sure we're using Flux correctly
                $toast = Flux::toast('Post updated successfully!');
                if ($toast) {
                    $toast->success()->send();
                } else {
                    logger()->error('Flux toast returned null');
                }
            } catch (\Exception $e) {
                logger()->error('Flux success toast error: ' . $e->getMessage());
            }
            $this->dispatch("reload-posts");
        } catch (\Exception $e) {
            logger()->error('Post update error: ' . $e->getMessage());
            try {
                Flux::toast('Failed to update post. Please try again.')->error()->send();
            } catch (\Exception $e) {
                logger()->error('Flux error toast error: ' . $e->getMessage());
            }
        }
    }
    
    public function resetForm()
    {
        $this->reset(['title', 'body', 'postId']);
        $this->resetValidation();
    }
}
