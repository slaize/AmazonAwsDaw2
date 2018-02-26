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



    var scrollTop = $(".scrollTop");

    $(window).scroll(function() {
        // declare variable
        var topPos = $(this).scrollTop();

        // if user scrolls down - show scroll to top button
        if (topPos > 100) {
            $(scrollTop).css("opacity", "1");

        } else {
            $(scrollTop).css("opacity", "0");
        }

    }); // scroll END

    //Click event to scroll to top
    $(scrollTop).click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;

    }); // click() scroll top EMD

    /*************************************
     LEFT MENU SMOOTH SCROLL ANIMATION
     *************************************/
        // declare variable
    var h1 = $("#h1").position();
    var h2 = $("#h2").position();
    var h3 = $("#h3").position();

    $('.link1').click(function() {
        $('html, body').animate({
            scrollTop: h1.top
        }, 500);
        return false;

    }); // left menu link2 click() scroll END

    $('.link2').click(function() {
        $('html, body').animate({
            scrollTop: h2.top
        }, 500);
        return false;

    }); // left menu link2 click() scroll END

    $('.link3').click(function() {
        $('html, body').animate({
            scrollTop: h3.top
        }, 500);
        return false;

    }); // left menu link3 click() scroll END
});