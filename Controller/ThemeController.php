<?php
require_once __DIR__ . '/../Model/Theme.php';
require_once __DIR__ . '/../config/config.php';

class ThemeController {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getConnexion();
    }

    // Check if the current user is admin
    private function checkAdmin() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }
    }

    // List all themes
    public function list() {
        $this->checkAdmin();

        $stmt = $this->pdo->query("SELECT id, title, description FROM themes");
        $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../View/BackOffice/admin_themes.php';
    }

    // Show form to create a new theme
    public function createForm() {
        $this->checkAdmin();

        include __DIR__ . '/../View/BackOffice/admin_theme_form.php';
    }

    // Handle create theme POST form submission
    public function create() {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']) ?: null;

            if (empty($title)) {
                $error = "Le titre est obligatoire.";
                include __DIR__ . '/../View/BackOffice/admin_theme_form.php';
                return;
            }

            $stmt = $this->pdo->prepare("INSERT INTO themes (title, description) VALUES (?, ?)");
            $success = $stmt->execute([$title, $description]);

            if ($success) {
                header('Location: index.php?page=admin_themes');
                exit;
            } else {
                $error = "Erreur lors de la création du thème.";
                include __DIR__ . '/../View/BackOffice/admin_theme_form.php';
            }
        }
    }

    // Show form to edit an existing theme
    public function editForm(int $id) {
        $this->checkAdmin();

        $theme = $this->getThemeById($id);
        if (!$theme) {
            header('Location: index.php?page=admin_themes');
            exit;
        }

        include __DIR__ . '/../View/BackOffice/admin_theme_form.php';
    }

    // Handle update theme POST form submission
    public function update(int $id) {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']) ?: null;

            if (empty($title)) {
                $error = "Le titre est obligatoire.";
                $theme = $this->getThemeById($id);
                include __DIR__ . '/../View/BackOffice/admin_theme_form.php';
                return;
            }

            $stmt = $this->pdo->prepare("UPDATE themes SET title = ?, description = ? WHERE id = ?");
            $success = $stmt->execute([$title, $description, $id]);

            if ($success) {
                header('Location: index.php?page=admin_themes');
                exit;
            } else {
                $error = "Erreur lors de la mise à jour du thème.";
                $theme = $this->getThemeById($id);
                include __DIR__ . '/../View/BackOffice/admin_theme_form.php';
            }
        }
    }

    // Delete a theme by id
    public function delete(int $id) {
        $this->checkAdmin();

        $stmt = $this->pdo->prepare("DELETE FROM themes WHERE id = ?");
        $stmt->execute([$id]);

        header('Location: index.php?page=admin_themes');
        exit;
    }

    // Helper: get a Theme by ID
    private function getThemeById(int $id): ?Theme {
        $stmt = $this->pdo->prepare("SELECT * FROM themes WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $theme = new Theme($data['title'], $data['description']);
        $theme->setId($data['id']);

        return $theme;
    }
}
