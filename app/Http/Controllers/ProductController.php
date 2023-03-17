<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories', 'images'])->get();

        $products->map(function ($product) {
            $product->category_names = $product->categories->pluck('name');
            $product->image_names = $product->images->pluck('name');
            return $product;
        });

        return response()->json($products, 200);
    }


    public function show($id)
    {
        $product = Product::with(['categories', 'images'])->findOrFail($id);

        $product->category_names = $product->categories->pluck('name');
        $product->image_names = $product->images->pluck('name');

        return response()->json($product, 200);
    }


    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->enable = $request->input('enable');
        $product->save();

        $category_name = $request->input('category');
        $category = Category::where('name', $category_name)->firstOrFail();

        $product->categories()->attach($category->id);

        $image = Image::where('name', $request->input('image'))->first();

        $product->images()->attach($image->id);

        $product->load(['categories', 'images']);

        return response()->json($product, 201);
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->enable = $request->input('enable');
        $product->save();

        $category_name = $request->input('category');
        if (!empty($category_name)) {
            $category = Category::where('name', $category_name)->firstOrFail();

            $product->categories()->sync([$category->id]);
        }

        $image_name = $request->input('image');
        if (!empty($image_name)) {
            $image = Image::where('name', $request->input('image'))->firstOrFail();
        
            $product->images()->sync([$image->id]);
        }

        $product->load(['categories', 'images']);

        return response()->json($product, 200);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->images()->detach();
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

}