
@push('header-scripts')
    <style>
        .campaign p.resources-cards-text{
            color: #222222;
            font-size: 1.1rem;
        }
    </style>
@endpush

@unless(isset($hide_heading_section) && $hide_heading_section)
<div class="jumbotron py-3 my-0 bg-translucent-green">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center off-black">Resources</h1>
                <p class="text-center">We’re here to help you make the best decision for your financial situation.</p>
            </div>
        </div>
    </div>
</div>
@endunless

@php
    $resources = isset($page_specific_resources) ? $page_specific_resources : [
        [
            'title' => 'Comparison Calculator',
            'description' => 'Compare the quotes you have received from lenders to the federal loan rates. <br><br> We’ll help you calculate the combination of options that gets you the most affordable loan.',
            'cta' => 'Compare your Quotes',
            'link' => url('/calculator/graduate/compare-my-options')
        ],
        [
            'title' => 'Fixed vs. Variable <br> in 2020-21',
            'description' => 'Need help deciding between fixed and variable rates? <br><br> Learn how you can evaluate which one is appropriate for you.',
            'cta' => 'Learn More',
            'link' => url('/fixed-vs-variable-20-21')
        ],
        [
            'title' => 'Federal vs. Private for Grad Students',
            'description' => 'Learn more about the trade-offs between Federally Held Student Loans and Private Student Loans.',
            'cta' => 'Learn More',
            'link' => url('/federal-vs-private-20-21')
        ],
    ];
@endphp

<div class="jumbotron bg-white my-0" id="resources-cards">
    <div class="container">
        <div class="row justify-content-center">
            @foreach($resources as $resource)
                <div class="col-12 col-lg-4 mb-3 px-0 px-lg-3">
                    <div class="card h-100 border-0" style="box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.07); border-radius: 10px">
                        <div class="card-header bg-white" style=" border-color:rgba(39,141,135,0.25); border-bottom-width: 2px">
                            <h3 class="off-black text-center" style="font-family: CooperMediumBT; line-height: 1.2">{!! $resource['title'] !!}</h3>
                        </div>
                        <div class="card-body">
                            <p class="resources-cards-text">
                                {!! $resource['description'] !!}
                            </p>
                        </div>
                        <div class="card-footer bg-white text-center border-0">
                            @if(isset($resource['disable']) && $resource['disable'])
                                <button class="btn disabled btn-disabled btn-outline-primary btn-block">{{ $resource['cta'] }}</button>
                            @else
                                <a target="_blank" href="{{ $resource['link'] }}" class="btn btn-outline-primary btn-block">{{ $resource['cta'] }} <i class="fa fa-external-link"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
