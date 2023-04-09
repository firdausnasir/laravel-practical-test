<?php

namespace App\Http\Controllers;

use App\Http\Resources\FormInputResource;
use App\Models\FormInput;
use App\Models\FormSurvey;
use Illuminate\Http\Request;

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
        $formInputIds = FormInput::pluck('id');

        foreach ($request->all() as $key => $item) {
            // skip if id is not in form inputs
            if (!in_array($key, $formInputIds->toArray())) {
                continue;
            }

            $item = filter_var($item, FILTER_VALIDATE_BOOLEAN);

            if ($item) {
                // if questionnaire is not in request, create it
                if (!$formSurvey->questionnaires->firstWhere('form_input_id', $key)) {
                    $formSurvey->questionnaires()->create([
                        'form_input_id' => $key,
                    ]);
                }
            } else {
                // if questionnaire is in request, delete it
                if ($formSurvey->questionnaires->firstWhere('form_input_id', $key)) {
                    $formSurvey->questionnaires->firstWhere('form_input_id', $key)->delete();
                }
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

    public function getFormInputs()
    {
        return FormInputResource::collection(FormInput::all());
    }
}
