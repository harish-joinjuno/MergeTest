<div class="card mt-2">
    <div class="card-header">
        <p>
            <a data-toggle="collapse" href="#taskBody{{ $campusAmbassadorTask->id }}" aria-expanded="false" aria-controls="taskBody{{$campusAmbassadorTask->id}}">
                {{ $campusAmbassadorTask->title }}
            </a>
        </p>
    </div>

    <div id="taskBody{{$campusAmbassadorTask->id}}" class="collapse">
        <div class="card-body">
            {!! $campusAmbassadorTask->body !!}
        </div>

        <div class="card-footer">
            @if($campusAmbassadorTask->task_completion_tracking == \App\CampusAmbassadorTask::TASK_COMPLETION_TRACKING_MANUAL)
                <a href="{{ url( $campusAmbassadorTask->task_completion_redirect ? $campusAmbassadorTask->task_completion_redirect : "/mark-task-complete/" . $campusAmbassadorTask->id ) }}" class="btn btn-primary ">Mark Complete</a>
            @elseif($campusAmbassadorTask->task_completion_tracking == \App\CampusAmbassadorTask::TASK_COMPLETION_TRACKING_AUTOMATIC)
                Task will be automatically marked as completed
            @endif

            <div class="float-right">
                @if($campusAmbassadorTask->payment_type == \App\CampusAmbassadorTask::PAYMENT_TYPE_FIXED)
                    Earn ${{ $campusAmbassadorTask->fixed_payment_amount }}
                @elseif($campusAmbassadorTask->payment_type == \App\CampusAmbassadorTask::PAYMENT_TYPE_HOURLY)
                    Earn $15 per hour
                @elseif($campusAmbassadorTask->payment_type == \App\CampusAmbassadorTask::PAYMENT_TYPE_NONE)
                    No earnings
                @endif
            </div>

        </div>
    </div>

</div>
