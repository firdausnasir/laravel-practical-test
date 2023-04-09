@extends('layout')

@section('title', 'Edit Form')

@section('content')
    <h3>Form</h3>
    <p>There are many variations of Lorem Ipsum available, but the majority have suffered alteration in some form</p>

    <form action="{{ url("form/$formSurvey->public_form_id/update") }}" method="POST" name="form-inputs"
          onsubmit="return false;">
        @method('PUT')
        @csrf

        @foreach($formInputs as $input)
            <label for="input-form-{{ $input->id }}">{{ $input->name }}</label>
            <input type="checkbox"
                   id="input-form-{{ $input->id }}"
                   name="{{ Str::lower($input->name) }}"
                   value="{{ $input->id }}"
                    @checked($formSurvey->questionnaires->pluck('form_input_id')->search($input->id) !== false)
            >
            <br>
        @endforeach
        <br>
        <button type="button" onclick="submitForm()">Submit</button>
    </form>
@endsection

@section('scripts')
    <script>
        function submitForm() {
            let form = document.forms["form-inputs"].getElementsByTagName("input");

            let data = {};
            for (let i = 0; i < form.length; i++) {
                if (form[i].type === 'checkbox') {
                    data[form[i].value] = form[i].checked === true;
                }
            }

            $.ajax({
                url: '{{ route('api.form.update', $formSurvey) }}',
                type: 'PUT',
                _token: '{{ csrf_token() }}',
                data: data,
                beforeSend: function (xhr, settings) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + "{{ session('token') }}");
                },
                success: function () {
                    location.reload();
                }
            });

            return false;
        }
    </script>
@endsection