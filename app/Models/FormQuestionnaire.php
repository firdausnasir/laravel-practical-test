<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormQuestionnaire extends Model
{
    use SoftDeletes;

    protected $fillable = ['form_input_id'];

    public function formSurvey()
    {
        return $this->belongsTo(FormSurvey::class);
    }

    public function input()
    {
        return $this->hasOne(FormInput::class, 'id', 'form_input_id');
    }
}
