<?
// NewsletterModel.php

class newsletterModel extends ModelBase
{
    public function addSubscriber($email)
    {
        $sql = "INSERT INTO subscribers (email) VALUES (?)";
        $this->db->prepare($sql)->execute([$email]);

        return true;
    }
}
