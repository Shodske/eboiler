<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected function casts(): array
    {
        return [
            'price' => 'float',
            'valid_at' => 'datetime',
        ];
    }
}
