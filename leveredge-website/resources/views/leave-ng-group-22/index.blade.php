@extends('template.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Manage Groups') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/leave-negotiation-group') }}">
                            @csrf

                            <p class="text-center">Remove me from Student Loans 2021-22 Group</p>

                            <div class="form-group row">
                                <label for="reason" class="col-sm-4 col-form-label text-md-right">{{ __('Reason') }}</label>

                                <div class="col-md-6">
                                    <select id="reason" name="reason" class="form-control selectpicker" required  data-live-search="true">
                                        <option value="">Select a reason</option>

                                        @foreach(\App\NegotiationGroupUserLeave::REASONS as $reason)
                                            <option value="{{ $reason }}">{{ $reason }}</option>
                                        @endforeach

                                    </select>

                                    @if ($errors->has('reason'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reason') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Leave Group') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
