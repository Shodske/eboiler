<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ScheduleStatus;
use App\Enums\ScheduleType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected function casts()
    {
        return [
            'status' => ScheduleStatus::class,
            'type' => ScheduleType::class,
        ];
    }

    public function boiler(): BelongsTo
    {
        return $this->belongsTo(Boiler::class);
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class);
    }
}
