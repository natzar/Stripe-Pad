<?
class blog extends ModelBase 
{
    var $params = "";

    function x()
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
}
