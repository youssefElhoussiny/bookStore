<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
    public function authors()
    {
        return $this->belongsToMany(Author::class,"book_author");
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function rate()
    {
        // value is the column in ratings table
        return $this->ratings()->count() > 0 ? $this->ratings()->sum('value') / $this->ratings()->count() : 0 ;
    }
}
