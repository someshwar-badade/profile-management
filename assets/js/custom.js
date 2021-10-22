$(document).ready(function(e) {
$(".ctmmenu li ").click(function(){
	$(".ctmmenu li ").removeClass("active");
	$(this).addClass("active");
	
})





$('#popularCategory').owlCarousel({
	loop:true,
	margin:0,
	nav:true,
	dots:false,
	autoplay:true,
	mouseDrag: true,
	smartSpeed: 1500,
	autoplayTimeout:2500,
	//animateIn:'fadeIn ',
	//animateOut:'fadeOut',
	 navText: [
            "<i class='icon-back'></i>",
            "<i class='icon-forward'></i>"
        ],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

 $('.bxslider').bxSlider({
	mode: 'vertical',
    speed:300,
	responsive:true,
	auto:true,
	infiniteLoop:true,
    autoStart:true,
    startSlide:0,
	autoDirection: 'prev',
  
});



$('#myTab a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})




$(".ft-right ul li a ").click(function(){
	$(".ft-right ul li a ").removeClass("activeft");
	$(this).addClass("activeft");
	
})

});

$(".menuBtn").click(function(e) {
    $("body").toggleClass("menuOpen");
	//$(this).toggleClass("iconchnage")
});


 $(".menuBtnClose ").click(function(e) {
       $("body").removeClass("menuOpen");
  });

/*$(window).scroll(function(){
  var sticky = $('header'),
      scroll = $(window).scrollTop();

  if (scroll >= 100) sticky.addClass('fixed');
  else sticky.removeClass('fixed');
});
*/

    //STICKY HEADER
                $(window).scroll(function () {
                    //var bannerheight=$('.bannerSlider').outerHeight();
                    if ($(window).scrollTop() >= 50) {
                        $('header').addClass('fixHeader');
                       // $('.navigation').addClass('fixHeader');
                    } else {
                        $('header').removeClass('fixHeader');
                       // $('.navigation').removeClass('fixHeader');
                    }
                });



$("a[href^='#']").click(function(e) {
	e.preventDefault();
	
	var position = $($(this).attr("href")).offset().top;

	$("body, html").animate({
		scrollTop: position
	},1000 /* speed */ );
	return false;
});


// css-animated-loader

$(document).on('submit','form',function(e){
     
    if($(this).hasClass('not-hide-submit-btn')){
        return;
    }
    //  if($(this).valid()){
          
        //  $(this).find('input[type="submit"],button[type="submit"]').css('display','none');
       //   $(this).find('input[type="submit"],button[type="submit"]').after('<div class="css-animated-loader"></div>'); 
         $(this).find('button[type="submit"]').attr('disabled',true); 
         $(this).find('button[type="submit"] div').addClass('css-animated-loader'); 
          
    //  }
      
  });

  
$(document).on("keypress",'.only-numbers',function(e){
    
    var ok = /[0-9]/.test(String.fromCharCode(e.charCode));
    if(e.charCode==0)
        ok=true;
    if (!ok)
        e.preventDefault();
});

$(document).on("keypress",'.only-alphabet',function(e){
    
    var ok = /[A-Za-z]/.test(String.fromCharCode(e.charCode));
    if(e.charCode==0)
        ok=true;
    if (!ok)
        e.preventDefault();
});

$(document).on("keypress",'.alpha-numeric',function(e){
    
    var ok = /[A-Za-z0-9]/.test(String.fromCharCode(e.charCode));
    if(e.charCode==0)
        ok=true;
    if (!ok)
        e.preventDefault();
});

$(document).on("keypress",'.alpha-num-space',function(e){
    var ok = /[A-Za-z0-9 ]/.test(String.fromCharCode(e.charCode));
    if(e.charCode==0)
        ok=true;
    if (!ok)
        e.preventDefault();
});
$(document).on("keypress",'.numeric-with-special-characters',function(e){
    var ok = /[0-9\/\-_]/.test(String.fromCharCode(e.charCode));
    if(e.charCode==0)
        ok=true;
    if (!ok)
        e.preventDefault();
});
$(document).on("input paste drop",'.decimal-numbers',function(e){
    this.value = this.value.replace(/[^0-9.]/g, ''); 
    this.value = this.value.replace(/(\..*)\./g, '$1');
});

//$(document).on("paste drop",'.only-numbers,.only-alphabet,.alpha-numeric,.alpha-num-space,.numeric-with-special-characters,.decimal-numbers',function(e){e.preventDefault();});

function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return '';
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}


