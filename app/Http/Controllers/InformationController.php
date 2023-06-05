<?php

namespace App\Http\Controllers;

use App\Http\Requests\Information\StoreInformationRequest;
use App\Models\Information;

class InformationController extends Controller
{
    public function store(StoreInformationRequest $request)
    {
        $data = $request->validated();

        $information = auth()->user()->information()->updateOrCreate(['user_id' => auth()->user()->id], $data);

        return $information;
    }
}
