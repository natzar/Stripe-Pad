$ = $ || jQuery;	

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
} 	

/* Attribution New Visitor */
if (getCookie("stripepad_user") == "" || getCookie("stripepad_user") == "undefined"){
	var x = new Date();
	document.cookie = "stripepad_user="+ x.getTime();
	dt('visits-total',1);

	// First visit
	var x = new Date();
	document.cookie = "stripepad_first_visit="+ x.getTime();
	
	// First Landing
	document.cookie = "stripepad_first_landing="+document.location.href;
	
	// Source
	var queryString = window.location.search;
	if (queryString){
		var urlParams = new URLSearchParams(queryString);
		if ( urlParams.get('hsa_kw')){
			document.cookie = "stripepad_source=adwords"+urlParams.get('hsa_kw');

		}
		if(urlParams.get('source')){
			document.cookie = "stripepad_source="+urlParams.get('source');			
		} 
	}else if (document.referrer.indexOf('google') > -1){
		document.cookie = "stripepad_source=seo";							
	}else{
		document.cookie = "stripepad_source=direct";
	}
	
}

	
	// Fill source input field (Signup)
	if ($('input[name=source]').length > 0){
		$('input[name=source]').val(getCookie("stripepad_source") )
	}
			
	
