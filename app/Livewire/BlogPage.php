<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Article;
use Livewire\Component;
use App\Models\Category;

class BlogPage extends Component
{
    public $category_id, $category_slug;
    public function mount()
    {
        $this->category_id = request()->query('category_id');
        $this->category_slug = request()->query('category_slug');
 
    }

    public function render()
    {
        // Get the selected tag_ids and tag_slugs from the query parameters
        $selectedTagIds = request()->query('tag_id') ? explode(',', request()->query('tag_id')) : [];
        $selectedTagSlugs = request()->query('tag_slug') ? explode(',', request()->query('tag_slug')) : [];

        // Initialize the query builder for articles
        $query = Article::query();

        // Apply tag filters if selected
        if (!empty($selectedTagIds) && !empty($selectedTagSlugs)) {
            $query->whereHas('tags', function ($q) use ($selectedTagIds, $selectedTagSlugs) {
                $q->whereIn('tags.id', $selectedTagIds)
                    ->whereIn('tags.slug', $selectedTagSlugs);
            });
        }

        // Example for category filter if needed
        if ($this->category_id && $this->category_slug) {
            $query->where('category_id', $this->category_id)
                ->whereHas('category', function ($q) {
                    $q->where('slug', $this->category_slug);
                });
        }

        // Apply any other necessary filters like 'status'
        $articles = $query->where('status', 1)
            ->orderByDesc('id')
            ->paginate(6);

        // Get the categories and tags for the sidebar
        $categories = Category::withCount('articles')->where('status', 1)->get();
        $all_tags = Tag::where('status', 1)->get();
        $latest_article = Article::where('status',1)->orderByDesc('id')->limit(3)->get();

        // Return the view with the variables
        return view('livewire.blog-page', [
            'articles' => $articles,
            'categories' => $categories,
            'all_tags' => $all_tags,
            'latest_article'=> $latest_article
        ]);
    }


}
