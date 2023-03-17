<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Shirts',
            'enable' => true,
        ]);

        Category::create([
            'name' => 'Pants',
            'enable' => true,
        ]);

        Category::create([
            'name' => 'Shoes',
            'enable' => true,
        ]);

        $shirtCategory = Category::where('name', 'Shirts')->first();
        $pantsCategory = Category::where('name', 'Pants')->first();

        $tshirt = Product::create([
            'name' => 'T-Shirt',
            'description' => 'A comfortable t-shirt for everyday wear',
            'enable' => true,
        ]);

        $jeans = Product::create([
            'name' => 'Jeans',
            'description' => 'Classic jeans for any occasion',
            'enable' => true,
        ]);

        $tshirtImage = Image::create([
            'name' => 'T-Shirt Image',
            'file' => 'tshirt.jpg',
            'enable' => true,
        ]);

        $jeansImage = Image::create([
            'name' => 'Jeans Image',
            'file' => 'jeans.jpg',
            'enable' => true,
        ]);

        $tshirt->categories()->attach($shirtCategory);
        $jeans->categories()->attach($pantsCategory);

        $tshirt->images()->attach($tshirtImage);
        $jeans->images()->attach($jeansImage);
    }
}
