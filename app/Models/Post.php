<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'contact_number',
        'division',
        'status',
        'file'
    ];

    public function PostCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
