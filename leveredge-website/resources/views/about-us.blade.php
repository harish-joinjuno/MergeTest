@extends('template.public')

@push('header-scripts')
    <link rel="stylesheet" href="{{ mix('/mix/css/pages/about-us.css') }}" />
@endpush

@push('footer-scripts')
    <script src="{{ url('/vendor/multislider/multislider.min.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $('#schoolsSlider').multislider({
                slideAll: true,
                duration: 5000,
                continuous: true
            });
        });
    </script>
@endpush

@section('content')

    <div class="bg-white" id="about-us">
        <div class="container pt-1 pt-md-5 mt-2">
            <div class="row justify-content-center mb-3 mb-md-2">
                <div class="col-12 col-md-10 col-lg-9 text-center">
                    <h1 class="px-4">
                        <span>Student-First Initiative</span>
                        for Lower Rates on Student Loans.
                    </h1>
                </div>
            </div>
        </div>
        <div class="story-image">
            <div class="container">
                <div class="d-flex justify-content-center pt-2 pt-md-5 px-3 px-md-0">
                    <img src="{{ url('/img/new-team-on-zoom-ml.png') }}" class="w-100 h-100" alt="">
                </div>
            </div>
        </div>
        <div class="our-story pt-3 pt-md-5">
            <div class="container position-relative pt-4 mt-2">
                <div class="row balloon-row position-absolute w-100">
                    <div class="col-4 col-md-3 ml-md-3">
                        <img src="{{ url('/img/balloon.png') }}" class="float-right" alt="">
                    </div>
                </div>

                <div class="row px-4 px-md-0 mx-0 our-story-row justify-content-center text-center">
                    <div class="col-12 col-md-6 pb-md-5 mb-md-5">
                        <h2 class="mb-4 mb-md-3 pb-2 pb-md-5">Our story</h2>
                        <div class="pb-3 pb-md-4 mb-1 mb-md-2">
                            <span>
                                Juno’s founders, Nikhil Agarwal and Chris Abkarians were admitted to Harvard and then the
                                dreaded tuition bill came. That summer, instead of taking expensive loans, they got 700
                                students from 10 schools together and negotiated lower rates for the entire group, saving their
                                classmates ~$15K each.
                            </span>
                        </div>
                        <div>
                            <span>
                                Juno came into existence from their desire to make this benefit available to all
                                future generations of students. Today, Juno is able to get the lowest rate student
                                loans for thousands.
                            </span>
                        </div>
                        <div class="py-md-5 my-md-5"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="key-metrics-row pt-5">
            <div class="container py-5 mt-1 mt-md-4">
                <div class="text-center d-none d-md-block">
                    <h2 class="section-title white mb-5">
                        Key Metrics
                    </h2>
                </div>
                <div class="row white text-center pb-5 mb-5">
                    <div class="col-12 col-md-6">
                        <div class="row justify-content-center">
                            <div class="metric-col">
                                <div class="title">
                                    <span>40,000+</span>
                                </div>
                                <div class="desc mt-3 mb-5">
                                    <span>Juno has grown to over 40,000+ Members.</span>
                                </div>
                                <div class="line d-none d-md-block"></div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="metric-col mt-4 mt-md-5">
                                <div class="title">
                                    <span>$250M</span>
                                </div>
                                <div class="desc mt-3 mb-4">
                                    <span>We’ve helped thousands of students across dozens of universities secure over $250M in financing.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row justify-content-center">
                            <div class="metric-col mt-5 mt-md-0">
                                <div class="title">
                                    <span>$40M</span>
                                </div>
                                <div class="desc mt-3 mb-5">
                                    <span>Since launch, borrowers have saved over $40M.</span>
                                </div>
                                <div class="line d-none d-md-block"></div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="metric-col mt-4 mt-md-5">
                                <div class="title">
                                    <span>90%</span>
                                </div>
                                <div class="desc mt-3 mb-4">
                                    <span>9 out of 10 members hear about us from a friend.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="key-metrics-balloon d-flex justify-content-center">
            <img src="{{ url('/img/balloon-2.png') }}" alt="">
        </div>

        <div class="schools-slider py-0 py-md-5">
            @php
                $schools = [
                    'school-1.png',
                    'school-2.png',
                    'school-3.png',
                    'school-4.jpg',
                    'school-5.svg',
                    'school-6.png',
                    'school-7.png',
                    'school-8.png',
                    'school-9.png',
                ];
            @endphp
            <div id="schoolsSlider" class="py-5">
                <div class="row MS-content w-100 m-0 mb-5 mb-md-3 overflow-hidden flex-nowrap">
                    @foreach($schools as $value)
                        <div class="col-6 col-md-4 col-lg-2 item">
                            <div class="image-content d-flex justify-content-center py-4 bg-white">
                                <img class="my-1" src="{{ url('/img/schools-slider/'. $value ) }}" alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container pt-5 pb-0 pb-md-5 our-core-values">
            <div class="text-center pt-5 mt-1 mt-md-4">
                <h2 class="section-title mb-0 mb-md-5">
                    Our Core Values
                </h2>
                <div class="row pb-5 mb-4">

                    @php
                        $coreValues = [
                            [
                                'img'         => 'selfless',
                                'title'       => 'Community',
                                'description' => 'Juno was started by students, for students. We were part of the
                                initial negotiation group, and as members ourselves, we are committed to everyone who
                                joins.',
                            ],
                            [
                                'img'         => 'communication',
                                'title'       => 'Transparency',
                                'description' => 'We regularly send updates to our members, providing context on our
                                negotiations. You’ll be the first to know when we have a new deal or important
                                information.',
                            ],
                            [
                                'img'         => 'deliver-results',
                                'title'       => 'Education',
                                'description' => 'It’s important to know about all your options, so we always want
                                to let you know when a different route may be smarter. Our materials will walk you
                                through ways to evaluate what’s best for you.',
                            ]

                        ];
                    @endphp

                    @foreach($coreValues as $value)
                        <div class="col-12 col-md-4 mt-4 mt-md-0">
                            <div class="d-flex justify-content-center">
                                <div class="cor-value">
                                    <div class="image-content d-flex align-items-center">
                                        <img src="{{ url('/img/'. $value['img'] .'.png') }}" alt="">
                                    </div>
                                    <h2 class="mt-2 mb-3">{{ $value['title'] }}</h2>
                                    <span class="desc d-block">
                                        {{ $value['description'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-translucent-green pt-5 d-none d-md-block" id="press-section">
            <div class="container pt-5 mt-5">
                <div class="row pt-3">

                    @php
                        $press_mentions = [
                            ["Saving each student around $8,300 on their combined $25 million debt", url('/img/press-logo/wall-street-journal-bg-light-2.png'),"https://www.wsj.com/articles/m-b-a-students-have-billions-in-federal-loans-data-show-11564830000"],
                            ["No one has seen an approach exactly like Juno’s.", url('/img/press-logo/boston-globe-logo-light.png'),"https://www.bostonglobe.com/business/2019/02/22/taking-group-approach-lowering-cost-college-loans/IPSLWEhI7QjVixlmk9pAxK/story.html"],
                            ["Two HBS admits took a look at interest rates... Then they got organized.", url('/img/press-logo/poets-and-quants-logo-bg-light.png'),"https://poetsandquants.com/2019/08/28/leveredge-helping-mba-students-reduce-loans-takes-off/?pq-category=business-school-news&pq-category-2=students"],
                            ["Together, students can force lenders to compete.", url('/img/press-logo/above-the-law-horizontal.png'),"https://abovethelaw.com/2019/06/law-students-waste-hundreds-of-millions-on-student-loans-each-year/"],
                        ];
                    @endphp

                    @foreach($press_mentions as $press)
                        <div class="col-6 col-lg-3 mt-5 mt-lg-0">
                            <a href="{{ $press[2] }}" target="_blank">
                                <img src="{{ $press[1] }}" class="img-fluid" style="max-height: 24px;">
                                <p class="mt-3">
                                    "{{ $press[0] }}"
                                </p>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="peel-large-bottom bg-translucent-green p-5 d-none d-md-block"></div>
        <div class="peel-large-bottom d-block d-md-none"></div>
    </div>

@endsection
