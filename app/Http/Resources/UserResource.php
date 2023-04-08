<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var User|JsonResource $this */
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'registered_at' => $this->created_at->toIso8601String(),
            $this->mergeWhen($this->relationLoaded('formSurvey'), [
                'form_survey' => Request::create(route('form.public-show', $this->formSurvey))->path(),
            ]),
        ];
    }
}
