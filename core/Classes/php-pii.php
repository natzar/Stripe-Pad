<?

class phpPii
{
    var $original;
    var $anonimized;
    function anonimize($text)
    {
        $patterns = [
            'email'     => '/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}/i',
            'phone'     => '/\+?\d{1,4}[\s.-]?\(?\d{1,4}\)?[\s.-]?\d{3,4}[\s.-]?\d{3,4}/',
            'ip'        => '/\b\d{1,3}(?:\.\d{1,3}){3}\b/',
            'dni'       => '/\b\d{8}[A-HJ-NP-TV-Z]\b/i',
            'iban'      => '/\bES\d{2}\s?\d{4}\s?\d{4}\s?\d{2}\s?\d{10}\b/i',
            'name'      => '/\b([A-ZÁÉÍÓÚÑ][a-záéíóúñ]{2,})(\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]{2,})?\b/u',
            'address'   => '/\b(Calle|Avda\.?|Avenida|C\/|Paseo|Plaza|Pg\.?|Ronda|Carretera|Travesía)\s+[A-ZÁÉÍÓÚÑa-záéíóúñ\s]+(?:,\s?\d+\w?)?\b/u',
        ];

        $replacements = [];
        $counter = 0;

        foreach ($patterns as $type => $regex) {
            $text = preg_replace_callback($regex, function ($matches) use (&$replacements, &$counter, $type) {
                $replacements[] = [
                    'type' => $type,
                    'value' => $matches[0]
                ];
                return "<<<PII:$counter>>>";
            }, $text);
        }

        return [
            'text' => $text,
            'replacements' => $replacements
        ];
    }

    function unanonimize($text, $replacements)
    {
        foreach ($replacements as $index => $info) {
            $text = str_replace("<<<PII:$index>>>", $info['value'], $text);
        }
        return $text;
    }
}
