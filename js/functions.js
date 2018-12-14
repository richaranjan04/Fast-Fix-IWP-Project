var height= $(window).height() - 200;
$(".FirstSection").css("min-height",height);
$(".SecondSection").css("min-height",$(window).height() - 240);
$(".BrandSection").css("min-height",$(window).height() - 40);
$(".whyUsSection").css("min-height",$(window).height() - 40);
$(".fourthSection").css("min-height",height);
$(".quoteSection").css("min-height",$(window).height() - 490);
$(".ourTeam").css("min-height",$(window).height() - 150);
$(".locationScr").css("min-height",height);
$("footer").css("min-height",$(window).height() - 500);



(function($) {
    var $window = $(window),
        $html = $('html');

    function resize() {
        if ($window.width() < 514) {
            return $(".navbar").addClass('navbar-fixed-top');
        }

       	$(".navbar").removeClass('navbar-fixed-top');
    }
    
    $window
        .resize(resize)
        .trigger('resize');
})(jQuery);

$('.mobilePhone a').on('click', function(){
    // console.log($(this));
    if($(this).attr('id') == 'iphone5'){
        $('.MobilePic').addClass('imageOne');
        // console.log("yes");
    }else{
        console.log("no");
    }
});


// $('.selectpicker').selectpicker({
//   style: 'btn-info',
//   size: 4
// });
