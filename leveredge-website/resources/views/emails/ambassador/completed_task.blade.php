@component('mail::message')
Hi, a new task was completed !

**Ambassador Name:** {{ $task->campusAmbassador->name }}
**Title:** {{ $task->task->title }}
**Payment Requested:** {{ $task->paymentMethod->name }}
**Ambassador Notes:** {{ $task->ambassador_notes }}

@component('mail::button', ['url' => url(\Nova::path() . '/resources/completed-campus-ambassador-tasks/' . $task->id)])
View in Nova
@endcomponent

@if(isset($task->admin_notes))
    **Additional Task Information:**
    {!! $task->admin_notes !!}
@endif
<br><br>
@if(isset($task->files))
    **Files:**
    <ul>
        @foreach($task->files as $file)
            <li><a class="text-primary" href="{{ route('files.download', ['file' => $file['filename'], 'name' => $file['original_name']]) }}">{{ $file['original_name'] }}</a></li>
        @endforeach
    </ul>
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
