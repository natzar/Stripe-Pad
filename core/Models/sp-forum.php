<?php
/* Made by AI */

class Forum extends ModelBase {
    public function getMessages($parentId = 0) {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE parent_id = :parent_id");
        $stmt->execute(['parent_id' => $parentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMessage($parentId, $title, $content, $userId) {
        $stmt = $this->db->prepare("INSERT INTO messages (parent_id, title, content, user_id, created_at) VALUES (:parent_id, :title, :content, :user_id, NOW())");
        return $stmt->execute([
            'parent_id' => $parentId,
            'title' => $title,
            'content' => $content,
            'user_id' => $userId
        ]);
    }

    public function updateMessage($messageId, $title, $content) {
        $stmt = $this->db->prepare("UPDATE messages SET title = :title, content = :content, updated_at = NOW() WHERE messagesId = :messageId");
        return $stmt->execute([
            'title' => $title,
            'content' => $content,
            'messageId' => $messageId
        ]);
    }

    public function deleteMessage($messageId) {
        $stmt = $this->db->prepare("DELETE FROM messages WHERE messagesId = :messageId");
        return $stmt->execute(['messageId' => $messageId]);
    }
}