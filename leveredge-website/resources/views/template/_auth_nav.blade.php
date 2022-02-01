@inject('menuLink', 'App\MenuLink')

<nav class="navbar navbar-expand-lg new-navbar navbar-light fixed-top bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('/img/logo/logo-desktop-white.png') }}" alt="">
        </a>

        @unless(isset($hide_navigation_menu) && $hide_navigation_menu)
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-md-5 pr-md-3">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item active">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item dropdown active custom-dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name != '' ? Auth::user()->first_name : 'Guest' }}
                                <i class="fas fa-chevron-down pl-2"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-0 m-0" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-right py-2" href="{{ route('user_profile.update.personal-info') }}">
                                    <p class="pr-2 mr-1 my-1">Personal Information</p>
                                </a>

                                <a class="dropdown-item text-right  py-2" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="pr-2 mr-1 my-1">{{ __('Logout') }}</span>
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
