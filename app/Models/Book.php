<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author_id',
        'content',
        'cover',
        'price',
        'year_published'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
