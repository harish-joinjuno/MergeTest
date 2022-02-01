<div class="container-fluid bg-white px-0">
    <div class="py-5 bg-light-green"></div>
    <div class="container mt-n5">
        <div class="row align-items-stretch">
            @include('landing-pages.partials._deal-card', [
                'img' => asset('/img/briefcase-on-circle.png'),
                'title' => 'Graduate Student Loan Deal',
                'checklistItems' => [
                    'Rates from 1.04% APR
                    <sup class="foot-note-marker">1</sup> + up to 1% Cash Back',
'Fixed and variable options available',
                    'Exclusive rates up to 4% lower for members',
                ],
                'learnMoreUrl' => url('/loans/graduate')
            ])
            @include('landing-pages.partials._deal-card', [
                'img' => asset('/img/textbooks-on-circle.png'),
                'title' => 'Undergraduate Student Loan Deal',
                'checklistItems' => [
                    'Rates from 1.05% APR
                    <sup class="foot-note-marker">1</sup>',
'Fixed and variable options available',
                    'Exclusive rate discount of 1% for members',
                ],
                'learnMoreUrl' => url('/loans/undergraduate')
            ])
            @include('landing-pages.partials._deal-card', [
                'img' => asset('/img/refinance-check-on-circle.png'),
                'title' => 'Student Loan Refinancing Deal',
                'checklistItems' => [
                    'Rates from 1.89% APR
                    <sup class="foot-note-marker">1</sup>',
'Fixed and variable options available',
                    'Up to $1,000 cash back for members',
                ],
                'learnMoreUrl' => url('/refinance-campaign')
            ])
        </div>
    </div>
</div>
