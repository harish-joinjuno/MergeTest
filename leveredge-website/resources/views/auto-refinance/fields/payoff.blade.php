<div class="form-group">
    <label for="payoff_amount">Payoff Amount
        <i  class="fas fa-question-circle"
            data-toggle="tooltip"
            data-placement="top"
            title="How much you will have to pay to satisfy the terms of your loan and completely pay off
                            your debt."
        ></i>
    </label>
    {{Form::text('payoff_amount',$autoRefinanceApplication->payoff_amount ,['class' => 'form-control',
            'placeholder' => 'Payoff Amount','id' => 'payoff_amount', 'required' => 'required'])}}
    @if ($errors->has('payoff_amount'))
        <span class="text-danger">
            {{ $errors->first('payoff_amount') }}
        </span>
    @endif
</div>
