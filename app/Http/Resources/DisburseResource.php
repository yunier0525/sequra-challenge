<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DisburseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'merchant_id' => $this->merchant_id,
            'disburse' => floatval((string) $this->disburse->getAmount()),
            'week' => $this->week,
            'year' => $this->year
        ];
    }
}
