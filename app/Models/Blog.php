<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use App\Models\Categoriable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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


    /**
     * The roles that belong to the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // M-M
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }


    // Polymorphic
    // 1-1
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    //1-M
    public function ratings(): MorphMany
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    //M-M
    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categoriable', Categoriable::class);
    }

    /**
     * Get the user that owns the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    //  pengerjaan gates
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
