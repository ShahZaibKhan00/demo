<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'name',
        'review',
    ];

    public function blog() {
        return $this->hasMany(Blog::class);
    }
}
