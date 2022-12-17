<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
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
            "name" => $this->name,
            "email" => $this->email,
            "email_verified_at" => $this->email_verified_at,
            'created_at' => $this->created_at->format('d-m-Y'),
            "updated_at" => $this->updated_at->format('d-m-Y'),
            "last_name" => $this->last_name,
            "birthdate" => $this->birthdate,
            "phone" => $this->phone,
            "address" => $this->address,
            "dni" => $this->dni,
            "about_me" => $this->about_me,
            "avatar" => $this->avatar,
            "occupation" => $this->occupation,

        ];
        return $data;
    }
}
