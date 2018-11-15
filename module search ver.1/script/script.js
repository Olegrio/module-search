$(document).ready(function () {
    $(".dws-progress-bar").circularProgress({
        color: "#23264c",
        line_width: 17,
        height: "300px",
        width: "300px",
        percent: 0,
        // counter_clockwise: true,
        starting_position: 25
    }).circularProgress('animate', 100, 2000);
});

$(window).on('load', function () {
   var $preloader = $('#preloader');
   $preloader.delay(1800).fadeOut('slow');
});