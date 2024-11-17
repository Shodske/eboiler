<?php

namespace Database\Seeders;

use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $file = fopen(storage_path('data/prices.csv'), 'r');
        $keys = fgetcsv($file);
        while (($line = fgetcsv($file)) !== false) {
            $values = array_combine($keys, $line);
            $price = new Price();
            $price->country = $values['country_code'];
            $price->area = $values['price_area'];
            $price->currency = $values['currency_code'];
            $price->price = $values['Day-ahead Energy Price'];
            $price->valid_at = Carbon::create($values['utc_timestamp']);
            $price->save();
        }
    }
}
