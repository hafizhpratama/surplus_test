<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return Image::all();
    }

    public function show(Image $image)
    {
        return $image;
    }

    public function store(Request $request)
    {
        $image = Image::create($request->all());

        return response()->json($image, 201);
    }

    public function update(Request $request, Image $image)
    {
        $image->update($request->all());

        return response()->json($image, 200);
    }

    public function destroy(Image $image)
    {
        $image->delete();

        return response()->json(null, 204);
    }
}