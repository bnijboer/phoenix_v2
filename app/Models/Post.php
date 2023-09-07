<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = [
        'entry_id',
        'reader_count'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'entry_id');
    }
}
