<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author_name',
        'content',
        'article_image',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($article) {
            if ($article->article_image) {
                // Delete from storage/app/public/articles
                Storage::delete("$article->article_image");

                // Delete from public/storage/articles
                $imagePath = public_path("storage/{$article->article_image}");
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

            }
        });
    }

    // Define the relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
