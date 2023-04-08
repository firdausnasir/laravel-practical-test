<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSurveyResponse extends Model
{
    public function survey()
    {
        return $this->belongsTo(FormSurvey::class);
    }
}
