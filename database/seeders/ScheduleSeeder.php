<?php

namespace Database\Seeders;

use App\Enums\ScheduleStatus;
use App\Enums\ScheduleType;
use App\Models\Boiler;
use App\Models\Price;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $boiler = Boiler::query()->firstOrFail();
        Price::query()->each(function (Price $price) use ($boiler) {
            $schedule = new Schedule();
            $schedule->boiler()->associate($boiler);
            $schedule->price()->associate($price);
            $schedule->type = ($type = fake()->randomElement(ScheduleType::cases()));
            if ($type === ScheduleType::MANUAL) {
                $schedule->status = fake()->randomElement(ScheduleStatus::cases());
            }
            $schedule->save();
        });
    }
}
