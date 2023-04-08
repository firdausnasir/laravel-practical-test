@extends('layout')

@section('content')
    <form action="{{ route('form.submit-form', $formSurvey) }}" method="POST">
        @csrf
        @foreach($formSurvey->questionnaires as $question)
            @if($question->input->formAttributes->where('value', 'radio')->isNotEmpty())
                <label>{{ $question->input->name }}</label><br>
                @for($i = 0; $i < count($question->input->formAttributes->where('name', 'value')); $i++)
                    <label for="{{ $question->input->name }}">{{ $question->input->formAttributes->where('name', 'value')->values()[$i]->value }}</label>
                    <{{ $question->input->type }}
                    @foreach($question->input->formAttributes as $attribute)
                        {{ $attribute->name }}="{{ $attribute->value }}"
                    @endforeach
                    id="{{ $question->input->name }}-{{ $i }}">
                @endfor
            @else
                <label for="{{ $question->input->name }}">{{ $question->input->name }}</label>
                <{{ $question->input->type }}
                @foreach($question->input->formAttributes as $attribute)
                    {{ $attribute->name }}="{{ $attribute->value }}"
                    @if($attribute->name == 'type' && $attribute->value == 'date')
                        max="{{ date('Y-m-d') }}"
                    @endif
                @endforeach
                id="{{ $question->input->name }}">
                <br><br><br>
            @endif
        @endforeach
        <br><br>
        <input type="submit" value="Submit">
    </form>
@endsection