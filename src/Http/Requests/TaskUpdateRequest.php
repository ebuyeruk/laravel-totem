<?php

namespace Ebuyer\Totem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => ['sometimes', 'string'],
            'parameters' => ['sometimes', 'string'],
            'expression' => ['sometimes', 'cron_expression'],
            'command' => ['sometimes', 'string'],
            'timezone' => ['sometimes', 'timezone'],
            'dont_overlap' => ['sometimes', 'boolean'],
            'run_in_maintenance' => ['sometimes', 'boolean'],
            'run_in_background' => ['sometimes', 'boolean'],
            'run_on_one_server' => ['sometimes', 'boolean'],
            'notification_email_address' => ['sometimes', 'email'],
            'notification_phone_number' => ['sometimes', 'string'],
            'notification_slack_webhook' => ['sometimes', 'url'],
            'auto_cleanup_num' => ['sometimes', 'integer'],
            'auto_cleanup_type' => ['sometimes', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
