<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'category_id',
        'price',
        'category_id',
        'count_of_reads',
        'count_of_pages',
        'title',
        'author',
        'description',
        'about_author',
        'active',
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function photo():HasMany{
        return $this->hasMany(Photo::class,);
    }


}
