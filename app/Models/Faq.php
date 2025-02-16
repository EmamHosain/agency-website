<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /** @use HasFactory<\Database\Factories\FaqFactory> */
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'status',
        'order',
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($faq) {
            if (empty($faq->order)) {
                $faq->order = static::max('order') + 1;
            }
        });
    }


}
