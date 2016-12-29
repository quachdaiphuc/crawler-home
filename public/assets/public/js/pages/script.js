$('.dropdown').tendina({
    animate: true,
    speed: 500
    })

$('#responsive-menu-button').sidr({
    name: 'sidr-main',
    source: '#navigation',
    renaming: false
});

$('#right-search').sidr({
    name: 'sidr-right',
    side: 'right',
    source: '.content-right',
    renaming: false
});

$(".close-search").on("click",function(e) {
    $.sidr('close', 'sidr-right');
});

$(".close-menu").on("click",function(e) {
    $.sidr('close', 'sidr-main');
});

$(document).ready(function () {
    $("select#scroll-select").selectr({
        title: 'What would you like to search?',
        placeholder: 'Search ...'
    });

});

$(document).ready(function(){
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});

$(document).ready(function(){
    if (window.innerWidth > 767) {
        // hide #back-top first
        $("#back-top").hide();
        // fade in #back-top
        $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
        $('#back-top').fadeIn();
        } else {
        $('#back-top').fadeOut();
        }
        });
        // scroll body to 0px on click
        $('#back-top a').click(function () {
        $('body,html').animate({
        scrollTop: 0
        }, 800);
        return false;
        });
    } else {
        $('#back-top').css("display", "none");
    }
});

$(function () {
    $("#country_id").selectbox();
});