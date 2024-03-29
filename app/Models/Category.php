<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = ['name', 'enable'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
}