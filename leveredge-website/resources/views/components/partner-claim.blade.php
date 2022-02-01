<div>

    @if($amountToBePaid)
        <h2>Claim Your Rewards</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table">
            <tr>
                <td><p>Your Unclaimed Rewards</p></td>
                <td><p class="float-right">${{ number_format($amountToBePaid) }}</p></td>
            </tr>
        </table>
        <p class="mt-4">Select a Payment Method</p>
        <form class="mt-3 mb-4" method="post" action="{{ route('partner.claim.store') }}"  id="payment-method-form">
            @csrf
            @foreach($paymentMethods as $paymentMethod)
                <div class="form-check">
                    {{Form::radio('payment_method_id', $paymentMethod->id , 'form-check-input')}}
                    <label class="form-check-label" for="payment_method_id">{{$paymentMethod->name}} to {{user()->email}}</label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary mt-3 btn-sm  " {{ $amountToBePaid ? '' : 'disabled' }}>
                Claim Rewards
            </button>
        </form>
    @endif

    @if(!$partner->partnerClaims->isEmpty())
        <h3>Partner Claims</h3>
        <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date Submitted</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    @foreach($partner->partnerClaims()->orderBy('created_at', 'desc')->get() as $claim)
                        <tr>
                            <td>{{ $claim->id }}</td>
                            <td>{{ $claim->created_at->format('m/d/Y g:i:s A') }}</td>
                            <td>${{ $claim->amount }}</td>
                            <td>
                                @switch($claim->status())
                                    @case('In Review')
                                    <span class="badge badge-secondary">In Review</span>
                                    @break
                                    @case('Paid')
                                    <span class="badge badge-success">Paid</span>
                                    @break
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </table>
    @endif
</div>
