<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="alert alert-info form-group dynamic d-none">
            <input
                id="{{ $question->field_name }}_visibilityPolicy"
                type="hidden"
                value="{{ json_encode($question->getVisibilityPolicyDefinition()) }}"
            >
            <p>
                <strong>Heads up:</strong>
                Since your current rate is below 7%, our lending partners may not be able to provide you with a substantially lower rate.
            </p>
        </div>
    </div>
</div>
