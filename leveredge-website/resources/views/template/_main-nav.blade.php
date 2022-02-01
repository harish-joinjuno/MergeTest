@inject('menuLink', 'App\MenuLink')

<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('/img/logo/juno-logo-formerly.png') }}" height="30" alt="">
        </a>

        @unless(isset($hide_navigation_menu) && $hide_navigation_menu)
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    @foreach ($menuLink->getParentLinks() as $link)
                        @if (!count($link['children']))
                            <li class="nav-item active">
                                <a class="nav-link" href="{{$link['href']}}">{{$link['label']}}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$link['label']}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($link->children as $child)
                                        <a class="dropdown-item" href="{{ $child['href'] }}">{{ $child['label'] }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>

                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item active">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Join') }}</a>
                            @endif
                        </li>
                        @if(isset($displayReferralProgramButton) && $displayReferralProgramButton)
                            @if(empty($hideReferralProgramButton))
                            <li class="nav-item active">
                                <a
                                    class="nav-link btn btn-sm btn-secondary px-3 ml-lg-4"
                                    href="{{ url()->route('register.referral') }}"
                                >
                                    Earn $$$
                                </a>
                            </li>
                            @endif
                        @endif
                    @else
                        <li class="nav-item dropdown active">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name != '' ? Auth::user()->first_name : 'Guest' }}<span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(user()->hasRole('borrower'))
                                @foreach ($menuLink->getAuthDropdownLinks() as $link)
                                    <a class="dropdown-item" href="{{ $link['href'] }}">
                                        {{ $link['label'] }}
                                    </a>
                                @endforeach
                                @else
                                        <a class="dropdown-item" href="{{ url('/home') }}">
                                            Dashboard
                                        </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        @endunless
    </div>
</nav>
