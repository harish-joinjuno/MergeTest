@push('header-scripts')
    <style>
        .row-to-col {
            display:flex;
            flex-direction:column;
            align-items:center;
        }

        @media screen and (max-width:768px) {
            .row-to-col {
                flex-direction:row;
                align-items:start;
                text-align:left;
            }
        }
    </style>
@endpush

@php
$showMedical = (isset($hideMedical) && ! $hideMedical) || ! isset($hideMedical);
$nonMedicalSectionTitle = isset($nonMedicalSectionTitle) ? $nonMedicalSectionTitle : 'Non-medical refinance loan';
@endphp

<div class="container-fluid py-5 bg-light">
    <div class="container narrow my-5 text-center px-0">
        <h1 class="off-black mb-3">Juno benefits</h1>
        <p class="mb-5">We’ll give you back a little extra for joining through us depending on your refinance option.</p>
        <div class="col-12 col-md-10 offset-md-2 col-lg-8 offset-lg-2">
            <div class="row">
                @if($showMedical)
                    <div class="row-to-col col-12 col-md-6 mb-3">
                        <img
                            src="{{ asset('/img/folded-medical-clothing.png') }}"
                            alt="Folded medical clothing"
                            style="width:100%;max-width:150px"
                        >
                        <div>
                            <p class="mb-4">
                                <strong>Medical refinance loan</strong>
                            </p>
                            <p class="small">
                                Our partner offers rates that are .25% lower (ex. 3.5% becomes 3.25%).
                            </p>
                        </div>
                    </div>
                @endif

                <div class="row-to-col col-12 col-md-6 mb-3 @if(! $showMedical)offset-lg-3 @endif">
                    <img
                        src="{{ asset('/img/textbooks.png') }}"
                        alt="Textbooks"
                        style="width:100%;max-width:150px"
                    >
                    <div>
                        <p class="mb-4">
                            <strong>{{ $nonMedicalSectionTitle }}</strong>
                        </p>
                        <p class="small">
                            You’ll receive up to $1,000 total (from both us and our partners) for refinancing through us.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
