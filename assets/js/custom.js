
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


// $(document).on("keypress", '.only-numbers', function (e) {

//     var ok = /[0-9]/.test(String.fromCharCode(e.charCode));
//     if (e.charCode == 0)
//         ok = true;
//     if (!ok)
//         e.preventDefault();
// });

// $(document).on("keypress", '.only-alphabet', function (e) {

//     var ok = /[A-Za-z]/.test(String.fromCharCode(e.charCode));
//     if (e.charCode == 0)
//         ok = true;
//     if (!ok)
//         e.preventDefault();
// });

// $(document).on("keypress", '.alpha-numeric', function (e) {

//     var ok = /[A-Za-z0-9]/.test(String.fromCharCode(e.charCode));
//     if (e.charCode == 0)
//         ok = true;
//     if (!ok)
//         e.preventDefault();
// });


// $(document).on("keypress", '.alpha-num-space', function (e) {
//     var ok = /[A-Za-z0-9 ]/.test(String.fromCharCode(e.charCode));
//     if (e.charCode == 0)
//         ok = true;
//     if (!ok)
//         e.preventDefault();
// });

// $(document).on("keypress", '.numeric-with-special-characters', function (e) {
//     var ok = /[0-9\/\-_]/.test(String.fromCharCode(e.charCode));
//     if (e.charCode == 0)
//         ok = true;
//     if (!ok)
//         e.preventDefault();
// });

// $(document).on("input paste drop", '.decimal-numbers', function (e) {
//     this.value = this.value.replace(/[^0-9.]/g, '');
//     this.value = this.value.replace(/(\..*)\./g, '$1');
// });
// $(document).on("input paste drop", '.capitalize-each-word', function (e) {

//     this.value = this.value.replace(/[^A-Za-z ]/g, '');
//     this.value = this.value.toLowerCase().replace(/(^\w|\s\w)/g, m =>  m.toUpperCase());
// });
// $(document).on("input paste drop", '.capitalize-string', function (e) {
//     this.value = this.value.toUpperCase();
// });

$(document).on("input paste drop", 'input[type="text"]', function (e) {
    var $inputEle = $(this);
    var type='';
    if ($inputEle.hasClass('only-numbers')) {
        type = 'only-numbers';
    } else if ($inputEle.hasClass('only-alphabet')) {
        type = 'only-alphabet';
    } else if ($inputEle.hasClass('alpha-space')) {
        type = 'alpha-space';
    } else if ($inputEle.hasClass('alpha-space-dash')) {
        type = 'alpha-space-dash';
    } else if ($inputEle.hasClass('alpha-numeric')) {
        type = 'alpha-numeric';
    } else if ($inputEle.hasClass('alpha-num-space')) {
        type = 'alpha-num-space';
    } else if ($inputEle.hasClass('numeric-with-special-characters')) {
        type = 'numeric-with-special-characters';
    } else if ($inputEle.hasClass('decimal-numbers')) {
        type = 'decimal-numbers';
    }

    this.value = sanitizeString(this.value,type);

    if ($inputEle.hasClass('capitalize-each-word')) {
     
        this.value = changeCaseOfString(this.value,'capitalize-each-word')
    }

    if ($inputEle.hasClass('capitalize-string')) {
        this.value = changeCaseOfString(this.value,'capitalize-string')
    }

});

function sanitizeString(string,type){


    switch(type){
        case 'only-numbers':
            string = string.replace(/[^0-9]/g, '');
            break;
        case 'only-alphabet':
            string = string.replace(/[^A-Za-z]/g, '');
            break;
        case 'alpha-space':
            string = string.replace(/[^A-Za-z ]/g, '');
            break;
        case 'alpha-space-dash':
            string = string.replace(/[^A-Za-z -]/g, '');
            break;
        case 'alpha-numeric':
            string = string.replace(/[^A-Za-z0-9]/g, '');
            break;
        case 'alpha-num-space':
            string = string.replace(/[^A-Za-z0-9 ]/g, '');
            break;
        case 'numeric-with-special-characters':
            string = string.replace(/[^0-9\/\-_]/g, '');
            break;
        case 'decimal-numbers':
            string = string.replace(/[^0-9.]/g, '');
            string = string.replace(/(\..*)\./g, '$1');
            break;
    }

    return string;

    
}

function changeCaseOfString(string,type){
    switch(type){
        case 'capitalize-each-word':
            string = string.toLowerCase().replace(/(^\w|\s\w)/g, m =>  m.toUpperCase());
            break;
        case 'capitalize-string':
            string = string.toUpperCase();
            break;
        case 'lowercase-string':
            string = string.toLowerCase();
            break;
    }

    return string;
}


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
