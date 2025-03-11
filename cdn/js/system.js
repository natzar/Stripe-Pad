if (navigator.webdriver) {
    fetch('/bot-detected.php');
}


// I love jquery

$(document).ready(function () {

    console.log('init Domstry ');
    console.log('Contact betolopezayesa@gmail.com if you do want api access');

    $('#button_open_mobile_menu').click(function () {
        $('#mobile_menu').removeClass("hidden");
    })

    $('#button_close_mobile_menu').click(function () {
        $('#mobile_menu').addClass("hidden");
    })

});
