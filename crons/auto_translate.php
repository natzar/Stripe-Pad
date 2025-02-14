<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

const LANGUAGES = ['es', 'fr', 'de', 'it', 'nl', 'pt', 'ru', 'pl', 'sv', 'fi', 'da', 'no', 'el', 'cs', 'hu', 'ro', 'bg', 'hr', 'sk', 'lt', 'lv', 'et'];
const API_KEY = 'TU_API_KEY'; // Reemplaza con tu clave de OpenAI o DeepL

function translateText($text, $targetLang) {
    $client = new Client();
    $response = $client->post('https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . API_KEY,
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => "Translate the following text to $targetLang:"],
                ['role' => 'user', 'content' => $text],
            ],
        ],
    ]);

    $body = json_decode($response->getBody(), true);
    return trim($body['choices'][0]['message']['content']);
}

foreach (LANGUAGES as $lang) {
    $poFile = "locale/$lang/LC_MESSAGES/messages.po";
    if (!file_exists($poFile)) continue;
    
    $po = new Sepia\PoParser\Parser();
    $entries = $po->parseFile($poFile);
    $translations = [];
    
    foreach ($entries as $entry) {
        if (empty($entry['msgstr'])) {
            $translation = translateText($entry['msgid'], $lang);
            $entry['msgstr'][] = $translation;
        }
        $translations[] = $entry;
    }
    
    $poWriter = new Sepia\PoParser\PoCompiler();
    file_put_contents($poFile, $poWriter->compile($translations));
    echo "✅ $lang traducido correctamente.\n";
}

echo "Traducción finalizada.";
