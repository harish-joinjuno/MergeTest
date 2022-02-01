<!DOCTYPE html>
<html lang="en">
    <head>
        @inject('menuLink', 'App\MenuLink')
        @unless(config('services.google_tag_manager.disable_tag_manager'))
            <script>
                var timer;
                @if(auth()->check())
                    var GLOBAL_EVENT_ID = "{{ user()->id }}{{ user()->accessTheDeals->count() }}"
                @endif
                var startGtm = function () {
                    if (!window.jQuery) return;
                    clearInterval(timer);
                    (function (w, d, s, l, i) {
                        w[l] = w[l] || [];
                        w[l].push({
                            'gtm.start'                    :
                                new Date().getTime(), event: 'gtm.js'
                        });
                        var f                          = d.getElementsByTagName(s)[0],
                            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                        j.async                        = true;
                        j.src                          =
                            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                        f.parentNode.insertBefore(j, f);
                    })(window, document, 'script', 'dataLayer', 'GTM-K66ZG28');
                };

                timer = setInterval(startGtm, 220);

                dataLayer = [];
            </script>
        @endunless

        <meta property="fb:app_id" content="2142075722511834"/>

        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
        <meta charset="utf-8">

        <title>@yield('title', 'LeverEdge is now Juno | Use Group Buying Power to Save Money on Loans')</title>

        <meta
            content="@yield('google-description','LeverEdge is now Juno! Juno is a student first initiative that uses group buying power to negotiate student
    loan rates with lenders. The service is free for students.')"
            name="description">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Social -->
        <meta property="og:title"
              content="@yield('social-title','Juno | Use Group Buying Power to Save Money on Loans')"/>
        <meta property="og:description"
              content="@yield('social-description','Juno is a student first initiative that uses group buying power to negotiate student loan rates with lenders. The service is free for students.')"/>
        <meta property="og:image" content="@yield('social-image', url('/img/juno-og-image.png') )"/>
        <meta property="og:url" content="@yield('social-url',Request::url())"/>

        <!-- Regular Social Tags -->
        <meta property="og:type" content="article"/>
        <meta name="author" content="Juno">


        @yield('meta-content')

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <script>
            if(window.navigator && navigator.serviceWorker) {
                navigator.serviceWorker.getRegistrations()
                    .then(function(registrations) {
                        for(let registration of registrations) {
                            registration.unregister();
                        }
                    });
            }
        </script>

        @stack('header-scripts')

            <!-- Mix Panel Setup -->
        <script>(function(c,a){if(!a.__SV){var b=window;try{var d,m,j,k=b.location,f=k.hash;d=function(a,b){return(m=a.match(RegExp(b+"=([^&]*)")))?m[1]:null};f&&d(f,"state")&&(j=JSON.parse(decodeURIComponent(d(f,"state"))),"mpeditor"===j.action&&(b.sessionStorage.setItem("_mpcehash",f),history.replaceState(j.desiredHash||"",c.title,k.pathname+k.search)))}catch(n){}var l,h;window.mixpanel=a;a._i=[];a.init=function(b,d,g){function c(b,i){var a=i.split(".");2==a.length&&(b=b[a[0]],i=a[1]);b[i]=function(){b.push([i].concat(Array.prototype.slice.call(arguments,
                0)))}}var e=a;"undefined"!==typeof g?e=a[g]=[]:g="mixpanel";e.people=e.people||[];e.toString=function(b){var a="mixpanel";"mixpanel"!==g&&(a+="."+g);b||(a+=" (stub)");return a};e.people.toString=function(){return e.toString(1)+".people (stub)"};l="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
                for(h=0;h<l.length;h++)c(e,l[h]);var f="set set_once union unset remove delete".split(" ");e.get_group=function(){function a(c){b[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));e.push([d,call2])}}for(var b={},d=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<f.length;c++)a(f[c]);return b};a._i.push([b,d,g])};a.__SV=1.2;b=c.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
                MIXPANEL_CUSTOM_LIB_URL:"file:"===c.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";d=c.getElementsByTagName("script")[0];d.parentNode.insertBefore(b,d)}})(document,window.mixpanel||[]);
            mixpanel.init("f56f0cb09f0e04d1e741e33b5ee67553", {batch_requests: true})</script>

            <script>
                @auth
                var USER_ID = "{{ user()->id }}";
                mixpanel.identify(USER_ID);
                mixpanel.people.set({
                    "$name": "{{user()->name}}",    // only special properties need the $
                    "$email": "{{user()->email}}",    // only special properties need the $
                    "$created": "{{user()->created_at}}",
                    "$last_login": new Date()         // properties can be dates...
                });
                @endauth
                mixpanel.track("Page load", {
                    "url": "{{url()->full()}}"
                });
            </script>

    </head>

    <body id="body">

    <!-- BEGIN: Facebook SDK for Login Application -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '2142075722511834',
                cookie     : true,
                xfbml      : true,
                version    : 'v8.0'
            });

            FB.AppEvents.logPageView();

        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- END: Facebook SDK for Login Application -->

        @unless( config('services.google_tag_manager.disable_tag_manager') )
            <!-- Google Tag Manager (noscript) -->
            <noscript>
                <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K66ZG28"
                        height="0" width="0" style="display:none;visibility:hidden"></iframe>
            </noscript>
            <!-- End Google Tag Manager (noscript) -->
        @endunless


        @yield('base-content')


        @if(env('FIREBASE_API_KEY'))
            <script src="https://www.gstatic.com/firebasejs/7.10.0/firebase-app.js"></script>
            <script src="https://www.gstatic.com/firebasejs/7.10.0/firebase-analytics.js"></script>
            <script>
                firebase.initializeApp({
                    apiKey: '{{env('FIREBASE_API_KEY')}}',
                    authDomain: 'leveredge-website.firebaseapp.com',
                    databaseURL: 'https://leveredge-website.firebaseio.com',
                    projectId: 'leveredge-website',
                    storageBucket: 'leveredge-website.appspot.com',
                    messagingSenderId: '889089069216',
                    appId: '1:889089069216:web:a00d364478455bc59cf9c5',
                    measurementId: 'G-W0PG2LS9BP',
                })
                firebase.analytics()
            </script>
        @endif

    <script>
        window.phoneNumber = '{{ old('phone_number', optional(userProfile())->phone_number) }}';
        window.userId = '{{ auth()->check() ? auth()->user()->id : null }}';
        window.userEmail = '{{ auth()->check() ? auth()->user()->email : null }}';
    </script>
    <script src="{{mix('mix/js/new_app.js')}}" content="application/javascript"></script>

    @stack('footer-scripts')


    <!-- Automatic Tracking Pixel for Partnership Pages -->
    @if( isset($partners_affiliate_code) && !is_null($partners_affiliate_code) )
        <img src="{{ url('/tracking-pixel.png?affiliate=' . $partners_affiliate_code) }}">
    @endif

    <script>
        $(document).ready(function() {
            $(document).click(function(event) {
                const element = event.target;
                if (element.matches('[data-share-target]')) {
                    $.ajax({
                        method: 'POST',
                        url: '/track-event',
                        beforeSend: function(request) {
                            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                        },
                        data: {
                            category: 'Share Button',
                            action: 'click',
                            label: element.dataset['shareTarget'],
                        },
                    });
                }
            });
        });
    </script>

    </body>
</html>
