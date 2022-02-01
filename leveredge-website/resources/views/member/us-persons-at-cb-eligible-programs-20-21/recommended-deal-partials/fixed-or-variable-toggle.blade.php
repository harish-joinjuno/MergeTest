<div class="container">
    <div class="row variable-or-fixed-row mb-4">
        <div class="col-12 text-center">
            <div class="btn-group" role="group" aria-label="Variable or Fixed Rate Options">
                <a href="{{ url('/member/negotiation-group/'.$negotiationGroupUser->negotiationGroup->id.'/variable-deal') }}" class="btn @if($selected == 'variable') btn-primary text-white @else btn-outline-primary @endif">Variable <span class="d-none d-md-inline">Rate</span> Option</a>
                <a href="{{ url('/member/negotiation-group/'.$negotiationGroupUser->negotiationGroup->id.'/fixed-deal') }}" class="btn @if($selected == 'fixed') btn-primary text-white @else btn-outline-primary @endif">Fixed <span class="d-none d-md-inline">Rate</span> Option</a>
            </div>
        </div>
    </div>
</div>
