<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['name', 'description', 'enable'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image');
    }
}