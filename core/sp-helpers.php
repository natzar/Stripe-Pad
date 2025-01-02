<?

/**
 * Package Name: Stripe Pad
 * File Description: Helper functions. Similar to functions.php file in wordpress, add here any helper or aux function you could need 
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 */

function friendlyUrl($input)
{
    $words_array = array('a', 'an', 'the', 'and', 'or', 'but', 'so', 'on', 'in', 'out', 'by', 'as', 'at', 'of');
    $replace = '-';

    // Prevent issues with non-latin
    if (preg_match("/\p{Han}+/u", $input)) {

        return $input; // Return the input directly if it contains non-Latin characters.
    }

    // Transliterate characters to ASCII
    $input = iconv('UTF-8', 'ASCII//TRANSLIT', $input);

    // Make it lowercase, remove punctuation, remove multiple/leading/ending spaces
    $input = trim(preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($input)));

    // Remove words if necessary

    $input_array = explode(' ', $input);
    $input = [];
    foreach ($input_array as $word) {
        if (!in_array($word, $words_array)) {
            $input[] = $word;
        }
    }
    $input = implode(' ', $input);


    // Convert the spaces then return the value
    return str_replace(' ', $replace, $input);
}


function get_parameters()
{
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


function get_masked_ip() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $parts = explode('.', $ip);

    // Check if the IP address format is valid (should have 4 parts for IPv4)
    if (count($parts) === 4) {
        // Replace the last three octets with 'xxx'
        // $parts[1] = 'xxx';
        // $parts[2] = 'xxx';
        $parts[3] = 'xxx';

        return implode('.', $parts);
    }

    // Return original IP if format is incorrect, or not IPv4
    return $ip;
}



function fingerPrint($result)
{
    // Remove all accents. Compatibility for Spanish strings
    $result = trim(preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($result)));
    // Every char to lowercase
    //$result = strtolower($result);
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



function distance($lat1, $lon1, $lat2, $lon2)
{

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
    return round($km) . ' Km';
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
function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = true)
{
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
            if ($total_length + $content_length > $length) {
                // the number of characters which are left
                $left = $length - $total_length;
                $entities_length = 0;
                // search for html entities
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                    // calculate the real length of all entities in the legal range
                    foreach ($entities[0] as $entity) {
                        if ($entity[1] + 1 - $entities_length <= $left) {
                            $left--;
                            $entities_length += strlen($entity[0]);
                        } else {
                            // no more characters left
                            break;
                        }
                    }
                }
                $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
                // maximum lenght is reached, so get off the loop
                break;
            } else {
                $truncate .= $line_matchings[2];
                $total_length += $content_length;
            }

            // if the maximum length is reached, get off the loop
            if ($total_length >= $length) {
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

    if ($considerHtml) {
        // close all unclosed html-tags
        foreach ($open_tags as $tag) {
            $truncate .= '';
        }
    }

    return $truncate;
}
