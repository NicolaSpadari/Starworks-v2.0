/* VARIABLES */
var M_DESKTOPDROPDOWNCHILDREN = $('#menuDesktop ul li ul li').length;
var M_MOBILECHILDREN = $('#menuMobile > ul > li').length;
var M_MOBILEDROPDOWNCHILDREN = $('#menuMobile ul li ul li').length;
var M_DESKTOPDROPDOWNCHILDRENHEIGHT = 25;
var M_MOBILECHILDRENHEIGHT = 35;
var M_MOBILEDROPDOWNCHILDRENHEIGHT = 25;
var T_BEFOREINTRONSTART = 350;
var D_INTRO = 200;
var T_BEFOREINTRODISAPPEAR = 500;
var D_INTRODISAPPEARING = 500;
var D_CONTENTDISAPPEARING = 200;
var D_CONTENTAPPEARING = 500;
var T_VISIBLECONTENTTRANSITION = 500;
var T_AFTERCONTENTAPPERING = 300;

/* START INIT */
$(document).ready(function () {
    init();
});

/* CAROUSEL */
$('.carousel').carousel({
    interval: 4000
});

/*FAQs*/
$(document).ready(function () {
    $('.faqQuestion').collapse('hide');
});
$(".faqQuestion").on("click", function () {
    $(".collapsibleItem").each(function () {
        if ($(this).is(':visible')) {
            $(this).slideToggle(400);
            $(this).parent().find('i').css('cssText', 'transform: rotate(0deg)');
        }
        ;
    });
    if ($(this).parent().find('.collapsibleItem').is(":hidden")) {
        $(this).parent().find('.collapsibleItem').slideToggle(400);
        $(this).find('i').css('cssText', 'transform: rotate(90deg)');
    }
});

/* TABS HOME VIEW */
function init() {
    if (sessionStorage.getItem('websiteVisited') === null) {
        sessionStorage.setItem('currentSection', 'slideshow');
    }
    $('section').each(function () {
        var top = $(this).attr('data-top'),
                bottom = $(this).attr('data-bottom'),
                left = $(this).attr('data-left'),
                right = $(this).attr('data-right');
        $(this).css({
            'top': top + '%',
            'bottom': bottom + '%',
            'left': left + '%',
            'right': right + '%'
        });
        if ($(this).attr('id') !== sessionStorage.getItem('currentSection')) {
            $(this).hide();
            $(this).find('.content').hide();
        }
    });
    moveTo(sessionStorage.getItem('currentSection'));
}
function moveTo(sectionToMove) {
    var top = parseInt($('#' + sectionToMove).attr('data-top')),
            bottom = parseInt($('#' + sectionToMove).attr('data-bottom')),
            left = parseInt($('#' + sectionToMove).attr('data-left')),
            right = parseInt($('#' + sectionToMove).attr('data-right'));
    $('#visibleContent').css({
        'top': -(top) + '%',
        'bottom': -+(bottom) + '%',
        'left': -+(left) + '%',
        'right': -+(right) + '%'
    });
    
    if (sectionToMove !== 'slideshow') {
        $('footer').animate({height: '50px'}, {queue: false, duration: 350});
    } else {
        $('footer').animate({height: '0'}, {queue: false, duration: 350});
    }
}
function moveVisibleContent(currentSection, nextSection) {
    if (currentSection !== nextSection) {
        $('#' + nextSection).show();
        $('#' + currentSection + ' .content').fadeOut(D_CONTENTDISAPPEARING, function () {
            moveTo(nextSection);
        });
        setTimeout(function () {
            $('#' + nextSection + ' .content').fadeIn(D_CONTENTAPPEARING, function () {
                $('#' + currentSection).hide();
                sessionStorage.setItem('currentSection', nextSection);
            });
        }, D_CONTENTDISAPPEARING + T_AFTERCONTENTAPPERING + T_AFTERCONTENTAPPERING);
    }
}
$(window).on('load', function () {
    if (sessionStorage.getItem('websiteVisited') === null) {
        sessionStorage.setItem('websiteVisited', true);
        setTimeout(function () {
            $('svg').show();
            new Vivus('introAnimation', {duration: D_INTRO, type: 'delayed', animTimingFunction: Vivus.EASE_IN}, function () {
                fadeOutBackgroundWrapper();
            });
        }, T_BEFOREINTRONSTART);
    }
    else {
        fadeOutBackgroundWrapper();
    }
    $('#menu li:not(#menuMobileDropdown)').on('click', function (e) {
        $('#menu li.active').removeClass('active');
        $(this).addClass('active');
        toggleMenuDesktopDropdown(true);
        toggleMenuMobile(true);
        var currentSection = sessionStorage.getItem('currentSection');
        var nextSection = $(this).attr('data-section');
        moveVisibleContent(currentSection, nextSection);
        e.stopPropagation();
    });
    $('#visibleContent').on('click', function () {
        toggleMenuDesktopDropdown(true);
        toggleMenuMobile(true);
    });
    $('#menuDesktop .menuToggle').on('click', function () {
        toggleMenuDesktopDropdown(false);
    });
    $('#menuMobile .menuToggle').on('click', function () {
        toggleMenuMobile(false);
    });
    $('#menuMobile #menuMobileDropdown').on('click', function () {
        toggleMenuMobileDropdown(false);
    });
});

/* DROPDOWN EVENTS */
function toggleMenuDesktopDropdown(close) {
    var menuToToggle = $('#menuDesktop ul li ul');
    if (close) {
        if (menuToToggle.attr('data-open') === 'true') {
            menuToToggle.removeClass('menuOpen');
            menuToToggle.css('height', '0');
            menuToToggle.attr('data-open', 'false');
        }
    }
    else {
        if (menuToToggle.attr('data-open') === 'true') {
            menuToToggle.removeClass('menuOpen');
            menuToToggle.css('height', '0');
            menuToToggle.attr('data-open', 'false');
        } else {
            menuToToggle.addClass('menuOpen');
            menuToToggle.css('height', M_DESKTOPDROPDOWNCHILDREN * M_DESKTOPDROPDOWNCHILDRENHEIGHT + 'px');
            menuToToggle.attr('data-open', 'true');
        }
    }
}
function toggleMenuMobile(close) {
    var menuToToggle = $('#menuMobile > ul');
    var menuToggle = $('#menuMobile .menuToggle');
    if (close) {
        if (menuToToggle.attr('data-open') === 'true') {
            if ($('#menuMobile ul li ul').attr('data-open') === 'true') {
                toggleMenuMobileDropdown(true);
                setTimeout(function () {
                    menuToToggle.removeClass('menuOpen');
                    menuToggle.removeClass('open');
                    menuToToggle.css('height', '0');
                    menuToToggle.attr('data-open', 'false');
                }, 200);
            }
            else {
                menuToToggle.removeClass('menuOpen');
                menuToggle.removeClass('open');
                menuToToggle.css('height', '0');
                menuToToggle.attr('data-open', 'false');
            }
        }
    }
    else {
        if (menuToToggle.attr('data-open') === 'true') {
            if ($('#menuMobile ul li ul').attr('data-open') === 'true') {
                toggleMenuMobileDropdown(true);
                setTimeout(function () {
                    menuToToggle.removeClass('menuOpen');
                    menuToggle.removeClass('open');
                    menuToToggle.css('height', '0');
                    menuToToggle.attr('data-open', 'false');
                }, 200);
            }
            else {
                menuToToggle.removeClass('menuOpen');
                menuToggle.removeClass('open');
                menuToToggle.css('height', '0');
                menuToToggle.attr('data-open', 'false');
            }
        } else {
            menuToToggle.addClass('menuOpen');
            menuToggle.addClass('open');
            menuToToggle.css('height', M_MOBILECHILDREN * M_MOBILECHILDRENHEIGHT + 'px');
            menuToToggle.attr('data-open', 'true');
        }
    }
}
function toggleMenuMobileDropdown(close) {
    var menuToToggle = $('#menuMobile ul li ul');
    if (close) {
        if (menuToToggle.attr('data-open') === 'true') {
            menuToToggle.removeClass('menuOpen');
            menuToToggle.css('height', '0');
            menuToToggle.attr('data-open', 'false');
            setTimeout(function () {
                $('#menuMobile > ul').css('height', M_MOBILECHILDREN * M_MOBILECHILDRENHEIGHT + 'px');
            }, 150);
        }
    }
    else {
        if (menuToToggle.attr('data-open') === 'true') {
            menuToToggle.removeClass('menuOpen');
            menuToToggle.css('height', '0');
            menuToToggle.attr('data-open', 'false');
            setTimeout(function () {
                $('#menuMobile > ul').css('height', M_MOBILECHILDREN * M_MOBILECHILDRENHEIGHT + 'px');
            }, 150);
        } else {
            $('#menuMobile > ul').css('height', 'auto');
            menuToToggle.addClass('menuOpen');
            menuToToggle.css('height', M_MOBILEDROPDOWNCHILDREN * M_MOBILEDROPDOWNCHILDRENHEIGHT + 'px');
            menuToToggle.attr('data-open', 'true');
        }
    }
}

/* SVG FADE OUT */
function fadeOutBackgroundWrapper() {
    setTimeout(function () {
        $('.introWrapper').fadeOut(D_INTRODISAPPEARING, function () {
            $('.introWrapper').remove();
        });
    }, T_BEFOREINTRODISAPPEAR);
}

/* AJAX */
function populateModal(id) {
    $.ajax({
        url: 'Include/functions.php',
        type: 'POST',
        data: {function: 'getPhotos', id: id},
        success: function (data, textStatus, jQxhr) {
            $('#album-modal .modal-body').html(data);
            $('#album-modal .modal-title').html($('#card' + id + '').find('h4.card-title').html());
            $('#album-modal').modal();
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}