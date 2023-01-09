<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HojaVidaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "title" => $this->title,
            "status" => $this->status,
            "type" => $this->type,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "views" => count($this->views),
        ];
        return $data;
        #return parent::toArray($request);
    }
}
