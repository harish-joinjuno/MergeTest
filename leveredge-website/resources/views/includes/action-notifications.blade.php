@if(isset($action_notifications))
    @if(count($action_notifications)>0)
    <div class="container mt-5">
        @foreach($action_notifications as $notification)
            <action-notification
                link="{{ $notification->cta_link }}"
                link-text="{{ $notification->cta_text }}"
                icon="{{ $notification->icon }}"
                text="{{ $notification->description }}"
                notification-style="{{ $notification->notification_style }}"
                :notification-id="{{ $notification->id }}"
                :close="{{ json_encode($notification->dismissable) }}"></action-notification>
        @endforeach
    </div>
    @endif
@endif
