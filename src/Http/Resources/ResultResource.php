<?php

namespace Ebuyer\Totem\Http\Resources;

use Ebuyer\Totem\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Result */
class ResultResource extends JsonResource
{
    protected bool $show_result = false;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'task_id' => $this->task_id,
            'ran_at' => $this->ran_at,
            'result' => $this->when($this->show_result, fn() => $this->result),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'duration' => $this->duration
        ];
    }

    public function show_result(bool $show_result): static
    {
        $this->show_result = $show_result;

        return $this;
    }
}
