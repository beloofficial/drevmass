<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lesson\StoreLessonRequest;
use App\Http\Requests\Lesson\UpdateLessonRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Lesson;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthWebController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect('login')->withErrors(['password' => 'Invalid credentials. Please try again.']);
        }

        $user = Auth::getProvider()->retrieveByCredentials($request->only('email', 'password'));

        Auth::login($user);

        return $this->authenticated();
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     */
    protected function authenticated()
    {
        return redirect()->intended();
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }

    public function lessons()
    {
        $lessons = Lesson::all();

        return view('lessons', ['lessons' => $lessons]);
    }

    public function showLesson(Lesson $lesson)
    {
        return view('lesson', ['lesson' => $lesson]);
    }

    public function updateLesson(Lesson $lesson, UpdateLessonRequest $request)
    {
        $data = $request->validated();

        if(isset($data['image'])) {
            $data['image_src'] = $this->imageUpload($data['image']);
        }

        $lesson->fill($data);
        $lesson->save();

        return redirect()->back();
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

    public function deleteLesson(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('list-lessons');
    }

    public function createLesson()
    {
        return view('lesson');
    }

    public function createLessonPost(StoreLessonRequest $request)
    {
        $data = $request->validated();

        if(isset($data['image'])) {
            $data['image_src'] = $this->imageUpload($data['image']);
        }

        $lesson = Lesson::create($data);

        return redirect('admin/lessons/' . $lesson->id);
    }

    public function products()
    {
        $products = Product::all();

        return view('products', ['products' => $products]);
    }

    public function showProduct(Product $product)
    {
        return view('product', ['product' => $product]);
    }

    public function updateProduct(Product $product, UpdateProductRequest $request)
    {
        $data = $request->validated();

        if(isset($data['status'])) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        if(isset($data['image'])) {
            $data['image_src'] = $this->imageUpload($data['image']);
        }

        $product->fill($data);
        $product->save();

        return redirect()->back();
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('list-products');
    }

    public function createProduct()
    {
        return view('product');
    }

    public function createProductPost(StoreProductRequest $request)
    {
        $data = $request->validated();

        if(isset($data['status'])) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        if(isset($data['image'])) {
            $data['image_src'] = $this->imageUpload($data['image']);
        }

        $product = Product::create($data);

        return redirect('admin/products/' . $product->id);
    }
}
