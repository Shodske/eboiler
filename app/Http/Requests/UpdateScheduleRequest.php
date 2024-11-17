<?php

namespace App\Http\Requests;

use App\Enums\ScheduleStatus;
use App\Enums\ScheduleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateScheduleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.type' => [
                'sometimes',
                'required',
                Rule::enum(ScheduleType::class),
            ],
            'data.status' => [
                'sometimes',
                Rule::enum(ScheduleStatus::class),
            ],
        ];
    }
}
