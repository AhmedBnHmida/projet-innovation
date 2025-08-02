<?php
require_once __DIR__ . '/../config/config.php';


class User {


    public static function login($email, $password) {
        $pdo = Config::getConnexion();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Return only relevant fields, avoid returning password hash
            return [
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
        }
        return false;
    }


    public static function register($email, $password, $role = 'salarié') {
    $pdo = Config::getConnexion();

    // Check if email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return false; // email taken
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    return $stmt->execute([$email, $hashedPassword, $role]);
    }

}
