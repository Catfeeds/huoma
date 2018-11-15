$(function () {
    $(".menu-ico").click(function (e) {
        e.preventDefault();
        $(this).hide();
        $("#wrapper").css("overflow", "hidden");
        $("div.screen, div.fixedGuide").addClass("expand").removeClass("collapse");
        $(".menu-close").fadeIn();
    });

    $(".menu-close").click(function (e) {
        e.preventDefault();
        $(this).hide();
        $("div.screen, div.fixedGuide").removeClass("expand").addClass("collapse");
        $(".menu-ico").fadeIn();
        window.setTimeout(function () {
            $("#wrapper").css("overflow", "visible");
        }, 1000);
    });
});
function search(){
    var keywords = $(".sear input[name=keywords]").val();
    window.location.href="project.html?keywords="+keywords;
}