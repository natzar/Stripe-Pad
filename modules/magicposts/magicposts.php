<?
/*
        Stripe Pad - Magic Posts




*/
class Openai{

    private function secret_key(){
        return $secret_key = OPENAI_CHATGPT_APIKEY;
    }

    public function request( $prompt, $max_tokens=1024){ 
$request_body = [
    "model" => "gpt-3.5-turbo",
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
//echo $response;
        curl_close($curl);

        if ($err) {
            echo "Error #:" . $err;
        } else {
            return $response;
        }

    }



}


// $blogTitles = [
//     "Domain Data Mining Strategy: The Definitive Guide (2024)",
//     "28 Actionable Insights from Domain Data to Boost Online Visibility",    
//     "6 Ways Domstry.com Transforms Your Digital Marketing Strategy",
//     "Top 3 Tools for Domain Data Analysis in 2024",    
//     "6 Strategies to Gain a Competitive Edge with Domain Data in a Downturn",
    
//     "Advanced Guide to Email Marketing Using Domain Data",
//     "Checklist: 8 Things to Consider When Mining for Domain Data",
//     "New Domstry.com 2.0 Experience: Enhanced Data, Better Insights",    
//     "How to Utilize Domain Data for Market Research: Complete Guide",    
//     "Building an Effective Domain Data Mining Website",
//     "10 Reasons Why Domain Data is Crucial for Digital Presence",    
//     "3 Key Strategies to Keep Your Data Mining Effective and Engaging",
//     "Alternative to builtwith",    
//     "Best Practices for Marketing with Domain Data: Top 3 Strategies",
//     "10 Essential Tools for Effective Domain Data Mining",
//     "Choosing the Right Domain Data Mining Software for Your Needs",    
//     "Step-by-Step Guide to Utilizing Domain Data for SEO",
//     "New Data Integration Features with Popular Web Services",
//     "10 Reasons to Have a Dedicated Domain Data Analysis Tool",
    
    
// ];

$blogTitles = [
    "Identifying Expiring Domains for Investment Opportunities",
    "Enhancing Digital Marketing Campaigns with Domain Data Insights",
    "Utilizing Domain Data for Competitive Market Analysis",
    "Improving SEO Strategies with Advanced Domain Analytics",
    "Leveraging Domain Information for Targeted Email Marketing",
    "Conducting Comprehensive Web Host and Network Research",
    "Using Domain Data to Track and Analyze Tech Trends",
    "Developing Tailored Content Strategies Based on Domain Analysis",
    "Optimizing Domain Portfolio Management for Domainers",
    "Assisting Legal Teams in Intellectual Property Cases",
    "Supporting Cybersecurity Efforts with Domain Data",
    "Enhancing Academic Research on Internet Trends and Usage",
    "Providing Data-Driven Insights for Domain Appraisal Services",
    "Supporting Government Agencies in Digital Infrastructure Analysis",
    "Enabling Data Journalists to Analyze Web Presence of Organizations",    
    
];



include "../load.php";

$selects = array("country", "hosting", "lang");

$n = new leadsModel();
$o = new Openai();

foreach($blogTitles as $title){
    
    $r = $o->request($title);
    $r = json_decode($r,true);

    $body = $r['choices'][0]['message']['content'];
    $slug = generate_seo_link($title);
    $q = $n->db->prepare("INSERT INTO blog (title,slug,body) VALUES (:t,:s,:b)");
    $q->bindParam(":t", $title );
    $q->bindParam(":b", $body  );
    $q->bindParam(":s",$slug  );
    $q->execute();

    echo $title.PHP_EOL;
    echo "= ========".PHP_EOL;
    echo $body;

    echo PHP_EOL.PHP_EOL;
}

# foreach
    # generate post
        # save to bd


    # template + post content
    # save to file