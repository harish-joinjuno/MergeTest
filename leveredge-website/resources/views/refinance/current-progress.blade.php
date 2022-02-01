@extends('template.public')


@php

    function custom_number_format($n, $precision = 1) {
        if ($n < 10000){
            // Anything less than 10K
            $n_format = number_format($n);
        } else if ($n < 1000000) {
            // Anything less than a million
            $n_format = number_format($n / 1000, $precision) . 'K';
        } else if ($n < 1000000000) {
            // Anything less than a billion
            $n_format = number_format($n / 1000000, $precision) . 'M';
        } else {
            // At least a billion
            $n_format = number_format($n / 1000000000, $precision) . 'B';
        }
    
        return $n_format;
    }
    
        $number_of_subscribers = count($subscribers);
        $total_loan_amount = 0;
        $number_of_subscribers_with_loan_amount = 0;
        $number_of_subscribers_with_credit_score = 0;
        $number_of_subscribers_with_university = 0;
        $number_of_subscribers_with_program = 0;
        
        $number_of_domestic_subscribers = 0;
        $total_domestic_loan_amount = 0;
        $number_of_domestic_subscribers_with_loan_amount = 0;
        $number_of_domestic_subscribers_with_credit_score = 0;
        $number_of_domestic_subscribers_with_university = 0;
        $number_of_domestic_subscribers_with_program = 0;
        
        $number_of_international_subscribers = 0;
        $total_international_loan_amount = 0;
        $number_of_international_subscribers_with_loan_amount = 0;
        $number_of_international_subscribers_with_credit_score = 0;
        $number_of_international_subscribers_with_university = 0;
        $number_of_international_subscribers_with_program = 0;
    
        $credit_score_count = [];
        $university_count = [];
        $program_count = [];
    
        $credit_score_domestic_count = [];
        $university_domestic_count = [];
        $program_domestic_count = [];
        
        $credit_score_international_count = [];
        $university_international_count = [];
        $program_international_count = [];
        
        $credit_score_loan_amount = [];
        $university_loan_amount = [];
        $program_loan_amount = [];
    
        $credit_score_domestic_loan_amount = [];
        $university_domestic_loan_amount = [];
        $program_domestic_loan_amount = [];
        
        $credit_score_international_loan_amount = [];
        $university_international_loan_amount = [];
        $program_international_loan_amount = [];
    
    
    
        foreach($subscribers as $subscriber){
    
            if($subscriber->loan_amount){
                $total_loan_amount += $subscriber->loan_amount;
                $number_of_subscribers_with_loan_amount += 1;
                
                
                if($subscriber->credit_score){
                    if( array_key_exists($subscriber->credit_score,$credit_score_loan_amount) ){
                        $credit_score_loan_amount[$subscriber->credit_score] += $subscriber->loan_amount;
                    }else{
                        $credit_score_loan_amount[$subscriber->credit_score] = $subscriber->loan_amount;
                    }
                }
    
                if($subscriber->university){
                    if( array_key_exists($subscriber->university,$university_loan_amount) ){
                        $university_loan_amount[$subscriber->university] += $subscriber->loan_amount;
                    }else{
                        $university_loan_amount[$subscriber->university] = $subscriber->loan_amount;
                    }
                }
                
                if($subscriber->program){
                    if( array_key_exists($subscriber->program,$program_loan_amount) ){
                        $program_loan_amount[$subscriber->program] += $subscriber->loan_amount;
                    }else{
                        $program_loan_amount[$subscriber->program] = $subscriber->loan_amount;
                    }
                }
                
            }
    
            if($subscriber->credit_score){
                if( array_key_exists($subscriber->credit_score,$credit_score_count) ){
                    $credit_score_count[$subscriber->credit_score] += 1;
                }else{
                    $credit_score_count[$subscriber->credit_score] = 1;
                }
                $number_of_subscribers_with_credit_score += 1;
            }
    
            if($subscriber->university){
                if( array_key_exists($subscriber->university,$university_count) ){
                    $university_count[$subscriber->university] += 1;
                }else{
                    $university_count[$subscriber->university] = 1;
                }
                $number_of_subscribers_with_university += 1;
            }
            
            if($subscriber->program){
                if( array_key_exists($subscriber->program,$program_count) ){
                    $program_count[$subscriber->program] += 1;
                }else{
                    $program_count[$subscriber->program] = 1;
                }
                $number_of_subscribers_with_program += 1;
            }
    
            if($subscriber->type == "Domestic Student"){
                $number_of_domestic_subscribers += 1;
    
                if($subscriber->loan_amount){
                    $total_domestic_loan_amount += $subscriber->loan_amount;
                    $number_of_domestic_subscribers_with_loan_amount += 1;
                    
                    if($subscriber->credit_score){
                        if( array_key_exists($subscriber->credit_score,$credit_score_domestic_loan_amount) ){
                            $credit_score_domestic_loan_amount[$subscriber->credit_score] += $subscriber->loan_amount;
                        }else{
                            $credit_score_domestic_loan_amount[$subscriber->credit_score] = $subscriber->loan_amount;
                        }
                    }
        
                    if($subscriber->university){
                        if( array_key_exists($subscriber->university,$university_domestic_loan_amount) ){
                            $university_domestic_loan_amount[$subscriber->university] += $subscriber->loan_amount;
                        }else{
                            $university_domestic_loan_amount[$subscriber->university] = $subscriber->loan_amount;
                        }
                    }
                    
                    if($subscriber->program){
                        if( array_key_exists($subscriber->program,$program_domestic_loan_amount) ){
                            $program_domestic_loan_amount[$subscriber->program] += $subscriber->loan_amount;
                        }else{
                            $program_domestic_loan_amount[$subscriber->program] = $subscriber->loan_amount;
                        }
                    }
                    
                }
    
                if($subscriber->credit_score){
                    if( array_key_exists($subscriber->credit_score,$credit_score_domestic_count) ){
                        $credit_score_domestic_count[$subscriber->credit_score] += 1;
                    }else{
                        $credit_score_domestic_count[$subscriber->credit_score] = 1;
                    }
                    $number_of_domestic_subscribers_with_credit_score += 1;
                }
    
                if($subscriber->university){
                    if( array_key_exists($subscriber->university,$university_domestic_count) ){
                        $university_domestic_count[$subscriber->university] += 1;
                    }else{
                        $university_domestic_count[$subscriber->university] = 1;
                    }
                    $number_of_domestic_subscribers_with_university += 1;
                }
                
                if($subscriber->program){
                    if( array_key_exists($subscriber->program,$program_domestic_count) ){
                        $program_domestic_count[$subscriber->program] += 1;
                    }else{
                        $program_domestic_count[$subscriber->program] = 1;
                    }
                    $number_of_domestic_subscribers_with_program += 1;
                }
            }
            
            if($subscriber->type == "International Student"){
                $number_of_international_subscribers += 1;
    
                if($subscriber->loan_amount){
                    $total_international_loan_amount += $subscriber->loan_amount;
                    $number_of_international_subscribers_with_loan_amount += 1;
                    
                    
                    if($subscriber->credit_score){
                        if( array_key_exists($subscriber->credit_score,$credit_score_international_loan_amount) ){
                            $credit_score_international_loan_amount[$subscriber->credit_score] += $subscriber->loan_amount;
                        }else{
                            $credit_score_international_loan_amount[$subscriber->credit_score] = $subscriber->loan_amount;
                        }
                    }
        
                    if($subscriber->university){
                        if( array_key_exists($subscriber->university,$university_international_loan_amount) ){
                            $university_international_loan_amount[$subscriber->university] += $subscriber->loan_amount;
                        }else{
                            $university_international_loan_amount[$subscriber->university] = $subscriber->loan_amount;
                        }
                    }
                    
                    if($subscriber->program){
                        if( array_key_exists($subscriber->program,$program_international_loan_amount) ){
                            $program_international_loan_amount[$subscriber->program] += $subscriber->loan_amount;
                        }else{
                            $program_international_loan_amount[$subscriber->program] = $subscriber->loan_amount;
                        }
                    }
                    
                }
                
                if($subscriber->credit_score){
                    if( array_key_exists($subscriber->credit_score,$credit_score_international_count) ){
                        $credit_score_international_count[$subscriber->credit_score] += 1;
                    }else{
                        $credit_score_international_count[$subscriber->credit_score] = 1;
                    }
                    $number_of_international_subscribers_with_credit_score += 1;
                }
    
                if($subscriber->university){
                    if( array_key_exists($subscriber->university,$university_international_count) ){
                        $university_international_count[$subscriber->university] += 1;
                    }else{
                        $university_international_count[$subscriber->university] = 1;
                    }
                    $number_of_international_subscribers_with_university += 1;
                }
                
                if($subscriber->program){
                    if( array_key_exists($subscriber->program,$program_international_count) ){
                        $program_international_count[$subscriber->program] += 1;
                    }else{
                        $program_international_count[$subscriber->program] = 1;
                    }
                    $number_of_international_subscribers_with_program += 1;
                }
                
            }
            
        }
    
        $average_loan_amount = $total_loan_amount / $number_of_subscribers_with_loan_amount;
        $implied_total_loan_amount = $average_loan_amount*$number_of_subscribers;
    
        $average_domestic_loan_amount = $total_domestic_loan_amount / $number_of_domestic_subscribers_with_loan_amount;
        $implied_total_domestic_loan_amount = $average_domestic_loan_amount * $number_of_domestic_subscribers;
        
        $average_international_loan_amount = $total_international_loan_amount / $number_of_international_subscribers_with_loan_amount;
        $implied_total_international_loan_amount = $average_international_loan_amount * $number_of_international_subscribers;
    
        ksort($credit_score_count);
        arsort($university_count);
        arsort($program_count);
    
        ksort($credit_score_loan_amount);
        arsort($university_loan_amount);
        arsort($program_loan_amount);
    

@endphp

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Refinance Negotiation Progress</h1>
                <div class="separator"></div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <h3>Group Size</h3>

                <table class="table">
                    <tr>
                        <th></th>
                        <th>Domestic</th>
                        <th>International</th>
                        <th>Total</th>
                    </tr>

                    <tr>
                        <td># of Students</td>
                        <td>{{ $number_of_domestic_subscribers }}</td>
                        <td>{{ $number_of_international_subscribers }}</td>
                        <td>{{ $number_of_subscribers }}</td>
                    </tr>

                    <tr>
                        <td>Loan Volume (Direct)</td>
                        <td>${{ custom_number_format($total_domestic_loan_amount) }}</td>
                        <td>${{ custom_number_format($total_international_loan_amount) }}</td>
                        <td>${{ custom_number_format($total_loan_amount) }}</td>
                    </tr>

                    <tr>
                        <td>Average Loan Amount</td>
                        <td>${{ custom_number_format($average_domestic_loan_amount) }}</td>
                        <td>${{ custom_number_format($average_international_loan_amount) }}</td>
                        <td>${{ custom_number_format($average_loan_amount) }}</td>
                    </tr>

                    <tr>
                        <td>Loan Volume (Implied)</td>
                        <td>${{ custom_number_format($implied_total_domestic_loan_amount) }}</td>
                        <td>${{ custom_number_format($implied_total_international_loan_amount) }}</td>
                        <td>${{ custom_number_format( $implied_total_loan_amount) }}</td>
                    </tr>


                </table>


            </div>
        </div>


        <div class="row mt-4">
            <div class="col-12">
                <h3>Credit Score Distribution</h3>
                <table class="table">
                    <tr>
                        <th>Credit Score</th>
                        <th>Domestic</th>
                        <th>International</th>
                        <th>Total</th>
                    </tr>

                    @foreach($credit_score_count as $score => $count)
                        <tr>
                            <td>{{ $score }}</td>
                            <td>
                                @if(isset($credit_score_domestic_count[$score]))
                                    {{ $credit_score_domestic_count[$score] }} ({{ custom_number_format($credit_score_domestic_count[$score]/$number_of_domestic_subscribers_with_credit_score*100,1) }} %)
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                @if(isset($credit_score_international_count[$score]))
                                    {{ $credit_score_international_count[$score] }} ({{ custom_number_format($credit_score_international_count[$score]/$number_of_international_subscribers_with_credit_score*100,1) }} %)
                                @else
                                    0
                                @endif
                            </td>
                            <td>{{ $count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-12">
                <h3>Credit Score Distribution</h3>
                <table class="table">
                    <tr>
                        <th>Credit Score</th>
                        <th>Domestic</th>
                        <th>International</th>
                        <th>Total</th>
                    </tr>

                    @foreach($credit_score_loan_amount as $score => $loan_amount)
                        <tr>
                            <td>{{ $score }}</td>
                            <td>
                                @if(isset($credit_score_domestic_loan_amount[$score]))
                                    {{ custom_number_format($credit_score_domestic_loan_amount[$score])  }}
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                @if(isset($credit_score_international_loan_amount[$score]))
                                    {{ custom_number_format($credit_score_international_loan_amount[$score]) }}
                                @else
                                    0
                                @endif
                            </td>
                            <td>{{ custom_number_format($loan_amount) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-12">
                <h3>Distribution by University (only universities with at least 10 members shown)</h3>

                <table class="table">

                    <tr>
                        <th>University</th>
                        <th>Domestic</th>
                        <th>International</th>
                        <th>Total</th>
                    </tr>


                    @foreach($university_count as $university => $count)
                        @if($count >= 10)
                        <tr>
                            <td>{{ $university }}</td>
                            <td>
                                @if(isset($university_domestic_count[$university]))
                                    {{ $university_domestic_count[$university] }} ({{ custom_number_format($university_domestic_count[$university]/$number_of_domestic_subscribers_with_university*100,1) }} %)
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                @if(isset($university_international_count[$university]))
                                    {{ $university_international_count[$university] }} ({{ custom_number_format($university_international_count[$university]/$number_of_international_subscribers_with_university*100,1) }} %)
                                @else
                                    0
                                @endif
                            </td>
                            <td>{{ $count }}</td>
                        </tr>
                        @endif
                    @endforeach

                </table>

            </div>
        </div>




        <div class="row mt-4">
            <div class="col-12">
                <h3>Distribution by Program (only programs with at least 5 members shown)</h3>

                <table class="table">

                    <tr>
                        <th>Program</th>
                        <th>Domestic</th>
                        <th>International</th>
                        <th>Total</th>
                    </tr>


                    @foreach($program_count as $program => $count)
                        @if($count >= 5)
                        <tr>
                            <td>{{ $program }}</td>
                            <td>
                                @if(isset($program_domestic_count[$program]))
                                    {{ $program_domestic_count[$program] }} ({{ custom_number_format($program_domestic_count[$program]/$number_of_domestic_subscribers_with_program*100,1) }} %)
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                @if(isset($program_international_count[$program]))
                                    {{ $program_international_count[$program] }} ({{ custom_number_format($program_international_count[$program]/$number_of_international_subscribers_with_program*100,1) }} %)
                                @else
                                    0
                                @endif
                            </td>
                            <td>{{ $count }}</td>
                        </tr>
                        @endif
                    @endforeach

                </table>

            </div>
        </div>

    </div>




@endsection


@push('footer-scripts')

@endpush
