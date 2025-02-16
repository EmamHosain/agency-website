<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'slug',
        'status',
    ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
