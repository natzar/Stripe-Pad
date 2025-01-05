<?
// NewsletterModel.php

class newsletterModel extends ModelBase
{
    public function addSubscriber($email)
    {
        $sql = "INSERT INTO subscribers (email) VALUES (?)";
        $this->db->prepare($sql)->execute([$email]);
    }

    public function install()
    {
        // CREATE TABLE subscribers (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     email VARCHAR(255) UNIQUE NOT NULL
        // );

    }
}
