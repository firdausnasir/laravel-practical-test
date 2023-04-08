<?php

namespace Database\Seeders;

use App\Models\FormInput;
use App\Models\FormQuestionnaire;
use App\Models\FormSurvey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class FormQuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formInputs = FormInput::all();

        /* @var FormSurvey $formSurvey */
        foreach (FormSurvey::all() as $formSurvey) {
            $formSurvey->questionnaires()->saveMany(
                $formInputs->random(rand(1, 4))->map(function (FormInput $formInput) {
                    return new FormQuestionnaire(['form_input_id' => $formInput->id]);
                })
            );
        }
    }
}
