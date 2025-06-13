<?php

namespace Ebuyer\Totem\Http\Resources;

use Ebuyer\Totem\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Task */
class TaskResource extends JsonResource
{
    protected bool $show_result = false;

    public function toArray($request)
    {
        /** @var Task&JsonResource $this */
        $this->resource->load('results');
        return [
            'id' => $this->id,
            'description' => $this->description,
            'parameters' => $this->parameters,
            'expression' => $this->whenLoaded('frequencies', fn() => $this->getCronExpression()),
            'command' => $this->command,
            'timezone' => $this->timezone,
            'dont_overlap' => (bool) $this->dont_overlap,
            'run_in_maintenance' => (bool) $this->run_in_maintenance,
            'run_on_one_server' => (bool) $this->run_on_one_server,
            'run_in_background' => (bool) $this->run_in_background,
            'notification_email_address' => $this->notification_email_address,
            'notification_phone_number' => $this->notification_phone_number,
            'notification_slack_webhook' => $this->notification_slack_webhook,
            'auto_cleanup_num' => $this->auto_cleanup_num,
            'auto_cleanup_type' => $this->auto_cleanup_type,
            'is_active' => $this->activated,
            'next_run' => $this->upcoming,
            'last_result' => $this->whenLoaded('results', fn() => $this->last_result->created_at),
            'average_runtime' => $this->average_runtime,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function show_result(bool $show_result): static
    {
        $this->show_result = $show_result;
        return $this;
    }
}
