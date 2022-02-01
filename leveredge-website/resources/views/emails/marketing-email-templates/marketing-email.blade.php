@yield('content')

You may unsubscribe from our marketing emails by clicking <a href="{{ route('marketing-email-unsubscribe', ['email' => $marketingEmail->email_address]) }}">here</a>.
