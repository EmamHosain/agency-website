<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable = [
        'name',
        'designation', // Assuming this is a typo and should be 'designation'
        'fb_url',
        'inst_url',
        'twi_url',
        'image',
        'status',
    ];
}
