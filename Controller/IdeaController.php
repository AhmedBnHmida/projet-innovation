<?php
require_once __DIR__ . '/../Model/Idea.php';
require_once __DIR__ . '/../config/config.php';

class IdeaController {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getConnexion();
    }

    private function checkEmployee() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
            header('Location: index.php?page=login');
            exit;
        }
    }


    // List ideas submitted by logged-in employee
    public function listMyIdeas() {
        $this->checkEmployee();

        $user_id = $_SESSION['user']['id'];

        $stmt = $this->pdo->prepare("
            SELECT ideas.*, themes.title AS theme_title 
            FROM ideas 
            JOIN themes ON ideas.theme_id = themes.id
            WHERE ideas.user_id = ?
            ORDER BY ideas.created_at DESC
        ");
        $stmt->execute([$user_id]);
        $ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../View/FrontOffice/employee_my_ideas.php';
    }

    // View detail of a single idea
    public function viewIdea(int $ideaId) {
        $this->checkEmployee();

        $user_id = $_SESSION['user']['id'];

        $stmt = $this->pdo->prepare("
            SELECT ideas.*, themes.title AS theme_title
            FROM ideas
            JOIN themes ON ideas.theme_id = themes.id
            WHERE ideas.id = ? AND ideas.user_id = ?
        ");
        $stmt->execute([$ideaId, $user_id]);
        $idea = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$idea) {
            // Idea not found or not owned by user
            header('Location: index.php?page=my_ideas');
            exit;
        }

        include __DIR__ . '/../View/FrontOffice/employee_idea_detail.php';
    }

    // Show edit form for an idea
    public function editIdeaForm(int $ideaId) {
        $this->checkEmployee();

        $user_id = $_SESSION['user']['id'];

        // Fetch idea with ownership check
        $stmt = $this->pdo->prepare("SELECT * FROM ideas WHERE id = ? AND user_id = ?");
        $stmt->execute([$ideaId, $user_id]);
        $idea = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$idea) {
            // Idea not found or no permission
            header('Location: index.php?page=my_ideas');
            exit;
        }

        // Fetch theme details for the idea's theme_id
        $stmtTheme = $this->pdo->prepare("SELECT title, description FROM themes WHERE id = ?");
        $stmtTheme->execute([$idea['theme_id']]);
        $theme = $stmtTheme->fetch(PDO::FETCH_ASSOC);

        if (!$theme) {
            $theme = ['title' => 'Thématique inconnue', 'description' => ''];
        }

        // Include the edit form view, passing $idea and $theme
        include __DIR__ . '/../View/FrontOffice/employee_edit_idea.php';
    }

    // Handle POST update for idea
    public function updateIdea(int $ideaId) {
        $this->checkEmployee();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user']['id'];

            // Verify ownership
            $stmt = $this->pdo->prepare("SELECT * FROM ideas WHERE id = ? AND user_id = ?");
            $stmt->execute([$ideaId, $user_id]);
            $idea = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$idea) {
                header('Location: index.php?page=my_ideas');
                exit;
            }

            $title = trim($_POST['title']);
            $description = trim($_POST['description']);

            if (empty($title)) {
                $error = "Le titre est obligatoire.";
                // Fetch theme for re-displaying in form
                $stmtTheme = $this->pdo->prepare("SELECT title, description FROM themes WHERE id = ?");
                $stmtTheme->execute([$idea['theme_id']]);
                $theme = $stmtTheme->fetch(PDO::FETCH_ASSOC);

                include __DIR__ . '/../View/FrontOffice/employee_edit_idea.php';
                return;
            }

            $stmt = $this->pdo->prepare("UPDATE ideas SET title = ?, description = ? WHERE id = ? AND user_id = ?");
            $success = $stmt->execute([$title, $description, $ideaId, $user_id]);

            if ($success) {
                header('Location: index.php?page=my_ideas');
                exit;
            } else {
                $error = "Erreur lors de la mise à jour de l'idée.";
                $stmtTheme = $this->pdo->prepare("SELECT title, description FROM themes WHERE id = ?");
                $stmtTheme->execute([$idea['theme_id']]);
                $theme = $stmtTheme->fetch(PDO::FETCH_ASSOC);
                include __DIR__ . '/../View/FrontOffice/employee_edit_idea.php';
            }
        }
    }


    // Delete an idea
    public function deleteIdea(int $ideaId) {
        $this->checkEmployee();

        $user_id = $_SESSION['user']['id'];

        // Verify ownership
        $stmt = $this->pdo->prepare("SELECT * FROM ideas WHERE id = ? AND user_id = ?");
        $stmt->execute([$ideaId, $user_id]);
        $idea = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$idea) {
            // Not found or no permission
            header('Location: index.php?page=my_ideas');
            exit;
        }

        $stmt = $this->pdo->prepare("DELETE FROM ideas WHERE id = ? AND user_id = ?");
        $stmt->execute([$ideaId, $user_id]);

        header('Location: index.php?page=my_ideas');
        exit;
    }
}
