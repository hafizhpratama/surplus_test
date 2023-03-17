<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();

        $products->map(function ($product) {
            $product->category_names = $product->categories->pluck('name');
            return $product;
        });

        return response()->json($products, 200);
    }


    public function show($id)
    {
        $product = Product::with('categories')->findOrFail($id);

        $product->category_names = $product->categories->pluck('name');

        return response()->json($product, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'enable' => 'required',
            'category' => 'required'
        ]);

        $category = Category::where('name', $validatedData['category'])->firstOrFail();

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->enable = $validatedData['enable'];

        DB::transaction(function () use ($product, $category) {
            $product->save();
            $product->categories()->attach($category);
        });

        $product->category_name = $category->name;

        return response()->json($product, 201);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'enable' => 'required',
            'category' => 'required'
        ]);

        $category = Category::where('name', $validatedData['category'])->firstOrFail();

        $product = Product::findOrFail($id);
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->enable = $validatedData['enable'];

        DB::transaction(function () use ($product, $category) {
            $product->save();
            $product->categories()->sync([$category->id]);
        });

        $product->category_name = $category->name;

        return response()->json($product, 200);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $category_name = $product->categories->first()->name;

        DB::transaction(function () use ($product) {
            $product->categories()->detach();
            $product->delete();
        });

        return response()->json(['id' => $id, 'category_name' => $category_name], 204);
    }

}