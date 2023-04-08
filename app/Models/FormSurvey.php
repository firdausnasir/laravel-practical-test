<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSurvey extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionnaires()
    {
        return $this->hasMany(FormQuestionnaire::class);
    }

    public function responses()
    {
        return $this->hasMany(FormSurveyResponse::class);
    }
}
