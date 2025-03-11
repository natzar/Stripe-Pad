<?php

require "../core/sp-load.php";

use GuzzleHttp\Client;

function translateText($text, $targetLang)
{
    $client = new Client();
    $response = $client->post('https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . OPENAI_CHATGPT_APIKEY,
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
    $poFile = dirname(__FILE__) . "/../locale/$lang/LC_MESSAGES/messages.po";
    if (!file_exists($poFile)) continue;

    // Initialize FileSystem source handler
    $fileHandler = new Sepia\PoParser\SourceHandler\FileSystem($poFile);

    // Initialize the parser with the source handler
    $poParser = new Sepia\PoParser\Parser($fileHandler);
    $catalog = $poParser->parse();  // Parse the file into a catalog

    foreach ($catalog->getEntries() as $entry) {
        if (empty($entry->getMsgstr())) {  // Check if msgstr is empty
            $translation = translateText($entry->getMsgid(), $lang);
            $entry->setMsgstr($translation);  // Set the translation
        }
    }

    // Initialize PoCompiler and save the catalog back to the file
    $poCompiler = new Sepia\PoParser\PoCompiler();
    $fileHandler->save($poCompiler->compile($catalog));

    echo "✅ $lang traducido correctamente.\n";
}


echo "Traducción finalizada.";
