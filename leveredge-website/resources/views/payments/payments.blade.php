@extends('template.public')

@push('header-scripts')
    <link href="{{mix('mix/css/styles.css')}}?ver=1.1" rel="stylesheet" type="text/css">
    @include('landing-pages.partials._landing-pages-styles')
    <style>
        .payment-radio {
            position:relative;
            height:40px;
        }
        .payment-radio label {
            font-size:0;
            position:absolute;
            top:0;
            bottom:0;
            left:.25rem;
            right:.25rem;
            padding:.5rem;
            margin:0;
            border:1px solid transparent;
            border-radius:5px;
            box-shadow:1px 2px 4px rgba(0,0,0,.05);
            cursor:pointer;
        }
        .payment-radio label:before, .payment-radio label:after {
            content: '';
            position:absolute;
            top:50%;
            left:20px;
            transform:translate(-50%, -50%);
            border-radius:50%;
        }
        .payment-radio label:before {
            height:20px;
            width:20px;
            border:1px solid #dee2e6;
        }
        .payment-radio label:after {
            height:10px;
            width:10px;
            background:#fff;
        }
        .payment-radio label.show {
            font-size:14px;
            padding-left:2.5rem;
        }
        .payment-radio label img {
            max-width:65%;
            position:relative;
            top:50%;
            transform:translateY(-50%);
        }
        .payment-radio input {
            opacity:0;
        }
        .payment-radio input:checked ~ label {
            border-color:#278D87;
        }
        .payment-radio input:checked ~ label:before {
            background:#278D87;
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        $(document).ready(function() {
            const tabButtons = $('[data-open-tab]');
            const paymentTabs = $('.payment-tab');

            tabButtons.click(function() {
                const tab = $(this).data('open-tab');
                const tabToOpen = $('#' + tab);

                paymentTabs.addClass('d-none');
                paymentTabs.attr('aria-hidden', 'true');
                tabButtons.removeClass('text-primary bg-light-green');
                tabButtons.attr('aria-selected', 'false');

                $(this).addClass('text-primary bg-light-green');
                $(this).attr('aria-selected', 'true');
                tabToOpen.removeClass('d-none');
                tabToOpen.attr('aria-hidden', 'false');
            });
        });
    </script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="container py-5 my-sm-5">
            <h2 class="text-center">Our mission is to reduce the cost of education using group buying power.</h2>
            <p class="text-center">We are purchasing thousands of test prep packages and giving our members a massive discount. </p>

            <div class="row mt-5">
                <div class="col-12 col-sm-7 mb-5">
                    <h5 class="mb-5 text-center">SAT and ACT Test Prep from The Princeton Review</h5>

                    <div class="row justify-content-center text-center mb-5">
                        <table class="col-12 col-sm-auto rounded font-semibold text-nowrap">
                            <thead>
                            <tr>
                                <td class="col-12 bg-primary text-white py-2 text-uppercase rounded-top small">
                                    Special Offer
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="row align-items-center mx-0 py-1 mt-1 border-left border-right">
                                <td class="col-8 text-left pr-5">
                                    <s>Regular Price</s>
                                </td>
                                <td class="col-4 text-right">
                                    <s>$299</s>
                                </td>
                            </tr>
                            <tr class="row align-items-center mx-0 py-1 border-bottom border-left border-right rounded-bottom">
                                <td class="col-8 text-left font-weight-bold pr-5">
                                    Juno Member Deal
                                </td>
                                <td class="col-4 text-right text-primary font-weight-bold h4">
                                    $99
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <p class="mb-5">Claim your discount before our licenses run out by completing payment.</p>

                    <img
                        src="{{ asset('/img/payment-step.png') }}"
                        alt="Payment Step"
                        class="img-fluid px-5"
                    >
                </div>

                <div class="col-12 col-sm-5">
                    <div class="row">
                        <div class="col border mb-3 rounded-lg p-4">
                            <h3 class="float-right font-semibold">$99</h3>
                            <h5>Total Payable Amount</h5>
                            <p class="small mb-0">Princeton Review SAT ® & ACT ® Self-Paced</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col border mb-3 rounded-lg p-3">
                            <div class="row">
                                <div class="col-auto d-flex flex-column">
                                    <button
                                        data-open-tab="creditCardSelections"
                                        role="tab"
                                        aria-selected="true"
                                        aria-setsize="5"
                                        aria-posinset="1"
                                        tabindex="0"
                                        class="btn text-primary bg-light-green mb-3 px-3 text-left">
                                        Credit Card
                                    </button>

                                    <button
                                        data-open-tab="debitCardSelections"
                                        role="tab"
                                        aria-selected="false"
                                        aria-setsize="5"
                                        aria-posinset="2"
                                        tabindex="0"
                                        class="btn mb-3 px-3 text-left">
                                        Debit Card
                                    </button>

                                    <button
                                        data-open-tab="netBankingSelections"
                                        role="tab"
                                        aria-selected="false"
                                        aria-setsize="5"
                                        aria-posinset="3"
                                        tabindex="0"
                                        class="btn mb-3 px-3 text-left"
                                    >
                                        Net Banking
                                    </button>

                                    <button
                                        data-open-tab="upiSelections"
                                        role="tab"
                                        aria-selected="false"
                                        aria-setsize="5"
                                        aria-posinset="4"
                                        tabindex="0"
                                        class="btn mb-3 px-3 text-left"
                                    >
                                        UPI
                                    </button>

                                    <button
                                        data-open-tab="walletsSelections"
                                        role="tab"
                                        aria-selected="false"
                                        aria-setsize="5"
                                        aria-posinset="5"
                                        tabindex="0"
                                        class="btn mb-3 px-3 text-left"
                                    >
                                        Wallets
                                    </button>
                                </div>

                                <div class="col border-left">
                                    <div
                                        id="creditCardSelections"
                                        role="tabpanel"
                                        aria-hidden="false"
                                        class="payment-tab row">
                                        <div class="col">
                                            <p class="small mt-2">
                                                Select your Credit Card
                                            </p>
                                            <div class="row px-2">
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="credit_cards_visa"
                                                        name="credit_cards"
                                                        value="visa"
                                                        type="radio">
                                                    <label for="credit_cards_visa">
                                                        Visa
                                                        <img
                                                            alt="Visa"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/visa.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="credit_cards_mastercard"
                                                        name="credit_cards"
                                                        value="mastercard"
                                                        type="radio">
                                                    <label for="credit_cards_mastercard">
                                                        Mastercard
                                                        <img
                                                            alt="Mastercard"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/mastercard.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="credit_cards_amex"
                                                        name="credit_cards"
                                                        value="amex"
                                                        type="radio">
                                                    <label for="credit_cards_amex">
                                                        American Express
                                                        <img
                                                            alt="American Express"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/amex.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="credit_cards_rupay"
                                                        name="credit_cards"
                                                        value="rupay"
                                                        type="radio">
                                                    <label for="credit_cards_rupay">
                                                        Rupay
                                                        <img
                                                            alt="Rupay"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/rupay.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="credit_cards_diners_club"
                                                        name="credit_cards"
                                                        value="diners_club"
                                                        type="radio">
                                                    <label for="credit_cards_diners_club">
                                                        Diners Club
                                                        <img
                                                            alt="Diners Club"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/diners-club.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        id="debitCardSelections"
                                        role="tabpanel"
                                        aria-hidden="true"
                                        class="payment-tab row d-none">
                                        <div class="col">
                                            <p class="small mt-2">
                                                Select your Debit Card
                                            </p>
                                            <div class="row px-2">
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="debit_cards_visa"
                                                        name="debit_cards"
                                                        value="visa"
                                                        type="radio">
                                                    <label for="debit_cards_visa">
                                                        Visa
                                                        <img
                                                            alt="Visa"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/visa.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="debit_cards_mastercard"
                                                        name="debit_cards"
                                                        value="mastercard"
                                                        type="radio">
                                                    <label for="debit_cards_mastercard">
                                                        Mastercard
                                                        <img
                                                            alt="Mastercard"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/mastercard.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="debit_cards_rupay"
                                                        name="debit_cards"
                                                        value="rupay"
                                                        type="radio">
                                                    <label for="debit_cards_rupay">
                                                        Rupay
                                                        <img
                                                            alt="Rupay"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/rupay.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        id="netBankingSelections"
                                        role="tabpanel"
                                        aria-hidden="true"
                                        class="payment-tab row d-none">
                                        <div class="col">
                                            <p class="small mt-2">
                                                Select your Payment Gateway
                                            </p>
                                            <div class="row px-2">
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="net_banking_payu"
                                                        name="net_banking"
                                                        value="payu"
                                                        type="radio">
                                                    <label for="net_banking_payu" class="show">
                                                        PayU
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="net_banking_ccavenue"
                                                        name="net_banking"
                                                        value="ccavenue"
                                                        type="radio">
                                                    <label for="net_banking_ccavenue" class="show">
                                                        ccAvenue
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        id="upiSelections"
                                        role="tabpanel"
                                        aria-hidden="true"
                                        class="payment-tab row d-none">
                                        <div class="col">
                                            <p class="small mt-2">
                                                Select your Payment Gateway
                                            </p>
                                            <div class="row px-2">
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="upi_payu"
                                                        name="upi"
                                                        value="payu"
                                                        type="radio">
                                                    <label for="upi_payu" class="show">
                                                        PayU
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="upi_ccavenue"
                                                        name="upi"
                                                        value="ccavenue"
                                                        type="radio">
                                                    <label for="upi_ccavenue" class="show">
                                                        ccAvenue
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        id="walletsSelections"
                                        role="tabpanel"
                                        aria-hidden="true"
                                        class="payment-tab row d-none">
                                        <div class="col">
                                            <p class="small mt-2">
                                                Select your Wallet
                                            </p>
                                            <div class="row px-2">
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="wallets_paytm"
                                                        name="wallets"
                                                        value="paytem"
                                                        type="radio">
                                                    <label for="wallets_paytm">
                                                        PayTM
                                                        <img
                                                            alt="PayTM"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/paytm.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="wallets_mobikwik"
                                                        name="wallets"
                                                        value="mobikwik"
                                                        type="radio">
                                                    <label for="wallets_mobikwik">
                                                        Mobikwik
                                                        <img
                                                            alt="Mobikwik"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/mobikwik.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="wallets_freecharge"
                                                        name="wallets"
                                                        value="freecharge"
                                                        type="radio">
                                                    <label for="wallets_freecharge">
                                                        FreeCharge
                                                        <img
                                                            alt="FreeCharge"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/freecharge.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3 payment-radio">
                                                    <input
                                                        id="wallets_oxigen"
                                                        name="wallets"
                                                        value="oxigen"
                                                        type="radio">
                                                    <label for="wallets_oxigen">
                                                        Oxigen
                                                        <img
                                                            alt="Oxigen"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/oxigen.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="{{ url('payments-test-prep/payment') }}" class="btn btn-block btn-primary text-white rounded-lg">
                            Make Payment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
