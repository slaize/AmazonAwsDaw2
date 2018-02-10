function ocultarFooterPanel() {
    $(window).on('load', function () {
        $("#footer").css("display", ("none"));
    });
}

$(window).on('load', function () {
    $("#activoCambioClave").on('change', function () {
        if ($("#activoCambioClave").is(':checked')) {
            $(".password").css("display", "block");
        } else {
            $(".password").css("display", "none");
        }
    })
});