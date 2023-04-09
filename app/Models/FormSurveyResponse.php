<?php

namespace App\Models;

use App\Notifications\FormSurveyResponseNotification;
use Illuminate\Database\Eloquent\Model;

class FormSurveyResponse extends Model
{
    protected $fillable = ['response'];

    protected $casts = [
        'response' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->survey->user->notify(new FormSurveyResponseNotification($model->survey->user));
        });
    }

    public function survey()
    {
        return $this->belongsTo(FormSurvey::class, 'form_survey_id');
    }
}
