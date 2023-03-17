<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['name', 'file', 'enable'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_image');
    }
}