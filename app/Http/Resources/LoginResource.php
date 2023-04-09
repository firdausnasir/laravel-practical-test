<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user'  => UserResource::make($this->resource),
            'token' => $this->whenNotNull(Arr::get($this->resource->getAppends(), 'token'), $this->resource->createToken($request->string('device_name', 'default'))->plainTextToken),
        ];
    }
}
