<div class="card h-100">
    <div class="card-body d-flex flex-column">
        <h3>{{$title}}</h3>
        {{$slot}}
        <form class="mt-auto" action="{{route('user-profile.loan-type')}}" method="post">
            @csrf
            <input type="hidden" value="{{$nextPage}}" name="next_page" />
            <button class="btn btn-primary btn-block" type="submit" name="loan_type" value="{{$loanType}}">
                {{$button}}
            </button>
        </form>
    </div>
</div>
