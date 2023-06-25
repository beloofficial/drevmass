<?php

namespace App\Http\Controllers;

use App\Http\Requests\Favorite\FavoriteRequest;
use App\Http\Requests\Lesson\StoreLessonRequest;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function get()
    {
        return DB::table('lessons')
            ->leftJoin('favorites', function ($join) {
                $join->on('lessons.id', '=', 'favorites.favoriteable_id')
                    ->where('favorites.favoriteable_type', Lesson::class)
                    ->where('favorites.user_id', auth()->id());
            })
            ->select('lessons.*', DB::raw('IF(favorites.id IS NULL, false, true) as favorite'))
            ->get();

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

    public function changeFavorites(FavoriteRequest $request)
    {
        $data = $request->validated();
        if ($data['action'] == 'add') {
            auth()->user()->favorite(Lesson::find($data['lesson_id']));
        } else if ($data['action'] == 'remove') {
            auth()->user()->unfavorite(Lesson::find($data['lesson_id']));
        }

        return [
            'status' => 'success'
        ];
    }

    public function getFavorites()
    {
        $favoriteLessons = auth()->user()->getFavoriteItems(Lesson::class)->get();

        $favoriteLessons = $favoriteLessons->map(function ($lesson) {
            $lesson->favorite = 1;
            return $lesson;
        });

        return $favoriteLessons;
    }
}
