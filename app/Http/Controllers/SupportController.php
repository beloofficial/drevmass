<?php

namespace App\Http\Controllers;

use App\Http\Requests\Support\AnswerSupportRequest;
use App\Http\Requests\Support\CreateSupportRequest;
use App\Models\Support;

class SupportController extends Controller
{
    public function get()
    {
        return Support::all();
    }

    public function show(Support $support)
    {
        return $support;
    }

    public function store(CreateSupportRequest $request)
    {
        $data = $request->validated();

        return auth()->user()->support()->create($data);
    }

    public function answer(Support $support, AnswerSupportRequest $request)
    {
        $data = $request->validated();

        $support->answer_description = $data['answer_description'];
        $support->save();

        return $support;
    }
}
