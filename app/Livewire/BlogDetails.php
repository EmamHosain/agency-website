<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class BlogDetails extends Component
{
    public $id, $slug;
    public function mount()
    {
        $this->id = request()->query('id');
        $this->slug = request()->query('slug');
    }

    public function render()
    {
        $article = Article::with('category')->where('id', $this->id)->where('slug', $this->slug)->firstOrFail();
        return view('livewire.blog-details', [
            'article' => $article
        ]);
    }
}
