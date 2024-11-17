<?php

declare(strict_types=1);

namespace App\Enums;

enum ScheduleStatus: string
{
    case ON = 'on';
    case OFF = 'off';
}
