<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $permission = $this->getAllPermissions()->toArray();

        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role->name,
            'avatar' => asset($this->avatar),
            'permission' => array_map(function ($item) {
                return $item['name'];
            }, $permission)
        ];
    }
}
