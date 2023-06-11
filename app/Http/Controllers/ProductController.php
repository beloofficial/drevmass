<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function get()
    {
        return Product::all();
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $data['image_src'] = $this->imageUpload($data['image']);

        return Product::create($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function imageUpload($image): string
    {
        $imageName = time().'.'.$image->extension();

        $image->move(public_path('images'), $imageName);

        return 'images/' . $imageName;
    }
}
