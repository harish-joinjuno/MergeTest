@inject('userProfile', '\App\UserProfile')
<div class="form-group">
    <label for="state">Credit Score</label>
    {{Form::select('credit_score',$userProfile::CREDIT_SCORES,$autoRefinanceApplication->credit_score ,['class' => 'form-control','placeholder' => 'Credit Score','id' => 'credit_score'])}}
    @if ($errors->has('credit_score'))
        <span class="text-danger">
            {{ $errors->first('credit_score') }}
        </span>
    @endif
</div>
