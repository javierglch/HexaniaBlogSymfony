$(document).ready(function (e) {
    posFooter();
});
$(window).resize(function (e) {
    posFooter();
});
$('body').resize(function (e) {
    posFooter();
});
function posFooter() {
    var footer_height = $('footer.main-footer').height();
    var footer_margin_top = parseInt($('footer.main-footer').css('margin-top'));
    if ($(window).height() < $(document).height()) {
        $('footer.main-footer').css('position', 'relative');
        $('footer.footer-margin-fix').css('margin-bottom', footer_margin_top + 'px');
    } else {
        $('footer.main-footer').css('position', 'fixed');
        $('footer.footer-margin-fix').css('margin-bottom', (footer_height + footer_margin_top) + 'px');
    }
}

