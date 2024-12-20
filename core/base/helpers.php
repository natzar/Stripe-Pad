<?


if (function_exists('__')) {
} else {
    function __($f)
    {
        return $f;
    }
}


function getCurrentUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];
    return $protocol . $domainName . $requestUri;
}
function replaceTemplateValues($body, $p)
{

    foreach ($p as $k => $v) {
        if ($k == "persona_contacto") { // Sin apellidossi
            $v = explode(" ", $v);
            $v = $v[0];
        }
        $body = str_replace("{{" . $k . "}}", $v, $body);
    }

    if (isset($p['persona_contacto'])) {
        $body = str_replace("{{persona_contacto_completo}}", $p['persona_contacto'], $body);
    }



    $weekdays = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
    $body = str_replace("{{dia_semana}}", $weekdays[date("w")], $body);

    $body = str_replace("{{fecha_completa}}", Date("d/m/Y H:i:s"), $body);

    $body = str_replace("{{fecha}}", Date("d/m/Y"), $body);

    $body = str_replace(" ,", Date(","), $body);

    // Prevent errors
    $body = preg_replace('/\\{{2}(.*)\\}{2}/', '', $body);
    return $body;
}



function howManyDaysSince($date)
{
    $now = time(); // or your date as well
    if ($date = strtotime($date)) {

        $datediff = $now - $date;
        $delay = round($datediff / (60 * 60 * 24));
        return $delay;
    } else {
        return 100;
    }
}

function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


function fingerPrint($result)
{
    // Remove all accents. Compatibility for Spanish strings
    $result = removeAccents($result);
    // Every char to lowercase
    $result = strtolower($result);
    // Remove all chars that are not letters
    $result = preg_replace('/[^ \w]+/', '', $result);
    $words = explode(" ", $result);
    // remove duplicates
    $words = array_unique($words);
    // the order of terms is important
    sort($words);
    // "-" to separate terms, but you can get rid of this
    return implode("-", $words);
}


function saveTranslations($token)
{
    return $token;
}

/*
if (!function_exists('__')){
function __($token,$lang = null){        
return $token;
    }
    }
*/



function cleanInput($input)
{

    $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
    );

    $output = preg_replace($search, '', $input);
    return $output;
}

function time_elapsed_string($datetime, $full = false)
{
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

    if ($now > $ago) {
        if (!$full) $string = array_slice($string, 0, 1);
        $return = $string ?  'Hace ' . implode(', ', $string)  : 'justo ahora';
    } else {
        $string = array_slice($string, 0, 1);
        $return = 'En  ' . implode(', ', $string);
    }
    return str_replace("mess", "meses", $return);
}


function gett()
{
    // Takes USER INPUT, normalize, sanitize, and returns and array
    $retrieved = -1;
    $params = array();
    $filter = FILTER_SANITIZE_STRING;

    // Check if the key exists in the $_GET array
    if (isset($_GET)) {
        // Return the sanitized value using a specified filter
        // Default filter is FILTER_SANITIZE_STRING which removes tags and encode special characters
        foreach ($_GET as $k => $v) {
            if (filter_input(INPUT_GET, $k, $filter)) {
                $params[$k] = $v;
            }
        }
    }
    if (isset($_POST)) {
        // Return the sanitized value using a specified filter
        // Default filter is FILTER_SANITIZE_STRING which removes tags and encode special characters
        foreach ($_POST as $k => $v) {
            if (filter_input(INPUT_POST, $k, $filter)) {
                $params[$k] = $v;
            }
        }
    }


    return $params;
}
