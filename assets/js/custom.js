
$(".menuBtn").click(function (e) {
    $("body").toggleClass("menuOpen");
    //$(this).toggleClass("iconchnage")
});


$(".menuBtnClose ").click(function (e) {
    $("body").removeClass("menuOpen");
});



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





// css-animated-loader

$(document).on('submit', 'form', function (e) {

    if ($(this).hasClass('not-hide-submit-btn')) {
        return;
    }
    //  if($(this).valid()){

    //  $(this).find('input[type="submit"],button[type="submit"]').css('display','none');
    //   $(this).find('input[type="submit"],button[type="submit"]').after('<div class="css-animated-loader"></div>'); 
    $(this).find('button[type="submit"]').attr('disabled', true);
    $(this).find('button[type="submit"] div').addClass('css-animated-loader');

    //  }

});


$(document).on("keypress", '.only-numbers', function (e) {

    var ok = /[0-9]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});

$(document).on("keypress", '.only-alphabet', function (e) {

    var ok = /[A-Za-z]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});

$(document).on("keypress", '.alpha-numeric', function (e) {

    var ok = /[A-Za-z0-9]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});

$(document).on("keypress", '.alpha-num-space', function (e) {
    var ok = /[A-Za-z0-9 ]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});
$(document).on("keypress", '.numeric-with-special-characters', function (e) {
    var ok = /[0-9\/\-_]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});
$(document).on("input paste drop", '.decimal-numbers', function (e) {
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

function calcAge(dateString) {

    var birthday = +new Date(dateString.replace(/[-]/g, ' '));
    return ~~((Date.now() - birthday) / (31557600000));
}

function genPassword(passwordLength = 8) {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyz@#^*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    var password = "";
    for (var i = 0; i <= passwordLength; i++) {
        var randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber + 1);
    }
    return password;
}
