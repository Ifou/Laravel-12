<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Flux\Flux;

class PostCreate extends Component
{
    public $title = '';
    public $body = '';
    
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
        return view('livewire.Posts.post-create');
    }

    public function submit()
    {
        $this->validate();
        
        
        try {
            Post::create([
                "title" => $this->title,
                "body" => $this->body,
                "created_at" => now(),
                "updated_at" => now(),
            ]);

            $this->resetForm();

            Flux::modal('create-post')->close();
            // Just use toast without chaining or additional parameters
            Flux::toast('Post created successfully!');
            $this->dispatch("reload-posts");   
        } catch (\Exception $e) {
            // Just use toast without chaining or additional parameters
            Flux::toast('Failed to create post. Please try again.');
        }
    }

    public function resetForm()
    {
        $this->reset(['title', 'body']);
        $this->resetValidation();
    }
}
