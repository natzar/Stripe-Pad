<?

/**
 *     Blog 
 */
class blogModel extends ModelBase
{

    public function getBySlug($slug)
    {
        $q = $this->db->prepare("SELECT *,DATE_FORMAT(created, '%d-%m-%Y') as created from blog where slug = :slug limit 1");
        $q->bindParam(":slug", $slug);
        $q->execute();
        return $q->fetch();
    }
    public function getAll($limit = 20)
    {
        $q = $this->db->prepare("SELECT *,DATE_FORMAT(created, '%d-%m-%Y') as created from blog limit :limit");
        $q->bindParam(":limit", $limit);
        $q->execute();
        return $q->fetchAll();
    }
    public function AIgenerateBlogPosts()
    {

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

        $selects = array("country", "hosting", "lang");

        $o = new Openai();

        foreach ($blogTitles as $title) {

            $r = $o->request($title);
            $r = json_decode($r, true);

            $body = $r['choices'][0]['message']['content'];
            $slug = friendly_slug($title);
            $q = $n->db->prepare("INSERT INTO blog (title,slug,body) VALUES (:t,:s,:b)");
            $q->bindParam(":t", $title);
            $q->bindParam(":b", $body);
            $q->bindParam(":s", $slug);
            $q->execute();

            echo $title . PHP_EOL;
            echo "= ========" . PHP_EOL;
            echo $body;

            echo PHP_EOL . PHP_EOL;
        }
    }
}
