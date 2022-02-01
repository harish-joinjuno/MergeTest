@extends('template.public')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2>Join the Spring 2019 Refinance Negotiation Group</h2>
                <div class="separator mx-auto"></div>
                <p class="mt--3 mb-5">
                        For undergraduate, MBA, JD and MD students graduating in Spring 2019 with student debt. Juno will negotiate a refinance offer from a lender and share the same with students.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card form-card">
                    <div class="card-body">
                        @include('refinance.form.form-1')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
