<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormSurveyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'public_form_id' => $this->resource->public_form_id,
            'user'           => UserResource::make($this->whenLoaded('user')),
            'questionnaires' => FormQuestionnaireResource::collection($this->whenLoaded('questionnaires')),
            'responses'      => FormResponseResource::collection($this->whenLoaded('responses')),
        ];
    }
}
