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
        ini_set("memory_limit","30M");
        ini_set("post_max_size","20M");
        ini_set("upload_max_filesize","19M");
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
