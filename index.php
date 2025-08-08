<?php


// Simple router to load pages
$page = $_GET['page'] ?? 'landing';


switch ($page) {
    case 'landing':
        include __DIR__ . '/View/FrontOffice/landing.php';
        break;
    case 'login':
        require_once 'Controller/AuthController.php';
        $auth = new AuthController();
        $auth->login();
        break;

    case 'register':
        require_once 'Controller/AuthController.php';
        $auth = new AuthController();
        $auth->register();
        break;

    case 'logout':
        require_once 'Controller/AuthController.php';
        $auth = new AuthController();
        $auth->logout();
        break;

    case 'dashboard':
        include 'View/FrontOffice/dashboard.php';
        break;

    default:
        echo "404 - Page introuvable";
}
