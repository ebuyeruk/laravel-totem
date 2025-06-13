<?php

namespace Ebuyer\Totem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_active' => ['required', 'boolean']
        ];
    }
}
