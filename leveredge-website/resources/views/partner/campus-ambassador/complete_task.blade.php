@extends('template.public')

@section('content')
    <div id="next-steps">
        <div class="container">

            <div class="row justify-content-center mt-5">
                <div class="col-md-8">

                    @if($task->payment_type == \App\CampusAmbassadorTask::PAYMENT_TYPE_NONE)
                        <h2>Complete Task</h2>
                    @else
                        <h2>Complete Task and Request Payment</h2>
                    @endif

                    <div class="card mt-3">
                        <div class="card-header">
                            <a href="#task-body-{{ $task->id }}" data-toggle="collapse"
                               data-controls="task-body-{{ $task->id }}" aria-expanded="false">{{ $task->title }}</a>
                        </div>
                        <div id="task-body-{{ $task->id }}" class="collapse">
                            <div class="card-body">
                                {!! $task->body !!}
                            </div>
                        </div>
                    </div>

                    <form class="mt-5" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if($task->payment_type != \App\CampusAmbassadorTask::PAYMENT_TYPE_NONE)
                            <input
                                type="hidden"
                                name="payment_method"
                                value="{{ $paymentMethodDigitalCheck->id }}">
                        @endif

                        @if($task->payment_type == \App\CampusAmbassadorTask::PAYMENT_TYPE_HOURLY)

                            <div class="form-group">
                                <label for="hours_worked">{{ __('Hours Worked to Complete Task') }}</label>
                                <input
                                    id="hours_worked"
                                    name="hours_worked"
                                    placeholder="Hours Worked"
                                    type="number"
                                    min="0"
                                    step="0.1"
                                    class="form-control{{ $errors->has('hours_worked') ? ' is-invalid' : '' }}"
                                    value="{{ old('hours_worked') }}"
                                    required autofocus>

                                @if ($errors->has('hours_worked'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('hours_worked') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="amount">{{ __('Payment Amount') }} <small>({{__('hourly rate is')}}
                                        ${{ \App\CampusAmbassadorTask::HOURLY_RATE }})</small></label>
                                <input
                                    id="amount"
                                    class="form-control"
                                    value="0"
                                    step="1"
                                    placeholder=""
                                    disabled>

                                @if ($errors->has('payment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payment') }}</strong>
                                    </span>
                                @endif
                            </div>

                        @elseif($task->payment_type == \App\CampusAmbassadorTask::PAYMENT_TYPE_FIXED)
                            <div class="form-group">
                                <label for="amount">{{ __('Payment Amount') }}</label>
                                <input
                                    id="amount"
                                    type="number"
                                    class="form-control"
                                    value="{{ $task->fixed_payment_amount }}"
                                    disabled>
                            </div>

                    @endif

                    <!-- Ambassador Notes -->
                        <div class="form-group">
                            <label for="ambassador_notes">{{ __('Task Notes (Optional)') }}</label>
                            <textarea
                                id="ambassador_notes"
                                name="ambassador_notes"
                                class="form-control{{ $errors->has('ambassador_notes') ? ' is-invalid' : '' }}">{{ old('ambassador_notes') }}</textarea>

                            @unless( $task->payment_type == \App\CampusAmbassadorTask::PAYMENT_TYPE_NONE )
                                <p class="help-text">This information is reviewed when approving your payment</p>
                            @endunless

                            @if ($errors->has('ambassador_notes'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ambassador_notes') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <!-- Ambassador Files (Images/PDF) -->
                        <div class="form-group">
                            <label for="ambassador_files">{{ __('Task Files (Optional)') }}</label>
                            <input type="file" name="ambassador_files[]" id="ambassador_files" multiple
                                   accept="image/*,.pdf"
                                   class="form-control {{ $errors->has('ambassador_files') ? 'is-invalid' : '' }}">

                            @if ($errors->has('ambassador_files'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ambassador_files') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Complete Task') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection


@push('footer-scripts')
    @if($task->payment_type == \App\CampusAmbassadorTask::PAYMENT_TYPE_HOURLY)
        <script>
            var hourlyRate = {{ \App\CampusAmbassadorTask::HOURLY_RATE }};

            $('#hours_worked').keyup(function () {
                var hours  = $(this).val();
                var amount = Math.ceil(hours * hourlyRate);
                $('#amount').val(amount);
            });
        </script>
    @endif
@endpush
