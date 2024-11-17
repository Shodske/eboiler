<?php

namespace App\Http\Resources;

use App\Enums\ScheduleStatus;
use App\Enums\ScheduleType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        $data['price'] = $this->price->price;
        $data['valid_at'] = $this->price->valid_at;

        if ($this->type === ScheduleType::AUTO) {
            $data['status'] = $this->boiler->price_threshold >= $this->price->price
                ? ScheduleStatus::ON
                : ScheduleStatus::OFF;
        }

        return $data;
    }
}
