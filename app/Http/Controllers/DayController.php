<?php

namespace App\Http\Controllers;

use App\Http\Requests\Day\StoreDayRequest;

class DayController extends Controller
{
    public function store(StoreDayRequest $request)
    {
        $data = $request->validated();
        return auth()->user()->day()->updateOrCreate(['user_id' => auth()->id()], $data);
    }
}
