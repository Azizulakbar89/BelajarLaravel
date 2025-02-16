<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory; // Pastikan ini ada
    use SoftDeletes;

    protected $fillable = [
        "title",
        'description'
    ];

    // kolom yang tidak bisa diisi oleh user
    protected $guared = [
        'id',
    ];

    // 1-M
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'blog_id', 'id');
    }
}
