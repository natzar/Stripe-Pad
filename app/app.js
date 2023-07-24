/*

	STANDART
	CUSTOM - Application.js
	@Modify at your own
*/
$ = jQuery;
$(document).load(function(){
	
});		
		 
$(document).ready(function()
{

	console.log("Php Ninja PRO");
	console.log("Hi! Loaded...");
	
	var base_url = "https://app.phpninja.net";
	var	cadena = unescape(document.location.href);
	cadena = cadena.substr(cadena.indexOf(base_url)+base_url.length);
	
	

	if (cadena == "/" || cadena == ""){
		var obj = $("nav:first-child a[href='/dashboard']");
		obj.addClass("border-indigo-500 border-b-2");

	}else{

		var obj = $("nav:first-child a[href='"+cadena+"']");
		var aux = cadena.split("/");
	
		cadena = aux[0]+"/"+aux[1];
	


		obj.each(function(){
		if ($(this).parent().get( 0 ).tagName == 'LI'){
			$(this).parent().addClass("border-indigo-500 border-b-2");
		}else{
			$(this).addClass("border-indigo-500 border-b-2");			
		}

		});
	}	
/*
	language_link = cadena.substr(0,cadena.indexOf('/'));
	$('a[href="'+language_link+'"]').addClass("active list-group-item-active current-menu-item");			
	
	   var height = $(window).scrollTop();

    if(height  > 30) {
            $('#header').css("background","#242424");     // do something
    } else {
            $('#header').css("background","transparent");     // do something
    }
*/
    
});

/*

$(window).scroll(function() {
    var height = $(window).scrollTop();

    if(height  > 30) {
            $('#header').css("background","#242424");     // do something
    } else {
            $('#header').css("background","transparent");     // do something
    }
});
*/



