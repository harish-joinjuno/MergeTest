@extends('template.public')

@section('content')

    <div class="py-5"></div>

    <div class="container">

        <div class="row justify-content-center mb-4">
            <h1 class="text-center">What are you looking for?</h1>
        </div>

        <div class="row justify-content-center align-items-stretch">
                <x-loan-type
                    title="Student Loans"
                    value="student-loans"
                />

                <x-loan-type
                    title="Student Loan Refinancing"
                    value="refinance"
                />

            <x-loan-type
                title="International Student Health Insurance"
                value="international-student-health-insurance"
            />

            <x-loan-type
                title="Auto Loan Refinancing"
                value="auto-loan-refinancing"
            />

        </div>
    </div>

    <div class="py-5"></div>
@endsection
