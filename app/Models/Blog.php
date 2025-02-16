<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
