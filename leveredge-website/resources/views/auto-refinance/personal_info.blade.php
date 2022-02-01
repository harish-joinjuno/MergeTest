@extends('auto-refinance.personal_info_no_birthday')
@section('birthday')
<div class="form-group">
    <label for="date_of_birth">Date of Birth</label>
    <div class="row">
        <div class="col">
            {{Form::select(null,
            [
                1 => 'January',
                2 => 'February',
                3 => 'March',
                4 => 'April',
                5 => 'May',
                6 => 'June',
                7 => 'July',
                8 => 'August',
                9 => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December'
            ],
            null,
            [
                'class' => 'form-control birthday-input',
                'placeholder' => 'Month',
                'id' => 'date_of_birth_month',
                'required' => true,
            ]
            )}}
        </div>
        <div class="col">
            {{Form::selectRange(null, 1,31,null,[
                    'class' => 'form-control birthday-input',
                    'placeholder' => 'Day',
                    'id' => 'date_of_birth_day',
                    'required' => true,
            ])}}
        </div>
        <div class="col">
            {{Form::selectRange(null,date('Y'),1900,null,[
                'class' => 'form-control birthday-input',
                'placeholder' => 'Year',
                'id' => 'date_of_birth_year',
                'required' => true,
            ])}}
        </div>
    </div>

    {{Form::text('date_of_birth',$autoRefinanceApplication->date_of_birth,[
        'class' => 'form-control',
        'placeholder' => 'Date of Birth',
        'id' => 'date_of_birth',
        'hidden' => true,
    ])}}
    @if ($errors->has('date_of_birth'))
        <span class="text-danger">
        {{ $errors->first('date_of_birth') }}
    </span>
    @endif
</div>
@endsection
@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const birthdayConcatInput = document.getElementById('date_of_birth');
            const birthdayInputs = document.querySelectorAll('.birthday-input');
            document.addEventListener('change', function(event) {
                if (event.target && event.target.matches('.birthday-input')) {
                    let value = '';
                    birthdayInputs.forEach(function(input, index) {
                        if(input.value) {
                            if(index !== 0) {
                                value += '-';
                            }
                            if(input.value < 10) {
                                value += '0';

                            }
                            value += input.value;
                        }
                    });
                    birthdayConcatInput.value = value;
                }
            });
        });
    </script>
@endpush
