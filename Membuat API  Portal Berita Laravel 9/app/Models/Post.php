<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','news_constent','author'
    ];

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
