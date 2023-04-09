<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FormSurvey extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        self::saving(function (self $formSurvey) {
            if (empty($formSurvey->public_form_id)) {
                $formSurvey->public_form_id = Str::uuid();
            }
        });
    }

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
