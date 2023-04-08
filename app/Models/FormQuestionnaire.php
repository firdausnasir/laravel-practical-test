<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormQuestionnaire extends Model
{
    public function formSurvey()
    {
        return $this->belongsTo(FormSurvey::class);
    }

    public function inputs()
    {
        return $this->hasMany(FormInput::class);
    }
}
