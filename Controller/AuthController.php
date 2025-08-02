<?php
require_once __DIR__ . '/../Model/User.php';


class AuthController {
    public function login() {
        session_start(); // Start session before using $_SESSION

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = User::login($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php?page=dashboard');
                exit;
            } else {
                $error = "Identifiants incorrects.";
                include __DIR__ . '/../View/FrontOffice/login.php';
            }
        } else {
            include __DIR__ . '/../View/FrontOffice/login.php';
        }
    }

    public function register() {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $role = $_POST['role'] ?? 'salarié'; // Default role if you want admin to assign role

        if ($password !== $confirm_password) {
            $error = "Les mots de passe ne correspondent pas.";
            include '../View/FrontOffice/register.php';
            return;
        }

        $success = User::register($email, $password, $role);

        if ($success) {
            header('Location: index.php?page=login');
            exit;
        } else {
            $error = "Cet email est déjà utilisé.";
            include '../View/FrontOffice/register.php';
        }
    } else {
        include '../View/FrontOffice/register.php';
    }
    }


    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
