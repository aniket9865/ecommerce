<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'username',
        'email',
        'comment',
        'rating',
        'status',
    ];

    // Define the relationship with the Product model (if needed)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function reactions()
    {
        return $this->hasMany(RatingReaction::class);
    }

    public function likes()
    {
        return $this->reactions()->where('type', 'like');
    }

    public function dislikes()
    {
        return $this->reactions()->where('type', 'dislike');
    }

}
