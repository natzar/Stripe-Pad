<?
include "cors.php";
header('Content-Type: application/javascript');
if (!isset($_GET['id'])) {  
  die();
}
 
include "bd.php"; 

$q = $bd->prepare("SELECT * from users where hash = :e limit 1" );
$q->bindParam(":e",$_GET['id']);
$q->execute();
$user = $q->fetch();

if (empty($user)){
die();
}

$WIDGET_ID = $_GET['id'];

function __($t){  return $t; } 

?>

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

window.mobileCheck = function() {
  let check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
};


window.refboost = {

  	boot: true,
  	adwords: null,
  	language: 'es',

  	sent: false,
  	saved_cta: "",
  	langs: ['es'],
	sendUrl:null,
	templateUrl: null,
  	localhost_env: false,

  setup: function() {
	var self = this;
	console.log('Starting RefBoost Widget v1.0 - refboost.com');
	// SEtting for mobile
	// if (mobileCheck()) {
	//   return;
	// }

	if (window.location.href.indexOf('localhost') > -1) {
	  	this.localhost_env = true;
	  	console.log('Localhost environment');
	 	self.templateUrl = 'http://localhost/refboost/dist/widget/template.php?id=<?= $WIDGET_ID ?>';
	 	self.sendUrl = 'http://localhost/refboost/dist/widget/send.php';


	}else{
		self.templateUrl = 'https://refboost.com/widget/template.php?id=<?= $WIDGET_ID ?>';
	  	self.sendUrl = 'https://refboost.com/widget/send.php';
	}




	//if (typeof $ == "undefined" && typeof jQuery == "undefined") self.loadScript('https://code.jquery.com/jquery-3.5.1.min.js');
	var elem = document.createElement('div');

	elem.setAttribute("id", "refboost_refboost");

	document.body.appendChild(elem);

	// Language
	var url = window.location.href
	var regex = new RegExp('[?&]' + 'lang' + '(=([^&#]*)|&|#|$)'),
	  results = regex.exec(url);
	var lang = null;
	if (!results || !results[2]) {
	  var userLang = navigator.language || navigator.userLanguage;
	  userLang = userLang.substr(0, 2).toLowerCase();
	  if (self.langs.indexOf(userLang) > -1) self.language = userLang;
	} else {
	  lang = decodeURIComponent(results[2].replace(/\+/g, ' '));
	  self.language = lang;
	}

	console.log("FD: selected language " + self.language);


	this.render();
	this.getAdwordsInfo();

	return self;

  },
  render: function() {
	this.loadHtml('refboost_refboost',this.templateUrl)

  },
  	init: function() {
	
		

		var self = this;

		if (self.boot) {
			self.boot = false;
			
		}
		
		document.getElementById("firstField").focus();
			document.getElementById("refboost_submit_button").addEventListener("click", self.sendForm);
			document.getElementById("refboost_trigger").classList.remove("fadeIn");
			document.getElementById("refboost_chat").classList.add("slideUp");

		//return false;
  	},

  loadHtml: function(parentElementId, filePath) {
	const init = {
	  method: "GET",
	  headers: {
		"Content-Type": "text/html"
	  },
	  mode: "cors",
	  cache: "default"
	};
	const req = new Request(filePath, init);
	fetch(req)
	  .then(function(response) {
		r = response.text();
		console.log(r);
		return r;
	  })
	  .then(function(body) {
		// Replace `#` char in case the function gets called `querySelector` or jQuery style
		if (parentElementId.startsWith("#")) {
		  parentElementId.replace("#", "");
		}
		document.getElementById(parentElementId).innerHTML = body;

	  });
  },

  getAdwordsInfo: function() {
	var queryString = window.location.search;
	if (queryString) {
	  var urlParams = new URLSearchParams(queryString);
	  if (urlParams.get('hsa_kw'))
		this.adwords = urlParams.get('hsa_kw');
	  document.cookie = "source=" + urlParams.get('hsa_kw');
	} else {
	  if (getCookie("source") != "") {
		this.adwords = getCookie("source");
	  } else {
		//  document.cookie = "seo?";
	  }
	}


  },

  close: function() {
	document.getElementById('refboost_trigger').classList.add('fadeIn');
	document.getElementById('refboost_chat').classList.remove('slideUp');
  },
  toggleLoading: function(close) {
  	var self = this;
  	var button = document.getElementById('refboost_submit_button');
	if (close) {
		button.value = self.saved_cta;
		button.disabled = false;		
		document.getElementById('refboost_loading').classList.add("hide");

	} else {
	 	
		self.saved_cta = button.value;
		button.disabled = true;		
		button.value = "One moment please ...";
		document.getElementById('refboost_loading').classList.remove("hide");
	}
	return false;
  },

  

   isEmailFormat: function(email) {
   		const emailRegex = /^[-!#$%&'*+\/0-9=?A-Z^_a-z`{|}~](\.?[-!#$%&'*+\/0-9=?A-Z^_a-z`{|}~])*@[a-zA-Z0-9](-*\.?[a-zA-Z0-9])*\.[a-zA-Z](-?[a-zA-Z0-9])+$/;
  		return emailRegex.test(email);
	},
  sendForm: function(e) {
  	var self = window.refboost;
	
	

	var form = document.getElementById('refboost_form');

	var elements = form.elements;
	ok = true;
	var firstEmail = document.getElementById('firstEmail');
	var friends = [];
	for (var i = 0, element; element = elements[i++];) {
		element.classList.remove("red-border");
	    if (friends.indexOf(element.value) > -1 || (element.type === "email" && element.value === "") || (element.type === "email" && !self.isEmailFormat(element.value)) || (element.type === "text" && element.value == "")){
			ok = false;
			element.classList.add("red-border");
	    }
	    
	    friends.push(element.value);
	    
	}
	if (!ok){		
		return false;
	}
	self.toggleLoading();

	var data = new FormData(form);
	console.log(data);

    data.append("id", '<?= $WIDGET_ID ?>');

	
	var init = {
	  method: "POST",
	  headers: {
		
	  },
	  mode: "no-cors",
	  cache: "default",
	  body: data
	};
	document.getElementById('form-content').classList.add('hide');
	const req = new Request(self.sendUrl, init);
	fetch(req)
	  .then(function(response) {
		r = response.text();
		console.log(r);
		self.toggleLoading(true);
		
		return r;
	  })
	  .then(function(body) {
		// Replace `#` char in case the function gets called `querySelector` or jQuery style
		
		console.log(body);
		var r = JSON.parse(body);
		self.toggleLoading(true);
		if (r.success){
			document.getElementById('refboost_success_msg').classList.remove("hide")
		}else{
			alert(r.msg);	
			document.getElementById('form-content').classList.remove('hide');
			self.toggleLoading(true);
		}
		
		
	  }).catch(function(e){
	  	console.log(e);
	  });
	}	    
};

refboost.steps = ['<?= __('Hola, estoy disponible, ¿cómo puedo ayudarte?') ?>', '<?= __('Yo me encargo de ponerte en contacto con un asesor. ¿Cuál es tu nombre?') ?>', '<?= __('¿Cuál es tu teléfono?') ?>','<?= __('¿Me dejas tu email?') ?>','<?= __('¿Cuál es tu página web?') ?>','<?= __('¿Alguna consulta adicional?') ?>','<?= __('Con toda la información que me has pasado, un asesor se pondrá en contacto contigo en breve') ?>'];

refboost.resteps = ['<?= __('Hola! aquí Laura de Php Ninja, ¿qué necesitas?') ?>','<?= __('¿Me podrías decir cómo te llamas?') ?>','<?= __('Me dejas tu teléfono por favor?') ?>','<?= __('¿Me dices qué dirección de email usas por favor?')?>','<?= __('Me dejas la dirección de tu página web por favor?') ?>','<?= __('¿Alguna otra cosa?') ?>','<?= __('Recibido, se lo paso al asesor') ?>'];
  
refboost.final = '<?= __('Con toda la información que me has pasado, un asesor se pondrá en contacto contigo en breve') ?>';
refboost.auxiliars = ['<?= __('Yo me encargo de ponerte en contacto con un asesor.') ?>', '<?= __('Yo enviaré tus datos a un asesor para que se ponga en contacto contigo.') ?>','<?= __('Ok, si no me dejas tus datos no podré ayudarte.') ?>','<?= __('Sólo quiero tus datos para ponernos en contacto contigo.') ?>',': )'];
refboost.translations = {};
refboost.translations['pleasure_to_assist_you'] = '<?= __('Será un placer asistirte') ?>';
refboost.translations['hello'] = '<?= __('Hola') ?>';
refboost.translations['customer'] = '<?= __('Cliente') ?>';
refboost.translations['thanks'] = '<?= __('Gracias por ponerte en contacto!') ?>';
refboost.translations['Available'] = '<?= __('Disponible ahora') ?>';

refboost.translations ['writehere'] = '<?= __('Escribe aquí'); ?>';

	

refboost.setup();


