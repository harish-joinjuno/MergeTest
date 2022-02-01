<div class="container">
    @if(userProfile()->showNotCurrentlyEmployedInfo() && userProfile()->showNotCurrentlyEmployedUntilDate())
        <div class="alert alert-info">
            Heads up! You indicated that you are not currently employed, and lenders generally require proof of employment in order to refinance.
        </div>
    @endif
    @if(userProfile()->showFederalInfo())
        <div class="alert alert-info">
            Most federal loans are at 0% interest until October 1! You're still free to only refinance private loans. 
        </div>
    @endif
</div>
