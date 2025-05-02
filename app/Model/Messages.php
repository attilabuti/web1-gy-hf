<?php

class Messages_Model extends Model {

    public function add(int $userId, string $subject, string $message) : bool {
        $sql = 'INSERT INTO messages (user_id, subject,  message) VALUES (:user_id, :subject, :message)';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':subject' => $subject,
            ':message' => $message,
        ]);
    }

    public function getMessages() {
        $stmt = $this->db->prepare('SELECT * FROM messages ORDER BY created_at DESC');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
