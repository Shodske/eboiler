<?php

declare(strict_types=1);

namespace App\Enums;

enum ScheduleType: string
{
    case AUTO = 'auto';
    case MANUAL = 'manual';
}
