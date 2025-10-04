<?php
// en tu plantilla común de <head>
$path = $_SERVER['REQUEST_URI'];



get_user_language();
write_href_lang_tags();
set_current_language();

// dominios
$domains = [
    'es'        => 'https://agentedesoporte.es',
    'en'        => 'https://meetStripe Pad.com',
    'x-default' => 'https://meetStripe Pad.com',
];

// foreach ($domains as $lang => $domain) {
//     printf(
//         '<link rel="alternate" hreflang="%s" href="%s%s" />' . "\n",
//         htmlspecialchars($lang, ENT_QUOTES, 'UTF-8'),
//         htmlspecialchars($domain, ENT_QUOTES, 'UTF-8'),
//         htmlspecialchars($path, ENT_QUOTES, 'UTF-8')
//     );
// }
