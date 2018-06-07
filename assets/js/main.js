$(document).ready(function() {
 
    $('.bxslider').bxSlider({


        adaptiveHeight: true,
        auto:true, //slide automatique
        controls:true, //flèches
        pager:true,
    });   

    // ===== Scroll to Top ====
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 300) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(500);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(500);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 2500);
    });



    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},400);
        return false;
    });

    AOS.init({
        duration: 1200
    })

});