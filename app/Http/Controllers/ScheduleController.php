<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\Boiler;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController
{
    public function list(Request $request, ?Boiler $boiler = null)
    {
        $query = Schedule::query()->withAggregate('price', 'valid_at')->orderBy('price_valid_at');
        if (($validFrom = $request->query('valid_from')) !== null) {
            $query->whereHas('price', fn ($q) => $q->where('valid_at', '>=', $validFrom));
        }
        if (($validTo = $request->query('valid_to')) !== null) {
            $query->whereHas('price', fn ($q) => $q->where('valid_at', '<', $validTo));
        }

        if ($boiler !== null) {
            $query->where('boiler_id', $boiler->id);
        }

        return ScheduleResource::collection($query->get());
    }

    public function get()
    {
    }

    public function create()
    {
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $data = $request->validated('data');

        foreach ($data as $key => $value) {
            $schedule->$key = $value;
        }

        if ($schedule->isDirty()) {
            $schedule->save();
        }

        return new ScheduleResource($schedule);
    }
}
