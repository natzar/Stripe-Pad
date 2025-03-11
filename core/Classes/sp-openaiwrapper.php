<?php

class Openai{

    private function secret_key(){
        return $secret_key = OPENAI_CHATGPT_APIKEY;
    }

    public function request( $prompt, $model="gpt-3.5-turbo", $max_tokens=1024){ 
        
        $request_body = [
            "model" => $model,
            "messages" => [
                ["role" => "system", "content" => "You are the CMO of ".APP_NAME.". Write articles for the blog. Return the html that goes between body tag, dont include it. Return HTML only, no introductions or explanations.

                "],
                ["role" => "user", "content" => $prompt],
            ],
            "max_tokens" => $max_tokens,
            "temperature" => 0.6, // Adjust the temperature as needed
            "stream" => false, // Use streaming for better performance
        ];

        $postfields = json_encode($request_body);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 100,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: ' . $this->secret_key()
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "Error #:" . $err;
        } else {
            return $response;
        }

    }
}
