<?


class OpenAI
{

    public static function send($system, $prompt, $engine = 'gpt-3.5-turbo', $temperature = 0.2, $max_tokens = 1024)
    {
        $apiKey = OPENAI_CHATGPT_APIKEY;

        $tools = [
            [
                "type" => "function",
                "function" => [
                    "name" => "sample_function",
                    "description" => "Description of what this function does",
                    "parameters" => [
                        "type" => "object",
                        "properties" => [
                            "data" => [
                                "type" => "object",
                                "description" => "Data field description"
                            ]
                        ],
                        "required" => ["data"]
                    ]
                ]
            ]

        ];



        $data = [
            'model' => $engine, // 'gpt-4o',
            'messages' => [
                ['role' => 'system', 'content' => $system],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => $temperature,
            "max_tokens" => $max_tokens,
            // 'tools' => $tools,
            // 'tool_choice' => 'auto',
        ];

        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $res = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($res, true);

        return [
            'response' => $json['choices'][0]['message']['content'] ?? '',
            'tool_calls' => $json['choices'][0]['message']['tool_calls'] ?? null,
            'tokens' => $json['usage']['total_tokens'] ?? null,
            'finish_reason' => $json['choices'][0]['finish_reason'] ?? null,

        ];
    }
}
