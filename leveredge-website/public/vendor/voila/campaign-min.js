/*
 * Custom Jquery
 */

jQuery(function ($) {
    __window = $(window);
    __body = $('body');
    __header = $('header');
    __footer = $('footer');

    __winwidth = __window.width();
    __winheight = __window.height();

    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }

    const scroll = new LocomotiveScroll({
        el: document.querySelector('[data-scroll-container]'),
        smooth: true,
        offset: ["20%", "20%"]
    });

    $(window).resize(function() {
        setTimeout(() => {
            scroll.update()
        }, 500);
    });

    if (__winwidth < 768) {
        jQuery('header .logo .menu-icon').click(function () {
            jQuery('header .menu').slideToggle('slow');
        });
    }

    jQuery('.faq-sec .inner-content .question').click(function(){
        jQuery(this).toggleClass('active').parent().siblings().find('.question').removeClass('active');
        jQuery(this).next().slideToggle().parent().siblings().find('.answer').slideUp();
    });






    // swiper!
    let currentPage = 0;
    let canClickOnPagination = true;
    const getCurrentPage = function() {
        if (currentPage < 0) {
            currentPage = 2;
        }

        return currentPage % 3 + 1;
    }

    const next = function() {
        if (!canClickOnPagination) {
            return;
        }

        ++currentPage;
        $(`.swiper-slide[data-index=${getCurrentPage()}]`).insertAfter($('.swiper-slide:first-child'));
        gsap.set('.swiper-slide', { clearProps: 'all' });
        const tl = new TimelineMax({ paused: true, delay: 0, immediateRender: false, onStart: function() {
                $('.swiper-current').html(getCurrentPage());
                canClickOnPagination = false;
            }, onComplete: function() {
                $('.swiper-slide:first-child').insertAfter($('.swiper-slide:last-child'));
                gsap.set('.swiper-slide', {clearProps: 'all'});
                canClickOnPagination = true;
            }});
        tl.staggerTo('.swiper-slide', 0.3, {x: '-=60', rotate: '-=4.7' }, 0.1);
        tl.to('.swiper-slide:first-child', 0.3, {alpha: 0, y: '-50px', scale: 1.1}, 0);
        tl.play();
    };

    const previous = function() {
        if (!canClickOnPagination) {
            return;
        }

        --currentPage;
        $(`.swiper-slide[data-index=${getCurrentPage()}]`).insertAfter($('.swiper-slide:first-child'));
        gsap.set('.swiper-slide', { clearProps: 'all' });
        const tl = new TimelineMax({ paused: true, delay: 0, immediateRender: false, onStart: function() {
                $('.swiper-current').html(getCurrentPage());
                canClickOnPagination = false;
            }, onComplete: function() {
                $('.swiper-slide:first-child').insertAfter($('.swiper-slide:last-child'));
                gsap.set('.swiper-slide', {clearProps: 'all'});
                canClickOnPagination = true;
            }});
        tl.staggerTo('.swiper-slide', 0.3, {x: '-=60', rotate: '-=4.7' }, 0.1, 0);
        tl.to('.swiper-slide:first-child', 0.3, {alpha: 0, y: '-50px', scale: 1.1}, 0, 0);
        tl.play();
    }


    $('.swiper-button-prev').click(function() {
        previous();
    });
    $('.swiper-button-next').click(function() {
        next();
    });
    $(".page.home .slider-content .left-content-inner").on("swiped-right", previous);
    $(".page.home .slider-content .left-content-inner").on("swiped-left", next);

    jQuery(window).on('load resize', function () {

        if(jQuery('.single-slider').length > 0) {
            if(__winwidth > 991) {
                jQuery('.single-slider').jRange({
                    from: 0,
                    to: 12,
                    step: 1,
                    scale: [0,2,4,6,8,10,12],
                    format: '%s years',
                    width: 336,
                    showLabels: true,
                    snap: true
                });
            }else if(__winwidth > 767) {
                jQuery('.single-slider').jRange({
                    from: 0,
                    to: 12,
                    step: 1,
                    scale: [0,2,4,6,8,10,12],
                    format: '%s years',
                    width: 564,
                    showLabels: true,
                    snap: true
                });
            }else if(__winwidth > 413) {
                jQuery('.single-slider').jRange({
                    from: 0,
                    to: 12,
                    step: 1,
                    scale: [0,12],
                    format: '%s years',
                    width: 330,
                    showLabels: true,
                    snap: true
                });
            }else if(__winwidth > 319) {
                jQuery('.single-slider').jRange({
                    from: 0,
                    to: 12,
                    step: 1,
                    scale: [0,12],
                    format: '%s years',
                    width: 230,
                    showLabels: true,
                    snap: true
                });
            }
        };
    });
});
