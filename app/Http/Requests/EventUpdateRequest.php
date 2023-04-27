<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:225',
            'start_at' => 'required|date',
            'description' => 'nullable|string|max:65535',
            'venue' => 'required|string|max:65535',
            'lat' => 'required|numeric|between:-90.0000000,90.0000000',
            'lng' => 'required|numeric|between:-180.0000000,180.0000000',
            'image_url' => 'required|string|max:2048',
        ];
    }
}