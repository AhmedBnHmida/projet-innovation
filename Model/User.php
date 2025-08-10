<?php
require_once __DIR__ . '/../config/config.php';

enum UserRole: string {
    case ADMIN = 'admin';
    case EMPLOYEE = 'employee';
    case EVALUATOR = 'evaluator';
    case USER = 'user';
}

class User {

    private ?int $id = null;
    private string $name;
    private string $email;
    private string $password; // hashed
    private UserRole $role;

    public function __construct(string $name, string $email, string $password, UserRole $role = UserRole::EMPLOYEE) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;    
        $this->role = $role;
    }

    // getters / setters...
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getName(): string { return $this->name; }
    public function setName(string $n): void { $this->name = $n; }
    public function getEmail(): string { return $this->email; }
    public function setEmail(string $e): void { $this->email = $e; }
    public function getPassword(): string { return $this->password; }
    public function setPassword(string $p): void { $this->password = $p; }
    public function getRole(): UserRole { return $this->role; }
    public function setRole(UserRole $r): void { $this->role = $r; }


    public static function login($email, $password) {
        $pdo = Config::getConnexion();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Return only relevant fields, avoid returning password hash
            return [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
        }
        return false;
    }


    public static function register($name, $email, $password, $role = 'user') {
    $pdo = Config::getConnexion();

    // Check if email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return false; // email taken
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $email, $hashedPassword, $role]);
    }

}
