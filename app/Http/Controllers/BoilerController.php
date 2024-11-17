<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBoilerRequest;
use App\Http\Resources\BoilerResource;
use App\Models\Boiler;

class BoilerController
{
    public function list()
    {
        return BoilerResource::collection(Boiler::all());
    }

    public function get(Boiler $boiler)
    {
        return new BoilerResource($boiler);
    }

    public function create()
    {
    }

    public function update(UpdateBoilerRequest $request, Boiler $boiler)
    {
        $data = $request->validated('data');

        foreach ($data as $key => $value) {
            $boiler->$key = $value;
        }

        if ($boiler->isDirty()) {
            $boiler->save();
        }

        return new BoilerResource($boiler);
    }
}
