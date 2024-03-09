<?


if (function_exists('__')){
	}else{
		 function __($f){
	return $f;
}
}



function replaceTemplateValues($body,$p){
	
	foreach($p as $k => $v){
			if ($k == "persona_contacto"){ // Sin apellidossi
				$v = explode(" ",$v);
				$v = $v[0];
			}
			$body = str_replace("{{".$k."}}",$v,$body);
	}

	if (isset($p['persona_contacto'])) {
		$body = str_replace("{{persona_contacto_completo}}",$p['persona_contacto'],$body);	
	}
	
			
		
	$weekdays = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	$body = str_replace("{{dia_semana}}",$weekdays[date("w")],$body);
	
	$body = str_replace("{{fecha_completa}}",Date("d/m/Y H:i:s"),$body);

	$body = str_replace("{{fecha}}",Date("d/m/Y"),$body);

	$body = str_replace(" ,",Date(","),$body);

	// Prevent errors
	$body = preg_replace('/\\{{2}(.*)\\}{2}/', '', $body);
	return $body;

}

// Pass in the string you'd for which you'd like a random output
function spintax ($str) {
    // Returns random values found between { this | and }
    return preg_replace_callback("/{(.*?)}/", function ($match) {
        // Splits 'foo|bar' strings into an array
        $words = explode("|", $match[1]);
        // Grabs a random array entry and returns it
        return $words[array_rand($words)];
    // The input string, which you provide when calling this func
    }, $str);
}



function howManyDaysSince($date){
	$now = time(); // or your date as well
	if ($date= strtotime($date)){

		$datediff = $now - $date;
		$delay = round($datediff / (60 * 60 * 24));
		return $delay;
	}else{
		return 100;
	}
}

function format_stripe_amount($amount) {
  return sprintf('$%0.2f', $amount / 100.0);
}

function format_stripe_timestamp($timestamp) {
  return strftime("%m/%d/%Y", $timestamp);
}

function format_number($n){
	return number_format($n,2,",",".");
}
	
function ticketstatus($id){
	
	$status = Array("","Nuevo","Abierto","En Espera","Cerrado","Archivado","Descartado");
	return $status[$id];
}

function ticketstype($id){
	
	$status = Array("","Reparación","Optimización","Malware","Diseño Web","SEO","Hosting","Migración","Cambios dentro de secciones","Importadores CSV/XML","Bolsa de horas","Landings","Updates Prestashop","Google","Mantenimiento");
	if (isset($status[$id])) return $status[$id];
	return $status[1];
}
function labelPlan($id){
	if ($id < 2) return '<span class="rounded-full   px-1 bg-red-100 text-xs font-semibold text-red-600">Sin Plan </span>';
	$status = Array("","","Basico (old)","Plan WordPress","Plan Optimización (old)","Plan Tienda Online","Plan SEO","Plan Empresa");
	return '<span class="rounded-full text-xs px-1 bg-green-100 font-semibold text-green-600">'.$status[$id].'</span>';
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


function fingerPrint($result){
	// Remove all accents. Compatibility for Spanish strings
	$result = removeAccents($result);
	// Every char to lowercase
	$result = strtolower($result);
	// Remove all chars that are not letters
	$result = preg_replace('/[^ \w]+/', '', $result);
	$words = explode(" ",$result);
	// remove duplicates
	$words = array_unique($words);
	// the order of terms is important
	sort($words);
	// "-" to separate terms, but you can get rid of this
	return implode("-",$words);
}


function saveTranslations($json){
return $token;
}

/*
if (!function_exists('__')){
function __($token,$lang = null){        
return $token;
    }
    }
*/
    
    

function cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }
  
  function time_elapsed_string($datetime, $full = false) {
if (empty($datetime)) return "Nunca";
  if ($datetime == "0000-00-00 00:00:00") return "Nunca";
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'año',
        'm' => 'mes',
        'w' => 'semana',
        'd' => 'dia',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
	$return = "";
	
	if ($now > $ago){
    if (!$full) $string = array_slice($string, 0, 1);
    $return = $string ?  'Hace '. implode(', ', $string)  : 'justo ahora';
    }else{$string = array_slice($string, 0, 1);
    $return = 'En  '. implode(', ', $string);
    }
    return str_replace("mess","meses",$return);
}


function sanitize($input) {

/* Clearify */
	if ($input == '') return -1;
	//$input  = cleanInput($input);
	$output = $input;
    return $output;
}

function removeAccents($s) {
    $replace = array(
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'Ae', 'Å'=>'A', 'Æ'=>'A', 'Ă'=>'A',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'ae', 'å'=>'a', 'ă'=>'a', 'æ'=>'ae',
        'þ'=>'b', 'Þ'=>'B',
        'Ç'=>'C', 'ç'=>'c',
        'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E',
        'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 
        'Ğ'=>'G', 'ğ'=>'g',
        'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'İ'=>'I', 'ı'=>'i', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
        'Ñ'=>'N',
        'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'Oe', 'Ø'=>'O', 'ö'=>'oe', 'ø'=>'o',
        'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
        'Š'=>'S', 'š'=>'s', 'Ş'=>'S', 'ș'=>'s', 'Ș'=>'S', 'ş'=>'s', 'ß'=>'ss',
        'ț'=>'t', 'Ț'=>'T',
        'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'Ue',
        'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'ue', 
        'Ý'=>'Y',
        'ý'=>'y', 'ý'=>'y', 'ÿ'=>'y',
        'Ž'=>'Z', 'ž'=>'z'
    );
    return strtr($s, $replace);
}


function get_param($param){
	if (isset($_GET[$param]))
		return sanitize($_GET[$param]);
	if (isset($_POST[$param]))
		return sanitize($_POST[$param]);
	return -1;
}

function gett(){

		// Takes USER INPUT, normalize, sanitize, and returns and array
	    $retrieved = -1;	
		$params = array();
		if (count($_GET) > 0){
			foreach ($_GET as $key => $value)
				//$aux = sanitize($value);
				$params[$key] = trim($value);			
		} 
		if (count($_POST) > 0){
			foreach ($_POST as $key => $value)
				//$aux = sanitize($value);
				if (is_array($value)){
					$params[$key] = $value;
				}else{
					$params[$key] = trim($value);
				}

		}	
		
		if (!isset($params['offset'])) $params['offset'] = 0;
		if (!isset($params['perpage'])) $params['perpage'] = 18;
   return $params;

}


function json_from_array($array){
	$json = new Services_JSON();
	$aux = $json->encode($array);
	return $aux;
}

function generar_cadena_random($long){ 
//
// Genera cadena aleatoria de minusuclas i numeros.
// Requiere pasarle una variable con la longitud de la cadena que queremos.
// Devuelve la cadena de la longitud dada.

	$str = "abcdefghijklmnopqrstuvwxyz1234567890";
	$cad = "";
	for($i=0;$i<$long;$i++) {
	$cad .= substr($str,rand(0,36),1);
	}
	return $cad;

}


// FORMS
function create_combo_before_number($name){
	echo "<select name=\"".$name."\">

	<option value=\">=\">>=</option>
		<option value=\"<=\"><=</option>
	</select> ";
}

function float_to_sql($valor){
	$valor = str_replace('.','',$valor);
	$valor = str_replace(',','.',$valor);
	return $valor;
}
function generate_seo_link($input,$replace = '-',$remove_words = true,$words_array = array())
{

if (preg_match("/\p{Han}+/u", $input)) return $input;
	//make it lowercase, remove punctuation, remove multiple/leading/ending spaces
	$input = removeAccents($input);
	$return = trim(preg_replace('/[^a-zA-Z0-9\s]/','',strtolower($input)));

	//remove words, if not helpful to seo
	//i like my defaults list in remove_words(), so I wont pass that array
	if($remove_words) { $return = remove_words($return,$replace,$words_array); }

	//convert the spaces to whatever the user wants
	//usually a dash or underscore..
	//...then return the value.
	return str_replace(' ',$replace,$return);
}

/* takes an input, scrubs unnecessary words */
function remove_words($input,$replace,$words_array = array(),$unique_words = true)
{
	//separate all words based on spaces
	$input_array = explode(' ',$input);

	//create the return array
	$return = array();

	//loops through words, remove bad words, keep good ones
	foreach($input_array as $word)
	{
		//if it's a word we should add...
		if(!in_array($word,$words_array) && ($unique_words ? !in_array($word,$return) : true))
		{
			$return[] = $word;
		}
	}

	//return good words separated by dashes
	return implode($replace,$return);
}


function get_extension($file_name){
	$ext = explode('.', $file_name);
	$ext = array_pop($ext);
	return strtolower($ext);
}


function resize_image($stype,$fname,$destino,$n_width,$n_height) {

	if ($n_width == 0 and $n_height == 0){
		copy($fname,$destino);
		return false;
	}
	switch($stype) {
	        case 'gif':
	        $img = imagecreatefromgif($fname);
	        break;
	        case 'jpg':
	        $img = imagecreatefromjpeg($fname);
	        break;
	        case 'jpeg':
	        $img = imagecreatefromjpeg($fname);
	        break;
	
	        case 'png':
	        $img = imagecreatefrompng($fname);
	        break;
	    }
	 
		$ancho = imagesx($img);
		$alto = imagesy($img);

		if ($n_width > $ancho and $n_height > $alto){
			copy($fname,$destino);
			return false;
		}

	if ($ancho > $alto){ // changed for bisdixit.Falta funcio make thumbs make content i make bigs
		$r_ancho = $n_width;
		$r_alto = ($alto * $r_ancho) / $ancho;
	}else if ($ancho < $alto){
		$r_alto = $n_height;
		$r_ancho = ($ancho * $r_alto) / $alto;	
	} else { // iguales
		$r_ancho = $n_width;
		$r_alto = ($alto * $r_ancho) / $ancho;
	
	}

	$r_alto = number_format($r_alto,0,"","");
	$r_ancho = number_format($r_ancho,0,"","");
	$thumb = imagecreatetruecolor($r_ancho,$r_alto); 
	$fname22= $destino;
	imagecopyresampled($thumb,$img,0,0,0,0,$r_ancho,$r_alto,$ancho,$alto); 
	
	 switch($stype) {
	        case 'gif':
			 imagegif($thumb, $fname22,100);
	        break;
	        case 'jpg':
		      imagejpeg($thumb, $fname22,100);
	        break;
	        case 'jpeg':
	         imagejpeg($thumb, $fname22,100);
	        break;
	
	        case 'png':
	        imagepng($thumb, $fname22);
	        break;
    }
 
  
}

function cropImage($nw, $nh, $source, $stype, $dest) {
//
// CROP IMAGE ( Recorte forzado de imagen )
// Necesita: NUEVO_ANCHO, NUEVO_ALTO, PATH DE ARCHIVO FUENTE, EXTENSION DE 3 LETRAS ARCHIVO, PATH Y NOMBRE ARCHIVO DESTINACION
//
// Devuelve true si todo ha ido correcto.
// El resultado es la copia del archivo manipulado.

    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];
 
    switch($stype) {
        case 'gif':
        $simg = imagecreatefromgif($source);
        break;
        case 'jpg':
        $simg = imagecreatefromjpeg($source);
        break;
        case 'jpeg':
        $simg = imagecreatefromjpeg($source);
        break;

        case 'png':
        $simg = imagecreatefrompng($source);
        break;
    }
 
    $dimg = imagecreatetruecolor($nw, $nh);
 
    $wm = $w/$nw;
    $hm = $h/$nh;
 
    $h_height = $nh/2;
    $w_height = $nw/2;
 
    if($wm> $hm) {
 
        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;
 
        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
 
    } elseif(($wm <$hm) || ($w == $h)) {
 
        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;
 
        imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
 
    } else {
        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
    }
 
  
   
    switch($stype) {
        case 'gif':
imagegif($dimg,$dest,100);
        break;
        case 'jpg':
       imagejpeg($dimg,$dest,100);       
        break;
        case 'jpeg':
       imagejpeg($dimg,$dest,100);       
        break;
        case 'png':
       imagepng($dimg,$dest);
               break;
    }

    
}


function clean_filename($aux){
	$aux =  preg_replace('[^a-zA-Z0-9._- ]', '', $aux);
	$aux =  str_replace(' ', '', $aux);
	$aux = removeAccents($aux);
	if (trim($aux) == '') return -1;
	else return trim($aux);

}


function generar_nombre_archivo($filename){

// NEW ONE, without saving filename just time stamp


$punto_pos = strrpos ( $filename, ".");
$soloname = substr($filename,0,$punto_pos );
$ext = substr($filename,$punto_pos + 1, strlen($filename) - $punto_pos);
$new_code = generar_cadena_random(7);
return Date("YmdHis")."_".$new_code.".".$ext;



// OLD ONE, saving filename
$punto_pos = strrpos ( $filename, ".");
$soloname = substr($filename,0,$punto_pos );
if (isset($_POST['title'])) $soloname = $_POST['title'];
if (isset($_POST['contenidossubcategorias'])) $soloname = $_POST['contenidossubcategorias'];
$soloname = clean_filename($soloname);
$ext = substr($filename,$punto_pos + 1, strlen($filename) - $punto_pos);
$new_code = generar_cadena_random(7);

return $soloname."_".$new_code.".".$ext;

}

  
function upload_image($var,$W,$H,$folder){
	$path = 'data/img/'.$folder.'/';
	

	if ($_FILES[$var]['name'] != ""){	
		$filename_new = $_SESSION['accountId']."_".generar_nombre_archivo($_FILES[$var]['name']);
		copy($_FILES[$var]['tmp_name'],$path.$filename_new);
		resize_image(get_extension($filename_new),$path.$filename_new,$path.$filename_new,$W,$H) ;
		cropImage($W, $H, $path.$filename_new,get_extension($filename_new), $path.$filename_new);

		return $filename_new;
	}
	return '';				
}



function distance($lat1, $lon1, $lat2, $lon2) {

    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lon1 *= $pi80;
    $lat2 *= $pi80;
    $lon2 *= $pi80;

    $r = 6371; // mean radius of Earth in km
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $km = $r * $c;

    //echo '<br/>'.$km;
    return round($km).' Km';

}



/** 
 * Truncates text.
 *
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 *
 * @param string $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 * @return string Trimmed string.
 */
function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = true) {
 if ($considerHtml) {
  // if the plain text is shorter than the maximum length, return the whole text
  if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
   return $text;
  }

  // splits all html-tags to scanable lines
  preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

  $total_length = strlen($ending);
  $open_tags = array();
  $truncate = '';

  foreach ($lines as $line_matchings) {
   // if there is any html-tag in this line, handle it and add it (uncounted) to the output
   if (!empty($line_matchings[1])) {
    // if it’s an “empty element” with or without xhtml-conform closing slash (f.e.)
    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
    // do nothing
    // if tag is a closing tag (f.e.)
    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
     // delete tag from $open_tags list
     $pos = array_search($tag_matchings[1], $open_tags);
     if ($pos !== false) {
      unset($open_tags[$pos]);
     }
     // if tag is an opening tag (f.e. )
    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
     // add tag to the beginning of $open_tags list
     array_unshift($open_tags, strtolower($tag_matchings[1]));
    }
    // add html-tag to $truncate’d text
    $truncate .= $line_matchings[1];
   }

   // calculate the length of the plain text part of the line; handle entities as one character
   $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
   if ($total_length+$content_length > $length) {
    // the number of characters which are left
    $left = $length - $total_length;
    $entities_length = 0;
    // search for html entities
    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
     // calculate the real length of all entities in the legal range
     foreach ($entities[0] as $entity) {
      if ($entity[1]+1-$entities_length <= $left) {
       $left--;
       $entities_length += strlen($entity[0]);
      } else {
       // no more characters left
       break;
      }
     }
    }
    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
    // maximum lenght is reached, so get off the loop
    break;
   } else {
    $truncate .= $line_matchings[2];
    $total_length += $content_length;
   }

   // if the maximum length is reached, get off the loop
   if($total_length >= $length) {
    break;
   }
  }
 } else {
  if (strlen($text) <= $length) {
   return $text;
  } else {
   $truncate = substr($text, 0, $length - strlen($ending));
  }
 }

 // if the words shouldn't be cut in the middle...
 if (!$exact) {
  // ...search the last occurance of a space...
  $spacepos = strrpos($truncate, ' ');
  if (isset($spacepos)) {
   // ...and cut the text in this position
   $truncate = substr($truncate, 0, $spacepos);
  }
 }

 // add the defined ending to the text
 $truncate .= $ending;

 if($considerHtml) {
  // close all unclosed html-tags
  foreach ($open_tags as $tag) {
   $truncate .= '';
  }
 }

return $truncate;

}

function mostrar_fecha_completa($fecha)
{
$subfecha=explode("-",$fecha); 
   for($i=0;$i<count($subfecha);$i++); 
$año=$subfecha[0];
$mes=$subfecha[1];
$dia=$subfecha[2];

$dia2=date( "d", mktime(0,0,0,$mes,$dia,$año));
$mes2=date( "m", mktime(0,0,0,$mes,$dia,$año));
$año2=date( "Y", mktime(0,0,0,$mes,$dia,$año));
$dia_sem=date( "w", mktime(0,0,0,$mes,$dia,$año));

   switch($dia_sem) { 
      case "0":   // Bloque 1 
         $dia_sem3='Domingo'; 
               break; 
      case "1":   // Bloque 1 
         $dia_sem3='Lunes'; 
               break; 
        case "2":   // Bloque 1 
         $dia_sem3='Martes'; 
               break; 
        case "3":   // Bloque 1 
         $dia_sem3='Miercoles'; 
               break; 
        case "4":   // Bloque 1 
         $dia_sem3='Jueves'; 
               break; 
        case "5":   // Bloque 1 
         $dia_sem3='Viernes'; 
               break; 
        case "6":   // Bloque 1 
         $dia_sem3='Sabado'; 
               break; 
      default:   // Bloque 3 
         };
   
    switch($mes2) { 
      case "1":   // Bloque 1 
         $mes3='Enero'; 
               break; 
      case "2":   // Bloque 1 
         $mes3='Febrero';
     break; 
      case "3":   // Bloque 1 
         $mes3='Marzo';
     break; 
 case "4":   // Bloque 1 
         $mes3='Abril'; 
     break;  
 case "5":   // Bloque 1 
         $mes3='Mayo';
     break;   
 case "6":   // Bloque 1 
         $mes3='Junio';    
               break; 
 case "7":   // Bloque 1 
         $mes3='Julio';
     break; 
 case "8":   // Bloque 1 
         $mes3='Agosto';
     break; 
 case "9":   // Bloque 1 
         $mes3='Septiembre';
     break; 
 case "10":   // Bloque 1 
         $mes3='Octubre';
     break; 
 case "11":   // Bloque 1 
         $mes3='Noviembre';
     break;           
 case "12":   // Bloque 1 
         $mes3='Diciembre';  
     break; 
      default:   // Bloque 3 
     break; 
         }; 
   
   
$fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;

return $fecha_texto;
};

 function extract_email($string){
	 preg_match_all('/^(.+\@.+\..+)$/',$string,$matches);
	 
	 return $matches[0];
 }
 function extract_phone($string){
	 preg_match_all('/^[0-9]{9}$/',$string,$matches);
	 return $matches[0];

 }
  function extract_url($string){
	 preg_match('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#',$string,$matches);
	 return $matches[0];

 }







 
if (isset($_POST['submit'])): 

    include "emailValidator/emailValidator.php";

    $emailValidator = new emailValidator();

    if ($emailValidator->isValid($_POST['email']) and empty($_POST['name'])):
//  print_r($_POST);
$settings = '{
    "url": "yourdomain.com",
    "submit": "",
    "body_main": "Hi {{name}}!\r\n\r\nThanks for sharing our product.\r\nYou can use this coupon code DISCOUNTOFF20 to get your discount!\r\n\r\nYour friends have been notified and got another discount coupon (-10% off) thanks to you \r\n",
    "button_cta": "GET COUPON",
    "deal_title": "Hi there!",
    "max_friends": "3",
    "body_friends": "Your friend {{name}},\r\n\r\nWants to share with you Ref Boost, a tool to convert your visitors into referrers.\r\nYou can try it for free, but if you want the premium license you can use discount 10OFF to get a 10% discount!\r\n\r\nCheck it out: www.refboost.com\r\n",
    "primary_color": "#493df0",
    "deal_description": "Share it with 3 friends and get a $40 off for life"
}';

  include "./widget/bd.php";

  $sha1= sha1($_POST['email']);
  $q = $bd->prepare("insert into users (hash,email,settings) VALUES (:hash,:email,:settings)");
  $q->bindParam(":email",$_POST['email']);
  $q->bindParam(":hash",$sha1);
  $q->bindParam(":settings",$settings);

  //$q->bindParam(":url",$_POST['url']);
  $q->execute();

  $body= "
  Welcome to RefBoost,
  <br><br>
  Please click this link to customize your widget and get the line to copy paste to make it work in your website.
  <br><br>
  https://refboost.com/customizer.php?id=".$sha1."
  <br><br>
  You can reply this email for any question or help,
<br><br>
  ----<br>
  The RefBoost Team<br><br>";

  //echo sha1($_POST['email']);

  require("widget/lib/class.phpmailer.php");
  include "widget/lib/class.smtp.php";
   
    $to = $_POST['email'];
    $subject = "Welcome to RefBoost";
    
    $mail = new PHPMailer();
    $mail->IsSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.your-server.de';                 // Specify main and backup server
    
    $mail->Port = 587;                                    // Set the SMTP port
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'hello@refboost.com';
    $mail->Password = 'fC58Iky658aeJ2VZ';                  // SMTP password
    $mail->SMTPSecure = 'tsl';     
       $mail->SetFrom("hello@refboost.com");
   // $mail->AddCC("hello@natzar.co");
    $mail->IsHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->AddAddress($to);
    $mail->Subject = $subject;
    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
    $mail->MsgHTML($body); 
    

    if ($mail->Send()):

     





?>

<div class="rounded-md bg-green-50 p-4">
  <div class="flex">
    <div class="flex-shrink-0">
      <!-- Heroicon name: mini/check-circle -->
      <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
      </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm font-medium text-green-800">Sign up completed</h3>
      <div class="mt-2 text-sm text-green-700">
        <p>Please check your inbox to continue widget setup</p>
      </div>
      <div class="mt-4">
       
      </div>
    </div>
  </div>
</div>
<? else: ?>

<div class="rounded-md bg-green-50 p-4">
  <div class="flex">
    <div class="flex-shrink-0">
      <!-- Heroicon name: mini/check-circle -->
      <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
      </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm font-medium text-green-800">Some error ocurred</h3>
      <div class="mt-2 text-sm text-green-700">
        <p>Please try again or contact us at hello@refboost.com</p>
      </div>
      <div class="mt-4">
       
      </div>
    </div>
  </div>
</div>

<?
endif;
endif;
    endif;
  ?>