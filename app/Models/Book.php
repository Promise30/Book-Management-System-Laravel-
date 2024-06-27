<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ["title", "description", "author_id", "cover_image"];
    public function author(): BelongsTo{
        return $this->belongsTo(Author::class);
    }
    public function categories(): BelongsToMany{
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }
    public function reviews() : HasMany{
        return $this->hasMany(Review::class);
    }
    public function users() : BelongsToMany{
        return $this->belongsToMany(User::class)
            ->withPivot('status')
            ->withTimestamps();
    }
    public function reviewCount(){
        return $this->book->reviews()->sum();

    }
}
