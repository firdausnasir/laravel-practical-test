@extends('layout')

@section('content')
    <h4>Response:</h4>
    @foreach($formSurvey->responses as $response)
        <br>
        @if(!$loop->first)
            <hr>
        @endif
        <br>
        Response ID: {{ $response->id }}
        <br>
        @foreach($response->response as $question => $answer)
            <br>
            <span style="font-weight: bold">{{ $question }}</span>: {{ $answer }}
        @endforeach
    @endforeach
@endsection