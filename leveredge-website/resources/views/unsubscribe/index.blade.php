@extends('template.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Manage Subscription') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/unsubscribe') }}">
                            @csrf

                           <input type="hidden" name="email" value="{{ $email }}">


                            <div class="form-group row">
                                <label for="subscription_status" class="col-sm-4 col-form-label text-md-right">{{ __('Unsubscribe Me From') }}</label>

                                <div class="col-md-6">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="unsub_from_student_loan_deal_emails">
                                        <label class="form-check-label">
                                            Student Loan Deal Emails
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="unsub_from_refinance_loan_deal_emails">
                                        <label class="form-check-label">
                                            Refinance Loan Deal Emails
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="unsub_from_join_juno_emails">
                                        <label class="form-check-label">
                                            Emails about Join Juno
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="unsub_from_all_emails">
                                        <label class="form-check-label">
                                            All Emails
                                        </label>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="reason" class="col-sm-4 col-form-label text-md-right">{{ __('Reason') }}</label>

                                <div class="col-md-6">
                                    <select id="reason" name="reason" class="form-control selectpicker" required  data-live-search="true">
                                        <option value="">Select a reason</option>

                                        <option value="I took the negotiated deal">I took the negotiated deal</option>
                                        <option value="I took a different loan">I took a different loan</option>
                                        <option value="I am not interested in the deal">I am not interested in the deal</option>
                                        <option value="I am getting too many emails">I am getting too many emails</option>
                                        <option value="My reason is not listed here">My reason is not listed here</option>

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
                                        {{ __('Update Preferences') }}
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
