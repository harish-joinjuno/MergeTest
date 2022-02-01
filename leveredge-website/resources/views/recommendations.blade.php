@extends('template.public')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <h2>Recommendations</h2>
                <p>
                    We can help students and families with a ton, but we do even better when we work with amazing
                    organizations that share a common set of values and are committed to putting students first.
                </p>
                <p>
                    None of the partners on this page pay us to be featured. We recommend
                    these companies because we respect their work and have seen first hand their commitment to the
                    student community.
                </p>
            </div>

            <div class="col-md-4">
                <img src="{{ asset('/img/recommendations.svg') }}" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <h3>Personal MBA Coach</h3>

                <p>
                    Nikhil, the co-founder of Juno, worked directly with Scott at Personal MBA Coach.
                    With Scott’s help, Nikhil was admitted to several M7 programs including HBS, where Juno
                    was eventually born.
                </p>

                <p class="mt-4">
                    <a href="https://www.personalmbacoach.com/" target="_blank">Meet with Scott</a>
                </p>
            </div>

            <div class="col-md-4">
                <img src="{{ asset('/img/pmc-logo.png') }}" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <h3>AICCFC</h3>

                <p>
                    Chris, the co-founder of Juno, sought advice on how to finance graduate school and was
                    introduced to some creative strategies by Ross Riskin, founder of the AICCFC. The AICCFC
                    educates financial professionals in the areas of education funding, financial aid planning,
                    and student loan advising through the Certified College Financial Consultant (CCFC) designation
                    program.
                </p>

                <p class="mt-4">
                    <a href="https://www.aiccfc.org/" target="_blank">Learn more about AICCFC</a>
                </p>
            </div>

            <div class="col-md-2 offset-md-1">
                <img src="{{ asset('/img/ccfc-logo.png') }}" class="img-fluid">
            </div>

        </div>
    </div>

    <div class="py-5"></div>


    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <h3>College Funding Coach</h3>

                <p>
                    The College Funding Coach® was founded in 2002 to help families better understand the complex
                    strategies for paying for college and making higher education more affordable. Whether you’d like
                    to schedule a workshop at your school or meet individually with one of our advisors or just find
                    great resources and information about the college process, you’ve come to the right spot.
                </p>

                <p class="mt-4">
                    <a href="https://www.thecollegefundingcoach.org/" target="_blank">Learn more about the College Funding Coach</a>
                </p>
            </div>

            <div class="col-md-4 pt-0 pt-md-5">
                <img src="{{ asset('/img/college-funding-coach.jpg') }}" class="img-fluid">
            </div>

        </div>
    </div>

    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <h3>The Admission Concierge</h3>

                <p>
                    The Admission Concierge is a boutique-sized, one-on-one approach, consulting service specialized in
                    admissions in top MBA and MS programs. Loubna, former director of MBA admissions, founded The
                    Admission Concierge with a specific goal in mind:  To use her in-depth knowledge of the industry
                    and admissions process to help candidates get a competitive edge and help them craft a successful
                    application to the world’s most competitive MBA programs.  We guide you through the entire
                    application journey from school selection to crafting a persuasive application that highlights
                    your strengths and uniqueness, interview prep and beyond.
                </p>

                <p class="mt-4">
                    <a href="https://admissionconcierge.com/" target="_blank">Learn more about the Admission Concierge</a>
                </p>
            </div>

            <div class="col-md-4">
                <img src="{{ asset('/img/admission-concierge.jpg') }}" class="img-fluid">
            </div>

        </div>
    </div>

    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <h3>SoCal College Planning</h3>

                <p>
                    SoCal College Planning is your comprehensive guide to the overwhelming college admission and
                    financial aid processes. Our staff specializes in finding the best-fit university for our
                    passionate and dedicated students. We utilize standard practices, such as SAT Prep and EFC
                    calculations, as well as individualized approaches, including essay coaching and extra-curricular
                    planning to make attending dream colleges a reality.
                </p>

                <p class="mt-4">
                    <a href="https://admissionconcierge.com/" target="_blank">Learn more about the Admission Concierge</a>
                </p>
            </div>

            <div class="col-md-4">
                <img src="{{ asset('/img/socal-college-planning.jpg') }}" class="img-fluid">
            </div>

        </div>
    </div>

    <div class="py-5"></div>

@endsection
