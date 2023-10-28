	session_start();
	$bd = new PDO('mysql:host=localhost;dbname=stripn_db1', 'stripn_1', 'Ex8hVBe6Q69kRyNJ');
	
	$allowed = array("title","username","description");

	foreach($_GET as $k => $v){
		if (in_array($k,$allowed)){
			$sql = "UPDATE shops set ".$k." = :v where shopsId = :sid";			
			$q = $bd->prepare($sql);
			$q->bindValue(":v",$v);
			$q->bindValue(":sid",$_SESSION['user']['shopsId'],PDO::PARAM_INT);
			$q->execute();
			echo json_encode(array("success" => true));
			return;
		}
	}
	echo json_encode(array("success" => false));

'sk_test_qiYztcer1es4kF3eAMNnIHIU'

sk_test_51MNJmFAHvW4Yx0ye5YKuLrugel99pv34ggZri3LotWw1biitvrqvKijJvduCQQSgfNgLoZfj60VAVLLi6cVPKBr600Ub1PD83Z
function invoice_payment_received_body($invoice) {
  $subscription = $invoice->lines->data[0];
  $nickname = $subscription->plan->nickname;
  $start = format_stripe_timestamp($subscription->period->start);
  $end = format_stripe_timestamp($subscription->period->end);
  $total = format_stripe_amount($invoice->total);
  
  return <<<EOD
-------------------------------------------------
PAGO SUSCRIPCIÓN / FACTURA ENVIADA
Nickname: {$nickname}
Plan: {$subscription->plan->name}
Amount: {$total} (USD)
For service between {$start} and {$end}
-------------------------------------------------
EOD;
}


function payment_received_body($charge) {

	$email =$charge->receipt_email;
	$product = isset($charge->metadata->product_name) ? $charge->metadata->product_name : $charge->description;
	$amount = format_stripe_amount($charge->amount);
  return <<<EOD
A payment has been charged successfully. 
-------------------------------------------------
PAYMENT RECEIPT
{$product}
Email: {$email}
Amount: {$amount} (EUR)
-------------------------------------------------
EOD;
}


<script>
  

function gtag_report_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-1068885820/Iw46COy655cBELzO1_0D',
      'event_callback': callback
  });
  return false;
}


var LANG = '<?= $LANG ?>';

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

var queryString = window.location.search;
    if (queryString){
    var urlParams = new URLSearchParams(queryString);
    if ( urlParams.get('hsa_kw'))
      document.cookie = "source="+urlParams.get('hsa_kw');
    }else{
      if (getCookie("source") != ""){
  
      }else{
      //  document.cookie = "seo?";
      }
    }
    
    $(document).ready(function(){
      if (getCookie("source") != "" && $('input[name=source]').length > 0){
        $('input[name=source]').val(getCookie("source") )
      }
      
    });
</script>