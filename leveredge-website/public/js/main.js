jQuery(document).ready(function( $ ) {


    $('.testimonials-carousel').slick({
        accessibility: false,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        pauseOnFocus: false,
        pauseOnHover: false,
        swipe: false
    });


    $('.testimonials-carousel-2').slick({
        accessibility: false,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        pauseOnFocus: false,
        pauseOnHover: false,
        swipe: false,
        slidesToShow: 3,
        responsive: [{

            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                infinite: true
            }

        }, {

            breakpoint: 768,
            settings: {
                slidesToShow: 1,
            }
        }]
    }).on('setPosition', function (event, slick) {
        slick.$slides.css('height', slick.$slideTrack.height() + 'px');
    });



    $('#tips-carousel').slick({
        accessibility: false,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: false,
        pauseOnFocus: true,
        pauseOnHover: true,
        swipe: true,
        slidesToShow: 1,
    }).on('setPosition', function (event, slick) {
        slick.$slides.css('height', slick.$slideTrack.height() + 'px');
    });


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


  // Back to top button
  // $(window).scroll(function() {
  //   if ($(this).scrollTop() > 100) {
  //     $('.back-to-top').fadeIn('slow');
  //   } else {
  //     $('.back-to-top').fadeOut('slow');
  //   }
  // });
  // $('.back-to-top').click(function(){
  //   $('html, body').animate({scrollTop : 0},1500, 'easeInOutExpo');
  //   return false;
  // });

  // // Stick the header at top on scroll
  // $("#header").sticky({topSpacing:0, zIndex: '50'});

  // Intro background carousel
  // $("#intro-carousel").owlCarousel({
  //   autoplay: true,
  //   dots: false,
  //   loop: true,
  //   animateOut: 'fadeOut',
  //   items: 1
  // });

  // Initiate the wowjs animation library
  // new WOW().init();

  // Initiate superfish on nav menu
  // $('.nav-menu').superfish({
  //   animation: {
  //     opacity: 'show'
  //   },
  //   speed: 400
  // });

  // Mobile Navigation
  // if ($('#nav-menu-container').length) {
  //   var $mobile_nav = $('#nav-menu-container').clone().prop({
  //     id: 'mobile-nav'
  //   });
  //   $mobile_nav.find('> ul').attr({
  //     'class': '',
  //     'id': ''
  //   });
  //   $('body').append($mobile_nav);
  //   $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
  //   $('body').append('<div id="mobile-body-overly"></div>');
  //   $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');
  //
  //   $(document).on('click', '.menu-has-children i', function(e) {
  //     $(this).next().toggleClass('menu-item-active');
  //     $(this).nextAll('ul').eq(0).slideToggle();
  //     $(this).toggleClass("fa-chevron-up fa-chevron-down");
  //   });
  //
  //   $(document).on('click', '#mobile-nav-toggle', function(e) {
  //     $('body').toggleClass('mobile-nav-active');
  //     $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
  //     $('#mobile-body-overly').toggle();
  //   });
  //
  //   $(document).click(function(e) {
  //     var container = $("#mobile-nav, #mobile-nav-toggle");
  //     if (!container.is(e.target) && container.has(e.target).length === 0) {
  //       if ($('body').hasClass('mobile-nav-active')) {
  //         $('body').removeClass('mobile-nav-active');
  //         $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
  //         $('#mobile-body-overly').fadeOut();
  //       }
  //     }
  //   });
  // } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
  //   $("#mobile-nav, #mobile-nav-toggle").hide();
  // }

  // Smooth scroll for the menu and links with .scrollto classes
  // $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function() {
  //   if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
  //     var target = $(this.hash);
  //     if (target.length) {
  //       var top_space = 0;
  //
  //       if ($('#header').length) {
  //         top_space = $('#header').outerHeight();
  //
  //         if( ! $('#header').hasClass('header-fixed') ) {
  //           top_space = top_space - 20;
  //         }
  //       }
  //
  //       $('html, body').animate({
  //         scrollTop: target.offset().top - top_space
  //       }, 1500, 'easeInOutExpo');
  //
  //       if ($(this).parents('.nav-menu').length) {
  //         $('.nav-menu .menu-active').removeClass('menu-active');
  //         $(this).closest('li').addClass('menu-active');
  //       }
  //
  //       if ($('body').hasClass('mobile-nav-active')) {
  //         $('body').removeClass('mobile-nav-active');
  //         $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
  //         $('#mobile-body-overly').fadeOut();
  //       }
  //       return false;
  //     }
  //   }
  // });


  // Porfolio - uses the magnific popup jQuery plugin
  // $('.portfolio-popup').magnificPopup({
  //   type: 'image',
  //   removalDelay: 300,
  //   mainClass: 'mfp-fade',
  //   gallery: {
  //     enabled: true
  //   },
  //   zoom: {
  //     enabled: true,
  //     duration: 300,
  //     easing: 'ease-in-out',
  //     opener: function(openerElement) {
  //       return openerElement.is('img') ? openerElement : openerElement.find('img');
  //     }
  //   }
  // });

  // Testimonials carousel (uses the Owl Carousel library)
  // $(".testimonials-carousel").owlCarousel({
  //   autoplay: true,
  //   dots: true,
  //   loop: true,
  //   responsive: { 0: { items: 1 }, 768: { items: 2 }, 900: { items: 3 } }
  // });





  // Clients carousel (uses the Owl Carousel library)
  // $(".clients-carousel").owlCarousel({
  //   autoplay: true,
  //   dots: true,
  //   loop: true,
  //   responsive: { 0: { items: 2 }, 768: { items: 4 }, 900: { items: 6 }
  //   }
  // });

  // For use with dynamic Google maps
  // if ($('#google-map').length) {
  //   var get_latitude = $('#google-map').data('latitude');
  //   var get_longitude = $('#google-map').data('longitude');
  //
  //   function initialize_google_map() {
  //     var myLatlng = new google.maps.LatLng(get_latitude, get_longitude);
  //     var mapOptions = {
  //       zoom: 14,
  //       scrollwheel: false,
  //       center: myLatlng
  //     };
  //     var map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
  //     var marker = new google.maps.Marker({
  //       position: myLatlng,
  //       map: map
  //     });
  //   }
  //   google.maps.event.addDomListener(window, 'load', initialize_google_map);
  // }

});


!function(e,n){"function"==typeof define&&define.amd?define(n):"object"==typeof exports?module.exports=n(require,exports,module):e.ouibounce=n()}(this,function(e,n,o){return function(e,n){"use strict";function o(e,n){return"undefined"==typeof e?n:e}function i(e){var n=24*e*60*60*1e3,o=new Date;return o.setTime(o.getTime()+n),"; expires="+o.toUTCString()}function t(){s()||(L.addEventListener("mouseleave",u),L.addEventListener("mouseenter",r),L.addEventListener("keydown",c))}function u(e){e.clientY>k||(D=setTimeout(m,y))}function r(){D&&(clearTimeout(D),D=null)}function c(e){g||e.metaKey&&76===e.keyCode&&(g=!0,D=setTimeout(m,y))}function d(e,n){return a()[e]===n}function a(){for(var e=document.cookie.split("; "),n={},o=e.length-1;o>=0;o--){var i=e[o].split("=");n[i[0]]=i[1]}return n}function s(){return d(T,"true")&&!v}function m(){s()||(e&&(e.style.display="block"),E(),f())}function f(e){var n=e||{};"undefined"!=typeof n.cookieExpire&&(b=i(n.cookieExpire)),n.sitewide===!0&&(w=";path=/"),"undefined"!=typeof n.cookieDomain&&(x=";domain="+n.cookieDomain),"undefined"!=typeof n.cookieName&&(T=n.cookieName),document.cookie=T+"=true"+b+x+w,L.removeEventListener("mouseleave",u),L.removeEventListener("mouseenter",r),L.removeEventListener("keydown",c)}var l=n||{},v=l.aggressive||!1,k=o(l.sensitivity,20),p=o(l.timer,1e3),y=o(l.delay,0),E=l.callback||function(){},b=i(l.cookieExpire)||"",x=l.cookieDomain?";domain="+l.cookieDomain:"",T=l.cookieName?l.cookieName:"viewedOuibounceModal",w=l.sitewide===!0?";path=/":"",D=null,L=document.documentElement;setTimeout(t,p);var g=!1;return{fire:m,disable:f,isDisabled:s}}});
