<?php

namespace App\Http\Controllers;

use App\Http\Resources\PriceResource;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController
{
    public function list(Request $request)
    {
        $query = Price::query();
        if (($validFrom = $request->query('valid_from')) !== null) {
            $query->where('valid_at', '>=', $validFrom);
        }
        if (($validTo = $request->query('valid_to')) !== null) {
            $query->where('valid_at', '<', $validTo);
        }

        return PriceResource::collection($query->get());
    }

    public function get(Price $price)
    {
    }

    public function create()
    {
    }

    public function update()
    {
    }
}
