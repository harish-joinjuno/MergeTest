@extends('template.auth_template')

@push('header-scripts')
{{--    <link href="{{mix('mix/css/app.css')}}" rel="stylesheet">--}}
    <style>
        #referral-program-page .container{
            padding-top: 30px;
            padding-bottom: 30px;
        }

        #referral-program-page h2{
            font-size: 28px;
            color: #4a4a4a;
            text-transform: none;
            margin-bottom: 32px;
        }



        #referral-program-page td{
            padding-top: 18px;
            padding-bottom: 12px;
        }

        table > tbody > tr:first-child > td{
            border-top: none;
        }


        table > tbody > tr:last-child > td{
            border-bottom: 1px solid #dee2e6;
        }




        #payment-method-form .form-check{
            margin-bottom: 6px;
        }

        #payment-method-form .form-check:last-of-type{
            margin-bottom: 24px;
        }

        .question-link {
            background-color:#EDF6F5;
            text-decoration:underline;
            position:relative;
            padding-right:3em!important;
        }
        .question-link i {
            position:absolute;
            top:50%;
            right:1em;
            margin-top:-9px;
        }
    </style>

@endpush

@push('footer-scripts')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5fc99f729af568d8"></script>
@endpush


@section('content')

    <div id="referral-program-page">
        @yield('content-before-referral-program-standard-sections')
        @include('member.referral-program.partials.claim-your-rewards')
        @include('member.referral-program.partials.share-via-email')
        @include('member.referral-program.partials.share-via-social-media')
        @include('member.referral-program.partials.post-on-reddit')
        @include('member.referral-program.partials.answer-on-quora')
        @include('member.referral-program.partials.claimed-rewards')
        @include('member.referral-program.partials.referral-stats')
        @include('member.referral-program.partials.detailed-referral-stats')
        @yield('content-after-referral-program-standard-sections')
    </div>

@endsection

