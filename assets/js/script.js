// scroll function
function scrl(element) {
    $("html,body").animate({
        scrollTop: $("#" + element).offset().top
    }, 1000);
}
$(window).scroll(function() {
    if ($(this).scrollTop() >= 400) {
        $('#a-arrow').css("display", "block");
    } else {
        $('#a-arrow').css("display", "none");
    }
});