<?php

include dirname(__FILE__) . "/../core/sp-load.php";
class FeedbackWebhook
{
    public function __construct()
    {

        $params = get_parameters();
        assert($params['hash']);
        $feedbacks = new feedbackModel();

        if ($feedbacks->save($params['hash'],  $params['points'], $params['comment'], $params['context'], $params['usersId'])) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false));
        }
    }
}

$w = new FeedbackWebhook();
