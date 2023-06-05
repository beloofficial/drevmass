<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lesson\StoreLessonRequest;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function get()
    {
        return Lesson::all();
    }

    public function show(Lesson $lesson)
    {
        return $lesson;
    }

    public function store(StoreLessonRequest $request)
    {
        $data = $request->validated();

        $data['image_src'] = $this->imageUpload($data['image']);

        return Lesson::create($data);
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
