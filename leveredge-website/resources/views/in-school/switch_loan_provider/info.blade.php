@extends('template.public')

@section('content')


    <div class="container mt-5">
        <div class="row">
            <div class="col-12">

                <h2>
                    Already approved for a federal or private student loan?
                    <br>
                    You can still take advantage of the negotiated deal.
                </h2>

                <div class="card mt-4">
                    <div class="card-header bg-white" id="headingTwo">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" href="#collapseTwo">
                                <h3 class="blue-color text-underline">I currently have a federal loan (direct loan / FAFSA)</h3>
                            </a>
                        </h5>
                    </div>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                        <div class="card-body">
                            <p>
                                Switching to the negotiated deal from the federal loan is simple. Follow the steps below to make the switch.
                            </p>

                            <ol class="mt-3">
                                <li>Apply for the Juno deal.</li>
                                <li>Assuming you are approved, inform the financial aid office that you want to reduce or cancel the federal loan.</li>
                                <li>That's it. You don't need to do anything else.</li>
                            </ol>

                            <p class="mt-3">
                                You don't have to pay the origination fee or any other fees if you cancel the federal loan prior to disbursement. <br>
                                You don't have to pay the origination fee or any other fees if you cancel the federal loan even up to 120 days after disbursement.
                            </p>

                            <p class="mt-3">
                                Here is an email template you can use to inform the financial aid office that you want to switch:
                            </p>

                            <div class="card">
                                <div class="card-body">
                                    <p id="text-for-sharing">
                                        Hi Financial Aid Office,
                                        <br><br>
                                        I applied for a student loan from [insert lender name here] and received better rates than the federal loan option.
                                        The amount of the loan is $XX,XXX.
                                        <br><br>
                                        I want to [reduce / cancel] the federal loan by the same amount.
                                        <br><br>
                                        Thank you,
                                        <br>
                                        [Your Name]
                                    </p>
                                </div>
                            </div>
                            <button class="btn btn-primary copy-button mt-3" data-clipboard-target="#text-for-sharing">Copy Letter to Clipboard</button>

                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header bg-white" id="headingOne">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" href="#collapseOne">
                                <h3 class="blue-color text-underline">I currently have a private loan</h3>
                            </a>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                        <div class="card-body">


                            <p class="mt-3">
                                <strong>If you recently accepted loan terms* and it’s more than 15 days from your tuition deadline</strong>
                            </p>


                            <ol class="mt-3">
                                <li>
                                    Apply for the Juno deal through the Juno link**
                                </li>


                                <li>
                                    Assuming you are approved, call the existing lender and cancel your loan
                                </li>

                                <li>
                                    Accept the terms to the new loan and kick off the certification process
                                </li>

                                <li>
                                    Inform your financial aid office via email or phone that you have canceled your first loan and plan on switching lenders
                                </li>

                            </ol>

                            <p class="mt-3 text-small">
                                *Private lenders are required to give you a ‘right-to-cancel’ period for at least 3 business days after you receive final disclosures (happens after your school certifies the loan)
                            </p>

                            <p class="text-small">
                                **Applying will cause a hard credit check - you can also call to confirm you are able to cancel your existing loan before you apply through Juno
                            </p>


                            <p class="mt-3">
                                <strong>If your loan has already been certified or it’s within 15 days of your tuition deadline</strong>
                            </p>

                            <ol class="mt-3">
                                <li>Apply for the Juno deal through the Juno link*</li>
                                <li>
                                    Contact your financial aid office to tell them you want to switch lenders
                                    <ol>
                                        <li>We recommend calling vs emailing</li>
                                        <li>Your financial aid office will either tell you to cancel the other loan yourself or will contact the lender themselves to cancel the other loan</li>
                                        <li>Your financial aid office may inform you there is a risk of a late fee - the certification process normally takes less than 7 business days</li>
                                    </ol>
                                </li>
                            </ol>


                            <p class="mt-3 text-small">
                                *Applying will cause a hard credit check - if you want to make sure you can switch before applying, it’s never a bad idea to give the financial aid office a call first
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="py-5 my-5"></div>

@endsection

@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

    <script>
        new ClipboardJS('.copy-button');
    </script>
@endpush
