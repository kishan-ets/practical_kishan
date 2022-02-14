<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' =>$this->email,
            'mobile_no' =>$this->mobile_no,
            'gender' =>$this->gender,
            'dob' =>$this->dob,
            'address' =>$this->address,
            'country_id' =>$this->country_id,
            'state_id' =>$this->state_id,
            'city_id' =>$this->city_id,
            'role_id' =>$this->role_id,
            'role' => $this->role,
            'documents' => $this->documents,
            // 'permission' => $this->permission,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'authorization' => $this->authorization,
        ];
    }
}
