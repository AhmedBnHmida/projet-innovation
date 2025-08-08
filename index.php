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

    // Admin routes - user management:
    case 'admin_users':
        require_once 'Controller/UserController.php';
        $userController = new UserController();
        $userController->list();
        break;

    case 'admin_user_create':
        require_once 'Controller/UserController.php';
        $userController = new UserController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->create();
        } else {
            $userController->createForm();
        }
        break;

    case 'admin_user_edit':
        require_once 'Controller/UserController.php';
        $userController = new UserController();
        $id = intval($_GET['id'] ?? 0);
        $userController->editForm($id);
        break;

    case 'admin_user_update':
        require_once 'Controller/UserController.php';
        $userController = new UserController();
        $id = intval($_GET['id'] ?? 0);
        $userController->update($id);
        break;

    case 'admin_user_delete':
        require_once 'Controller/UserController.php';
        $userController = new UserController();
        $id = intval($_GET['id'] ?? 0);
        $userController->delete($id);
        break;

    // Admin routes - Themes management :
    case 'admin_themes':
    require_once 'Controller/ThemeController.php';
    $themeController = new ThemeController();
    $themeController->list();
    break;

    case 'admin_theme_create':
        require_once 'Controller/ThemeController.php';
        $themeController = new ThemeController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $themeController->create();
        } else {
            $themeController->createForm();
        }
        break;

    case 'admin_theme_edit':
        require_once 'Controller/ThemeController.php';
        $themeController = new ThemeController();
        $id = intval($_GET['id'] ?? 0);
        $themeController->editForm($id);
        break;

    case 'admin_theme_update':
        require_once 'Controller/ThemeController.php';
        $themeController = new ThemeController();
        $id = intval($_GET['id'] ?? 0);
        $themeController->update($id);
        break;

    case 'admin_theme_delete':
        require_once 'Controller/ThemeController.php';
        $themeController = new ThemeController();
        $id = intval($_GET['id'] ?? 0);
        $themeController->delete($id);
        break;


    default:
        echo "404 - Page introuvable";
}
