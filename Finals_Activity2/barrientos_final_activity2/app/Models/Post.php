<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
    ];

    protected $guarded = [
        'id',
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function scopePublished($query) {
        return $query->where('status', 'published');
    }
}
