<?php
/*
*
*
*   Custom helper functions to be used inside your templates or login
*
*
*
*
*/
function greetUser()
{
	$hour = (int)date('H');

	if ($hour >= 5 && $hour < 12) {
		return "Good morning!";
	} elseif ($hour >= 12 && $hour < 18) {
		return "Good afternoon!";
	} elseif ($hour >= 18 && $hour < 22) {
		return "Good evening!";
	} else {
		return "Good night!";
	}
}




function get_timezone($city)
{

	$CURRENT_TIMEZONE = null;

	$timezones = array(
		"los-angeles" => 'America/Los_Angeles',
		"new-york" => 'America/New_York',
		"san-francisco" => 'America/Los_Angeles',
		"miami" => 'America/New_York',
		"barcelona" => 'Europe/Madrid',
		"vic" => 'Europe/Madrid',
		"madrid" => 'Europe/Madrid',
		"lisboa" => 'Europe/Madrid',
		"ibiza" => 'Europe/Madrid',
		"berlin" => 'Europe/Berlin',
		"london" => 'Europe/London',
	);

	if (!isset($city) or empty($city) or !isset($timezones[$city])) {
		date_default_timezone_set($timezones['madrid']);
		return $timezones['madrid'];
	} else {
		//$timezones[$city] = $timezones['los-angeles'];

		date_default_timezone_set($timezones[$city]);
		return $timezones[$city];
	}
}


function daysBtwDates($A, $B)
{
	$now = strtotime($B);
	$your_date = strtotime($A);
	$datediff = $now - $your_date;

	return floor($datediff / (60 * 60 * 24));
}

function nightsBtwDates($A, $B)
{
	return daysBtwDates($A, $B);
}
function beautyDate($date, $show_year = false)
{
	if ($date == "") return $date;
	if (strstr($date, "T")) {
		$aux = explode("T", $date);
		$date = $aux[0];
	}
	$aux = explode("-", $date);
	//     $day = $aux[2];

	$text = date('l, F jS', strtotime($date));
	/*
  $text = strftime( "%A, %B %e",strtotime($date));
    if ($day < 4){
        switch($day){
            case 1:
                $text .="st";
            break;
            case 2:
                $text .="nd";
            break;
            case 3:
                $text .="rd";
            break;
        }
    }else{
        $text .="th";
    }
*/
	if ($show_year) $text .= " " . $aux[0];
	return $text;
}


function generate_seo_link($input, $replace = '-', $remove_words = true, $words_array = array())
{
	if (is_null($input)) return "";
	if (empty(trim($input))) return $input;
	if (preg_match("/\p{Han}+/u", $input)) return $input;
	//make it lowercase, remove punctuation, remove multiple/leading/ending spaces
	$input = removeAccents($input);
	$return = trim(preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($input)));

	//remove words, if not helpful to seo
	//i like my defaults list in remove_words(), so I wont pass that array
	if ($remove_words) {
		$return = remove_words($return, $replace, $words_array);
	}

	//convert the spaces to whatever the user wants
	//usually a dash or underscore..
	//...then return the value.
	return str_replace(' ', $replace, $return);
}

/* takes an input, scrubs unnecessary words */
function remove_words($input, $replace, $words_array = array(), $unique_words = true)
{
	//separate all words based on spaces
	$input_array = explode(' ', $input);

	//create the return array
	$return = array();

	//loops through words, remove bad words, keep good ones
	foreach ($input_array as $word) {
		//if it's a word we should add...
		if (!in_array($word, $words_array) && ($unique_words ? !in_array($word, $return) : true)) {
			$return[] = $word;
		}
	}

	//return good words separated by dashes
	return implode($replace, $return);
}
function removeAccents($s)
{
	$replace = array(
		'À' => 'A',
		'Á' => 'A',
		'Â' => 'A',
		'Ã' => 'A',
		'Ä' => 'Ae',
		'Å' => 'A',
		'Æ' => 'A',
		'Ă' => 'A',
		'à' => 'a',
		'á' => 'a',
		'â' => 'a',
		'ã' => 'a',
		'ä' => 'ae',
		'å' => 'a',
		'ă' => 'a',
		'æ' => 'ae',
		'þ' => 'b',
		'Þ' => 'B',
		'Ç' => 'C',
		'ç' => 'c',
		'È' => 'E',
		'É' => 'E',
		'Ê' => 'E',
		'Ë' => 'E',
		'è' => 'e',
		'é' => 'e',
		'ê' => 'e',
		'ë' => 'e',
		'Ğ' => 'G',
		'ğ' => 'g',
		'Ì' => 'I',
		'Í' => 'I',
		'Î' => 'I',
		'Ï' => 'I',
		'İ' => 'I',
		'ı' => 'i',
		'ì' => 'i',
		'í' => 'i',
		'î' => 'i',
		'ï' => 'i',
		'Ñ' => 'N',
		'Ò' => 'O',
		'Ó' => 'O',
		'Ô' => 'O',
		'Õ' => 'O',
		'Ö' => 'Oe',
		'Ø' => 'O',
		'ö' => 'oe',
		'ø' => 'o',
		'ð' => 'o',
		'ñ' => 'n',
		'ò' => 'o',
		'ó' => 'o',
		'ô' => 'o',
		'õ' => 'o',
		'Š' => 'S',
		'š' => 's',
		'Ş' => 'S',
		'ș' => 's',
		'Ș' => 'S',
		'ş' => 's',
		'ß' => 'ss',
		'ț' => 't',
		'Ț' => 'T',
		'Ù' => 'U',
		'Ú' => 'U',
		'Û' => 'U',
		'Ü' => 'Ue',
		'ù' => 'u',
		'ú' => 'u',
		'û' => 'u',
		'ü' => 'ue',
		'Ý' => 'Y',
		'ý' => 'y',
		'ý' => 'y',
		'ÿ' => 'y',
		'Ž' => 'Z',
		'ž' => 'z'
	);
	return strtr($s, $replace);
}
