<?php
session_start();

$page = $_GET['page'] ?? 'login';

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'admin';
}

function isSalarie() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'salarié';
}

function isEvaluateur() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'évaluateur';
}

switch ($page) {
    case 'register':
        require_once '../Controller/AuthController.php';
        $auth = new AuthController();
        $auth->register();
        break;
    case 'login':
        require_once '../Controller/AuthController.php';
        $auth = new AuthController();
        $auth->login();
        break;

    case 'logout':
        require_once '../Controller/AuthController.php';
        $auth = new AuthController();
        $auth->logout();
        break;

    case 'dashboard':
        if (!isLoggedIn()) {
            header('Location: index.php?page=login');
            exit;
        }
        include '../View/FrontOffice/dashboard.php';
        break;

    default:
        echo "404 - Page introuvable";
}
