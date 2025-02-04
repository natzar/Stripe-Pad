
<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
  <!-- Stripe.js v3 for Elements -->
  <script src="https://js.stripe.com/v3/"></script>
  
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="py-12 bg-white min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
    <div class="lg:text-center items-center m-auto">
	    <img class="mx-auto mb-5" width="100" src="https://www.phpninja.net/phpninja-logo.jpg">
      <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Php Ninja</h2>
           <span class="flex-2 flex-shrink-0  flex inline-block pl-5 items-center justify-center">
 <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <!-- Heroicon name: solid/star -->
                <svg class="h-5 w-5 text-yellow-400 hidden sm:inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <!-- Heroicon name: solid/star -->
                <svg class="h-5 w-5 text-yellow-400 hidden sm:inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <!-- Heroicon name: solid/star -->
                <svg class="h-5 w-5 text-yellow-400 hidden sm:inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <!-- Heroicon name: solid/star -->
                <svg class="h-5 w-5 text-yellow-400 hidden sm:inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
&nbsp;&nbsp;
<span class="text-xs">   4.7 / 5</span>
		</span>
      <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
Redirección a pasarela de pagos
      </p>
            <p class="mt-2 text-2xl leading-8 font-extrabold tracking-tight text-gray-600 ">
Espera 1 segundo por favor ...
      </p>
      <p class="mt-4 max-w-2xl text-base text-gray-500 lg:mx-auto">
        Serás redirigido al área de clientes desde dónde podrás enviarnos datos de acceso, descargar la factura, encargar tareas o realizar auditorias de tu sitio web
      </p>
 
		
    </div>
  </div>
</div>

<script>
$= jQuery;
$(document).ready(function(e){	  
		  
		   var data_stripe = {
		    	items: <?= !$cart ? '[]' : json_encode($cart) ?>,
		    	customer: <?= !$customer ?  '[]':json_encode($customer)  ?>,
		    	product: <?= !$product  ? '[]' :json_encode($product) ?>,		    	
		    };
			

		    console.log(data_stripe);

		 		    
		    $.post('/stripe/token',data_stripe, function(data,error){

		    	var stripe = Stripe('<?=APP_STRIPE_PUBKEY ?>'); //pk_live_CRwYd2wN64LqtVhQ4d6AnyKi
		    	//pk_test_EC0VNl5ATLkcoDkqOAODvgYB
				data = JSON.parse(data);
				stripe.redirectToCheckout({
			  // Make the id field from the Checkout Session creation API response
			  // available to this file, so you can provide it as parameter here
			  // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
				  sessionId: data.id
				 
				}).then(function (result) {
			  // If `redirectToCheckout` fails due to a browser or network
			  // error, display the localized error message to your customer
			  // using `result.error.message`.
				  alert(result.error.message);
				  $('#payNow').removeClass("loading");
				});
	
		    });
		    
	
	});

</script>
  

