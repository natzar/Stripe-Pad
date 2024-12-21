<?

/**
 *     Blog 
 */
class blogModel extends ModelBase
{

    var $params = "";

    public function __construct() {}

    function run()
    {
        $q = $this->db->prepare("SELECT *,DATE_FORMAT(created, '%d-%m-%Y') as created from blog where slug = :slug limit 1");
        if (!empty($this->params['a'])):

            $slug = $this->params['a'];
            // $blog = new blogModel();

            $q->bindParam(":slug", $slug);
            $q->execute();
            $data = $q->fetch();

            $data['SEO_TITLE'] = $data['title'] . " - Domstry";
            $data['SEO_DESCRIPTION'] = truncate(strip_tags($data['body']));
            $this->view->show('views/blog-post.php', $data, false);
        else:

            $slug = $this->params['a'];

            // $q = $blog->db->prepare("SELECT *,DATE_FORMAT(created, '%d-%m-%Y') as created from blog order by created DESC ");
            $q->execute();
            $data = array("items" => $q->fetchAll());

            $data['SEO_TITLE'] = "Resources - Domstry";
            $this->view->show('views/resources.php', $data);
        endif;
    }

    public function generateBlogPosts()
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
