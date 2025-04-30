<?php

class Users_Model extends Model {

    public function isEmailTaken(string $email) : bool {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        return $stmt->fetchColumn() > 0;
    }

    public function isUsernameTaken(string $username) : bool {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
        $stmt->execute([':username' => $username]);

        return $stmt->fetchColumn() > 0;
    }

    public function register(string $email, string $username, string $password, string $firstName, string $lastName) : bool {
        $sql = 'INSERT INTO users (
             email,  username,  password,  first_name,  last_name
        ) VALUES (
            :email, :username, :password, :first_name, :last_name
        )';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':email'      => $email,
            ':username'   => $username,
            ':password'   => $password,
            ':first_name' => $firstName,
            ':last_name'  => $lastName
        ]);
    }

    public function getUserHash(string $email) {
        $stmt = $this->db->prepare('SELECT password FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        $passwordHash = $stmt->fetchColumn();

        return $passwordHash !== false ? $passwordHash : null;
    }

    public function getUserInfo(string $email) {
        $stmt = $this->db->prepare('SELECT id, username, first_name, last_name FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user !== false ? $user : null;
    }

}
