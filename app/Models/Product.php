<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define which attributes can be mass assigned
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'shipping_returns',
        'price',
        'compare_price',
        'sku',
        'barcode',
        'track_qty',
        'qty',
        'status',
        'category_id',
        'sub_category_id',
        'brand_id',
        'is_featured',
        'image',
    ];

    // Optionally, you can define which attributes are hidden
    protected $hidden = [];


    public function product_image()
    {
        return $this->hasMany(ProductImage::class);
    }

    // In Product model
    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductRating::class);
    }


    public function product_ratings()
    {
        return $this->hasMany(ProductRating::class);
    }
}

