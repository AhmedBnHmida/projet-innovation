<?php
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../config/config.php';

class UserController {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getConnexion();
    }

    // Protect all admin routes with this check
    private function checkAdmin() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }
    }

    public function list() {
        $this->checkAdmin();

        $stmt = $this->pdo->query("SELECT id, name, email, role FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../View/BackOffice/admin_users.php';
    }

    public function createForm() {
        $this->checkAdmin();
        include __DIR__ . '/../View/BackOffice/admin_user_form.php';
    }

    public function create() {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars(trim($_POST['name']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $role = $_POST['role'] ?? '';

            if ($password !== $confirm_password) {
                $error = "Les mots de passe ne correspondent pas.";
                include __DIR__ . '/../View/BackOffice/admin_user_form.php';
                return;
            }

            $success = User::register($name, $email, $password, $role);

            if ($success) {
                header('Location: index.php?page=admin_users');
                exit;
            } else {
                $error = "L'email est déjà utilisé.";
                include __DIR__ . '/../View/BackOffice/admin_user_form.php';
            }
        }
    }

    public function editForm(int $id) {
        $this->checkAdmin();

        $user = $this->getUserById($id);
        if (!$user) {
            header('Location: index.php?page=admin_users');
            exit;
        }

        include __DIR__ . '/../View/BackOffice/admin_user_form.php';
    }

    public function update(int $id) {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars(trim($_POST['name']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $role = $_POST['role'] ?? '';

            if (!empty($password) && $password !== $confirm_password) {
                $error = "Les mots de passe ne correspondent pas.";
                $user = $this->getUserById($id);
                include __DIR__ . '/../View/BackOffice/admin_user_form.php';
                return;
            }

            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ?, password = ?, role = ? WHERE id = ?");
                $success = $stmt->execute([$name, $email, $hashedPassword, $role, $id]);
            } else {
                $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
                $success = $stmt->execute([$name, $email, $role, $id]);
            }

            if ($success) {
                header('Location: index.php?page=admin_users');
                exit;
            } else {
                $error = "Erreur lors de la mise à jour.";
                $user = $this->getUserById($id);
                include __DIR__ . '/../View/BackOffice/admin_user_form.php';
            }
        }
    }

    public function delete(int $id) {
        $this->checkAdmin();

        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        header('Location: index.php?page=admin_users');
        exit;
    }


    private function getUserById(int $id): ?User {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$data) return null;

    $roleEnum = UserRole::from($data['role']);  // convert string to enum

    $user = new User($data['name'], $data['email'], $data['password'], $roleEnum);
    $user->setId($data['id']);
    return $user;
}

}
