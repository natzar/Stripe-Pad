<?php

class RatingModel extends ModelBase {
    public function addRating($userId, $itemId, $rating, $comment = null) {
        $stmt = $this->db->prepare("INSERT INTO ratings (user_id, item_id, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $itemId, $rating, $comment]);
    }

    public function getItemRatings($itemId) {
        $stmt = $this->db->prepare("SELECT * FROM ratings WHERE item_id = ?");
        $stmt->execute([$itemId]);
        return $stmt->fetchAll();
    }
}
