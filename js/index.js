//xxxxxxxxxxxxxx//
//xxxx MENU xxxx//
//xxxxxxxxxxxxxx//



var $scrollpos = 0;


$(".burger").click(function() {

    $scrollpos = $('body').scrollTop();
    console.log($scrollpos);

    $(".burger").animate({
        opacity: 0
    }, 600);

    $("nav").css({
        display: "block"
    });

    if ($("nav").find(".mid-nav").outerWidth() != $("nav").outerWidth()) {
        $("nav").find(".mid-nav").css({
            width: $("nav").outerWidth()
        });
    }
    $("html").addClass("inactive");
    $("#web-frame").addClass("inactive");
    setTimeout(function() {
        $("nav").addClass("active");
    }, 50);

});

$(".nav-mobileNavOpen").click(function() {


    $scrollpos = $('body').scrollTop();
    console.log($scrollpos);


    $("nav").css({
        display: "block"
    });
    if ($("nav").find(".mid-nav").outerWidth() != $("nav").outerWidth()) {
        $("nav").find(".mid-nav").css({
            width: $("nav").outerWidth()
        });
    }
    $("html").addClass("inactive");
    $("#web-frame").addClass("inactive");
    setTimeout(function() {
        $("nav").addClass("active");
    }, 50);
    $('.burger').toggleClass('open');


});

$(".burger-fixed").click(function() {

    $scrollpos = $('body').scrollTop();
    console.log($scrollpos);

    $("nav").css({
        display: "block"
    });
    if ($("nav").find(".mid-nav").outerWidth() != $("nav").outerWidth()) {
        $("nav").find(".mid-nav").css({
            width: $("nav").outerWidth()
        });
    }
    $("html").addClass("inactive");
    $("#web-frame").addClass("inactive");
    setTimeout(function() {
        $("nav").addClass("active");
    }, 50);
    $('.burger').toggleClass('open');


});

$("nav").click(function() {
    if ($("#nav").hasClass("active")) {

        $('body').scrollTop($scrollpos);

        $("html").removeClass("inactive");
        $("nav").removeClass("active");
        $("#web-frame").removeClass("inactive");
        setTimeout(function() {
            $("nav").css({
                display: "none"
            });
        }, 600);

        $(".burger").animate({
            opacity: 1
        }, 600);
        $('.burger').toggleClass('open');

    }

});



$(document).keyup(function(e) {
    if ($("#nav").hasClass("active")) {

        if (e.keyCode == 27) { // escape key maps to keycode `27`
            // <DO YOUR WORK HERE>

            console.log($scrollpos);
            $('body').scrollTop($scrollpos);
            $("html").removeClass("inactive");
            $("nav").removeClass("active");
            $("#web-frame").removeClass("inactive");
            setTimeout(function() {
                $("nav").css({
                    display: "none"
                });
            }, 600);

            $(".burger").animate({
                opacity: 1
            }, 600);
            $('.burger').toggleClass('open');

        }
    }
});



//xxxxxxxxxxxxxx//
//xxxx LOGIN FRAME xxxx//
//xxxxxxxxxxxxxx//

$("#login").click(function() {

    $("#sign-in-frame").css({
        display: "block"
    });

    $("html").addClass("inactive");
    $("#web-frame").addClass("inactive");
    setTimeout(function() {
        $(".signin").addClass("active");
    }, 50);


});

$("#fixed-header-login").click(function() {

    $("#sign-in-frame").css({
        display: "block"
    });

    $("html").addClass("inactive");
    $("#web-frame").addClass("inactive");
    setTimeout(function() {
        $(".signin").addClass("active");
    }, 50);


});

$(document).keyup(function(e) {
    if ($(".signin").hasClass("active")) {

        if (e.keyCode == 27) { // escape key maps to keycode `27`
            // <DO YOUR WORK HERE>

            // RESET ERROR MESSAGING ON MODAL CLOSE
            errorEmpty == false;
            errorUsername == false;
            errorPassword == false;
            $("#login-username, #login-password").val('');
            $("#login-username, #login-password").removeClass("input-error");
            $(".form-error").css({
                display: "none"
            });


            $('body').scrollTop($scrollpos);
            $("html").removeClass("inactive");
            $(".signin").removeClass("active");
            $("#web-frame").removeClass("inactive");
            setTimeout(function() {
                $("#sign-in-frame").css({
                    display: "none"
                });
            }, 600);

        }

    }
});

$(".signin .bg").click(function() {
    if ($(".signin").hasClass("active")) {

        // RESET ERROR MESSAGING ON MODAL CLOSE
        errorEmpty == false;
        errorUsername == false;
        errorPassword == false;
        $("#login-username, #login-password").val('');
        $("#login-username, #login-password").removeClass("input-error");
        $(".form-error").css({
            display: "none"
        });

        $("html").removeClass("inactive");
        $(".signin").removeClass("active");
        $("#web-frame").removeClass("inactive");
        setTimeout(function() {
            $("#sign-in-frame").css({
                display: "none"
            });
        }, 600);

    }

});


//xxxxxxxxxxxxxx//
//xxxx REGISTER FRAME xxxx//
//xxxxxxxxxxxxxx//

$("#register").click(function() {

    $("#register-frame").css({
        display: "block"
    });


    $("html").addClass("inactive");
    $("#web-frame").addClass("inactive");
    setTimeout(function() {
        $(".register").addClass("active");
    }, 50);


});

$(document).keyup(function(e) {
    if ($(".register").hasClass("active")) {

        if (e.keyCode == 27) { // escape key maps to keycode `27`
            // <DO YOUR WORK HERE>

            // RESET ERROR MESSAGING ON MODAL CLOSE
            errorEmpty == false;
            errorUsername == false;
            errorEmail == false;
            errorEmailTaken == false;
            $("#signup-first, #signup-last, #signup-email, #signup-username, #signup-password").val('');
            $("#signup-first, #signup-last, #signup-email, #signup-username, #signup-password").removeClass("input-error");
            $(".form-error").css({
                display: "none"
            });

            $('body').scrollTop($scrollpos);
            $("html").removeClass("inactive");
            $(".register").removeClass("active");
            $("#web-frame").removeClass("inactive");
            setTimeout(function() {
                $("#register-frame").css({
                    display: "none"
                });
            }, 600);

        }
    }
});

$(".register .bg").click(function() {
    if ($(".register").hasClass("active")) {

        // RESET ERROR MESSAGING ON MODAL CLOSE
        errorEmpty == false;
        errorUsername == false;
        errorEmail == false;
        errorEmailTaken == false;
        $("#signup-first, #signup-last, #signup-email, #signup-username, #signup-password").val('');
        $("#signup-first, #signup-last, #signup-email, #signup-username, #signup-password").removeClass("input-error");
        $(".form-error").css({
            display: "none"
        });


        $("html").removeClass("inactive");
        $(".register").removeClass("active");
        $("#web-frame").removeClass("inactive");
        setTimeout(function() {
            $("#register-frame").css({
                display: "none"
            });
        }, 600);

    }

});


$("#register-menu").click(function() {

    $("#register-frame").css({
        display: "block"
    });

    $("html").addClass("inactive");
    $("#web-frame").addClass("inactive");
    setTimeout(function() {
        $(".register").addClass("active");
    }, 50);


});


$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 150) {
        $(".fixedHeader").css('transform', 'translate(0, 60px)');
    } else {
        $(".fixedHeader").css('transform', 'translate(0, -60px)');
    }
});


$(function() { // $(document).ready shorthand
    $('.end-quote').fadeIn('slow');
});

$(document).ready(function() {

    /* Every time the window is scrolled ... */
    $(window).scroll(function() {

        /* Check the location of each desired element */
        $('.quote').each(function(i) {

            var bottom_of_object = $(this).position().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            /* If the object is completely visible in the window, fade it it */
            if (bottom_of_window > bottom_of_object) {

                $(this).animate({
                    'opacity': '1',
                }, 2500);

                $(this).css('transform', 'translate(0, -20px)');


            }

        });

    });

});
