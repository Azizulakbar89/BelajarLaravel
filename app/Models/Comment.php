<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    //1-M
    protected $fillable = [
        'blog_id',
        'comment_text'
    ];

    // 1-M di sisi 1
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
