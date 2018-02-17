$(window).on('load', function () {

    function ocultarFooterPanel() {
        $("#footer").css("display", "none");
    };

    $("#activoCambioClave").on('change', function () {
        if ($("#activoCambioClave").is(':checked')) {
            $(".password").css("display", "block");
        } else {
            $(".password").css("display", "none");
        }
    });


    document.getElementById("burger").addEventListener("click", abrir, false);
    document.getElementById("transparente").addEventListener("click", volver, false);

    function abrir() {
        var body = document.getElementById("body");
        body.style.overflowX = "inherit";
        body.style.overflowY = "hidden";

        var menu = document.getElementById("menu");
        menu.style.right = 0;


        var trans = document.getElementById("transparente");
        trans.style.display = "block";
        trans.style.height = "100%";

    }

    function volver() {
        var body = document.getElementById("body");
        body.style.overflowY = "";

        var menu = document.getElementById("menu");
        menu.style.right = "-100%";

        var trans = document.getElementById("transparente");

        trans.style.display = "none";
    }
});