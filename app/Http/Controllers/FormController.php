<?php

namespace App\Http\Controllers;

use App\Models\FormInput;
use App\Models\FormSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FormController extends Controller
{
    public function index(FormSurvey $formSurvey)
    {
        $formSurvey->load(['questionnaires.input.formAttributes', 'user']);

        return view('form.public-show', [
            'formSurvey' => $formSurvey,
        ]);
    }

    public function edit(FormSurvey $formSurvey)
    {
        $formSurvey->load(['questionnaires.input.formAttributes', 'user']);
        $formInputs = FormInput::all();

        return view('form.edit', [
            'formSurvey' => $formSurvey,
            'formInputs' => $formInputs,
        ]);
    }

    public function update(Request $request, FormSurvey $formSurvey)
    {
        $data = array_flip($request->all());

        foreach ($formSurvey->questionnaires as $questionnaire) {
            // if questionnaire is not in request, delete it
            if (!Arr::has($data, $questionnaire->id)) {
                $questionnaire->delete();
            }
        }

        foreach ($data as $key => $inputQuestionnaire) {
            if (!$formSurvey->questionnaires->firstWhere('id', $key) && FormInput::where('id', $key)->exists()) {
                $formSurvey->questionnaires()->create([
                    'form_input_id' => $key,
                ]);
            }
        }

        return response()->noContent();
    }

    public function submitForm(FormSurvey $formSurvey, Request $request)
    {
        $formSurvey->responses()->create([
            'response' => $request->except(['_token']),
        ]);

        return redirect()->route('form.index', $formSurvey);
    }

    public function responses(FormSurvey $formSurvey)
    {
        $formSurvey->load(['responses']);

        return view('form.response', [
            'formSurvey' => $formSurvey,
        ]);
    }
}
