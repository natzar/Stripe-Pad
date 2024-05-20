/*
    
    Ass less javascript as possible :P
    I love jquery * Some interactions for the landing and the menu
    09/03/2024

*/

$ = $ || jQuery;
         
$(document).ready(function(){    
    console.log("StripePad! Loaded...");

    $(window).scroll(function() {
        var height = $(window).scrollTop();

        if(height  > 80) {
             // do something
        } else {
             // do something
        }
    });

    // Add style to the link hrefing the current page
    var uri = unescape(document.location.href);
    uri = uri.substr(uri.indexOf(base_url)+base_url.length);
    
    if (uri == "/" || uri == ""){
        var obj = $("nav:first-child a[href='/dashboard']");
        obj.addClass("border-indigo-500 border-b-2");

    }else{
        var obj = $("nav:first-child a[href='"+uri+"']");
        var aux = uri.split("/");
        uri = aux[0]+"/"+aux[1];
        obj.each(function(){
        if ($(this).parent().get( 0 ).tagName == 'LI'){
            $(this).parent().addClass("border-indigo-500 border-b-2");
        }else{
            $(this).addClass("border-indigo-500 border-b-2");           
        }

        });
    }   

    // Toggle Menu Mobile
    $('#button_open_mobile_menu').click(function(){
        $('#mobile_menu').removeClass("hidden");        
    })

    $('#button_close_mobile_menu').click(function(){
        $('#mobile_menu').addClass("hidden");       
    })



});





