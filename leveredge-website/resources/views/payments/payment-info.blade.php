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
            <div class="row mt-5">
                <div class="col-12 col-sm-8">
                    <div class="row">
                        <div class="col-12 bg-primary text-white p-3 rounded-top">
                            <h6 class="mb-0">Payment Info</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col border mb-3 rounded-bottom p-3">
                            <div class="row">
                                <div class="col-12 col-sm-auto d-flex flex-column">
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
                                        data-open-tab="paytmSelections"
                                        role="tab"
                                        aria-selected="false"
                                        aria-setsize="5"
                                        aria-posinset="4"
                                        tabindex="0"
                                        class="btn mb-3 px-3 text-left"
                                    >
                                        Paytm
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

                                <div class="col py-3 py-sm-0">
                                    <div
                                        id="creditCardSelections"
                                        role="tabpanel"
                                        aria-hidden="false"
                                        class="payment-tab row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for="credit_card_number">Card Number</label>
                                                    <input
                                                        id="credit_card_number"
                                                        type="text"
                                                        class="form-control"
                                                        inputmode="numeric"
                                                    >
                                                </div>
                                                <div class="col-12 col-lg-6 form-group">
                                                    <label for="credit_card_month">Expiry Date</label>
                                                    <div class="row">
                                                        <div class="col-6 pr-1">
                                                            <select
                                                                id="credit_card_month"
                                                                class="form-control"
                                                            >
                                                                <option disabled selected>Month</option>
                                                                @for($i = 1; $i <= 12; $i++)
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-6 pl-1">
                                                            <select
                                                                id="credit_card_year"
                                                                class="form-control"
                                                            >
                                                                <option disabled selected>Year</option>
                                                                @for($y = date('Y'); $y < date('Y') + 10; $y++)
                                                                    <option value="{{ $y }}">{{ $y }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 form-group">
                                                    <label for="credit_card_cvv">CVV</label>
                                                    <div class="row">
                                                        <div class="col-6 pr-1">
                                                            <input
                                                                id="credit_card_cvv"
                                                                type="text"
                                                                class="form-control"
                                                                inputmode="numeric"
                                                            >
                                                        </div>
                                                        <div class="col-6 px-0">
                                                            <img
                                                                alt="CVV Help"
                                                                src="{{ asset('/img/cvv-help.png') }}"
                                                                style="height:42px;width:auto;"
                                                            >
                                                        </div>
                                                    </div>
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
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for="debit_card_type">We Accept</label>
                                                    <select
                                                        id="debit_card_type"
                                                        class="form-control"
                                                    >

                                                        <option disabled selected>Select Debit Card</option>
                                                        <option>MasterCard Debit Card</option>
                                                        <option>Maestro Debit Card</option>
                                                        <option>ICICI Bank</option>
                                                        <option>RuPay</option>
                                                        <option>State Bank of India</option>
                                                        <option>Visa Debit Card</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="debit_card_number">Card Number</label>
                                                    <input
                                                        id="debit_card_number"
                                                        type="text"
                                                        class="form-control"
                                                        inputmode="numeric"
                                                    >
                                                </div>
                                                <div class="col-12 col-lg-6 form-group">
                                                    <label for="debit_card_month">Expiry Date</label>
                                                    <div class="row">
                                                        <div class="col-6 pr-1">
                                                            <select
                                                                id="debit_card_month"
                                                                class="form-control"
                                                            >
                                                                <option disabled selected>Month</option>
                                                                @for($i = 1; $i <= 12; $i++)
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-6 pl-1">
                                                            <select
                                                                id="debit_card_year"
                                                                class="form-control"
                                                            >
                                                                <option disabled selected>Year</option>
                                                                @for($y = date('Y'); $y < date('Y') + 10; $y++)
                                                                    <option value="{{ $y }}">{{ $y }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 form-group">
                                                    <label for="debit_card_cvv">CVV</label>
                                                    <div class="row">
                                                        <div class="col-6 pr-1">
                                                            <input
                                                                id="debit_card_cvv"
                                                                type="text"
                                                                class="form-control"
                                                                inputmode="numeric"
                                                            >
                                                        </div>
                                                        <div class="col-6 px-0">
                                                            <img
                                                                alt="CVV Help"
                                                                src="{{ asset('/img/cvv-help.png') }}"
                                                                style="height:42px;width:auto;"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $banks = [
                                            'Airtel Bank',
                                            'Allahabad Bank',
                                            'Andhra Bank',
                                            'AU Small Finance Bank',
                                            'Axis Bank',
                                            'Bank of Baroda',
                                            'Bank of India',
                                            'Bank of Maharashtra',
                                            'Bandhan Bank',
                                            'Canara Bank',
                                            'Catholic Syrian Bank',
                                            'Central Bank of India',
                                            'Citi Bank',
                                            'City Union Bank',
                                            'Corporation Bank',
                                            'Cosmos Bank',
                                            'DBS',
                                            'DCB Bank',
                                            'Deutsche Bank',
                                            'Dhanlaxmi Bank',
                                            'Equitas Small Finance Bank',
                                            'Federal Bank',
                                            'HDFC Bank',
                                            'ICICI Bank',
                                            'IDBI Bank',
                                            'IDFC First Bank',
                                            'Indian Bank',
                                            'Indian Overseas Bank',
                                            'Induslnd Bank',
                                            'Janata Sahakari Bank',
                                            'Jana Small Finance Bank',
                                            'J&K Bank',
                                            'Karnataka Bank',
                                            'Karur Vysya Bank',
                                            'Kotak Mahindra Bank',
                                            'Lakshmi Vilas Bank',
                                            'NKGSB Bank',
                                            'Punjab & Sind Bank',
                                            'Punjab National Bank',
                                            'RBL Bank',
                                            'RBS',
                                            'Saraswat Bank',
                                            'SVC Co-operative Bank',
                                            'South Indian Bank',
                                            'Standard Chartered Bank',
                                            'State Bank of India',
                                            'Syndicate Bank',
                                            'UCO Bank',
                                            'Union Bank of India',
                                        ];
                                    @endphp

                                    <div
                                        id="netBankingSelections"
                                        role="tabpanel"
                                        aria-hidden="true"
                                        class="payment-tab row d-none">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label for="debit_card_type">Select a Bank</label>
                                                    <select
                                                        id="wallets_type"
                                                        class="form-control"
                                                    >
                                                        <option disabled selected>Select a Bank</option>
                                                        @foreach($banks as $bank)
                                                            <option>{{ $bank }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <p class="small my-3">
                                                <strong>Note:</strong>
                                                We will redirect you to the bank you have chosen above.
                                                Once the bank verifies your net banking credentials, we will
                                                proceed with your payment.
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        id="upiSelections"
                                        role="tabpanel"
                                        aria-hidden="true"
                                        class="payment-tab row d-none">
                                        <div class="col">
                                            <div class="row px-2">
                                                <div class="col-12 col-lg-4 mb-3 payment-radio">
                                                    <input
                                                        id="upi_bhim"
                                                        name="upi"
                                                        value="bhm"
                                                        type="radio">
                                                    <label for="upi_bhim">
                                                        BHIM
                                                        <img
                                                            alt="BHIM"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/bhim.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>

                                                <div class="col-12 col-lg-4 mb-3 payment-radio">
                                                    <input
                                                        id="upi_phonepe"
                                                        name="upi"
                                                        value="phonepe"
                                                        type="radio">
                                                    <label for="upi_phonepe">
                                                        PhonePe
                                                        <img
                                                            alt="PhonePe"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/phonepe.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>

                                                <div class="col-12 col-lg-4 mb-3 payment-radio">
                                                    <input
                                                        id="upi_gpay"
                                                        name="upi"
                                                        value="gpay"
                                                        type="radio">
                                                    <label for="upi_gpay">
                                                        GPay
                                                        <img
                                                            alt="PayTM"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/gpay.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>

                                                <div class="col-12 col-lg-4 mb-3 payment-radio">
                                                    <input
                                                        id="upi_paytm"
                                                        name="upi"
                                                        value="paytm"
                                                        type="radio">
                                                    <label for="upi_paytm">
                                                        PayTM
                                                        <img
                                                            alt="PayTM"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/paytm.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>

                                                <div class="col-12 col-lg-4 mb-3 payment-radio">
                                                    <input
                                                        id="upi_whatsapp"
                                                        name="upi"
                                                        value="whatsapp"
                                                        type="radio">
                                                    <label for="upi_whatsapp">
                                                        WhatsApp
                                                        <img
                                                            alt="PayTM"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/whatsapp.png') }}"
                                                            class="float-right"
                                                        >
                                                    </label>
                                                </div>

                                                <div class="col-12 col-lg-4 mb-3 payment-radio">
                                                    <input
                                                        id="upi_ccavenue"
                                                        name="upi"
                                                        value="ccavenue"
                                                        type="radio">
                                                    <label for="upi_ccavenue" class="show text-right">
                                                        <i class="fas fa-th mx-1"></i> Other UPI
                                                    </label>
                                                </div>


                                                <div class="col-12 form-group mt-3">
                                                    <label for="upi_id">Enter your UPI ID</label>
                                                    <input
                                                        id="upi_id"
                                                        type="text"
                                                        class="form-control"
                                                        inputmode="numeric"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        id="paytmSelections"
                                        role="tabpanel"
                                        aria-hidden="true"
                                        class="payment-tab row d-none">
                                        <div class="col">
                                            <div class="row px-2">
                                                <div class="col-12 col-lg-4 mb-3 payment-radio">
                                                    <input
                                                        id="paytm_paytm"
                                                        name="paytm"
                                                        value="paytm"
                                                        checked
                                                        type="radio">
                                                    <label for="paytm_paytm">
                                                        Paytm
                                                        <img
                                                            alt="Paytm"
                                                            aria-hidden="true"
                                                            src="{{ asset('/img/payments-logos/paytm.png') }}"
                                                            class="float-right"
                                                        >
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
                                            <div class="row">
                                                <div class="col-12 my-3">
                                                    <label for="debit_card_type">Select Wallet</label>
                                                    <select
                                                        id="wallets_type"
                                                        class="form-control"
                                                    >
                                                        <option disabled selected>Select Wallet</option>
                                                        <option>Mobikwik</option>
                                                        <option>OlaMoney(Postpaid-Wallet)</option>
                                                        <option>jioMoney</option>
                                                        <option>FreeCharge</option>
                                                        <option>ICash Card</option>
                                                        <option>ICICI Pockets</option>
                                                        <option>Itz Cash Card</option>
                                                        <option>Money on Mobile</option>
                                                        <option>The Mobile Wallet</option>
                                                        <option>Vodafone M-Pesa</option>
                                                        <option>YES Bank</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-12 mb-5">
                                            <p class="small">
                                                I agree with the
                                                <a href="{{ url('/privacy') }}">privacy policy</a>
                                                by proceeding with this payment.
                                            </p>
                                            <h3 class="text-primary d-inline-block mb-0 mr-2">$99.00</h3>
                                            <small class="d-inline-block">(Total Amount Payable)</small>
                                        </div>

                                        @push('footer-scripts')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#submitButton').click(function() {
                                                        window.location.href = '{{ url('/payments/failed') }}';
                                                    });
                                                });
                                            </script>
                                        @endpush

                                        <div class="col-12 col-lg-auto text-center mt-3">
                                            <button
                                                id="submitButton"
                                                class="btn btn-primary text-white rounded-lg px-5"
                                            >
                                                Make Payment
                                            </button>
                                        </div>
                                        <div class="col-12 col-lg-auto text-center mt-3">
                                            <a
                                                href="{{ url('payments-test-prep') }}"
                                                class="btn btn-sm text-muted rounded-lg"
                                            >
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-4 mb-5 px-0 px-sm-3">
                    <div class="col border mb-3 rounded-lg p-4">
                        <h5>Order Details</h5>
                        <p class="small mb-0">
                            Order #:
                            <span class="float-right font-semibold">
                                {{ date('Y') }}-{{ rand(10000, 99999) }}-1
                            </span>
                        </p>
                        <hr>
                        <p class="small mb-0">
                            Order Amount:
                            <span class="float-right font-semibold">
                                $99.00
                            </span>
                        </p>
                        <hr>
                        <h6 class="mb-3 font-weight-bold">
                            Total Amount:
                            <span class="float-right">
                                $99.00
                            </span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
