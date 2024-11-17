<?php

namespace Database\Seeders;

use App\Models\Boiler;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BoilerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $boiler = new Boiler();
        $boiler->name = 'Test Boiler';
        $boiler->price_threshold = 13.37;
        $boiler->save();
    }
}
