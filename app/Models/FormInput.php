<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormInput extends Model
{
    protected $fillable = ['name', 'type'];

    public function formAttributes()
    {
        return $this->hasMany(FormInputAttribute::class);
    }
}
