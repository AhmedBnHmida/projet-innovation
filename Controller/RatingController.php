<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Model/Rating.php';

class RatingController {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getConnexion();
    }

    // Check if the current user is evaluator
    private function checkEvaluator() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'evaluator') {
            header('Location: index.php?page=login');
            exit;
        }
    }

    public function listThemes() {
        $this->checkEvaluator();

        $stmt = $this->pdo->query("SELECT * FROM themes");
        $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../View/FrontOffice/Evaluator_list_themes.php';
    }

    /*
    public function listIdeasByTheme($themeId) {
        $this->checkEvaluator();

        $stmt = $this->pdo->prepare("SELECT * FROM ideas WHERE theme_id = ?");
        $stmt->execute([$themeId]);
        $ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../View/FrontOffice/Evaluator_list_ideas.php';
    }
    */
    
    public function listIdeasByTheme($themeId) {
        $this->checkEvaluator();

        // Fetch the theme info
        $stmtTheme = $this->pdo->prepare("SELECT * FROM themes WHERE id = ?");
        $stmtTheme->execute([$themeId]);
        $theme = $stmtTheme->fetch(PDO::FETCH_ASSOC);

        if (!$theme) {
            // Theme not found, redirect or show message
            header('Location: index.php?page=rate_ideas');
            exit;
        }

        // Fetch ideas under that theme
        $stmtIdeas = $this->pdo->prepare("SELECT * FROM ideas WHERE theme_id = ?");
        $stmtIdeas->execute([$themeId]);
        $ideas = $stmtIdeas->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../View/FrontOffice/Evaluator_list_ideas.php';
    }

    public function rateIdea($ideaId) {
        $this->checkEvaluator();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ratingValue = intval($_POST['rating']);
            $themeId     = intval($_POST['theme_id']);
            $evaluatorId = $_SESSION['user']['id'];

            $stmt = $this->pdo->prepare("
                INSERT INTO ratings (evaluator_id, idea_id, rating)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE rating = VALUES(rating)
            ");
            $stmt->execute([$evaluatorId, $ideaId, $ratingValue]);

            header("Location: index.php?page=rate_ideas_theme&id=" . $themeId);
            exit;
        }
    }

    public function topIdeas() {
        $this->checkEvaluator();

        $stmt = $this->pdo->query("
            SELECT i.id, i.title, t.title AS theme_title, i.description, i.created_at, AVG(r.rating) AS avg_rating
            FROM ideas i
            JOIN themes t ON i.theme_id = t.id
            JOIN ratings r ON i.id = r.idea_id
            GROUP BY i.id
            ORDER BY avg_rating DESC
            LIMIT 10
        ");
        $ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../View/FrontOffice/Evaluator_top_ideas.php';
    }


    public function viewIdeaDetail($ideaId) {
        $this->checkEvaluator();

        // Fetch idea with theme info and average rating
        $stmt = $this->pdo->prepare("
            SELECT i.*, t.title AS theme_title, AVG(r.rating) AS avg_rating
            FROM ideas i
            JOIN themes t ON i.theme_id = t.id
            LEFT JOIN ratings r ON i.id = r.idea_id
            WHERE i.id = ?
            GROUP BY i.id
        ");
        $stmt->execute([$ideaId]);
        $idea = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$idea) {
            header('Location: index.php?page=top_ideas');
            exit;
        }

        // Fetch evaluator's rating if exists
        $evaluatorId = $_SESSION['user']['id'];
        $stmt = $this->pdo->prepare("
            SELECT rating FROM ratings WHERE idea_id = ? AND evaluator_id = ?
        ");
        $stmt->execute([$ideaId, $evaluatorId]);
        $myRating = $stmt->fetch(PDO::FETCH_ASSOC);

        include __DIR__ . '/../View/FrontOffice/Evaluator_idea_detail.php';
    }


    public function listMyRatings() {
        $this->checkEvaluator();

        $evaluatorId = $_SESSION['user']['id'];

        $stmt = $this->pdo->prepare("
            SELECT i.id AS idea_id, i.title AS idea_title, t.title AS theme_title, r.rating, r.created_at
            FROM ratings r
            JOIN ideas i ON r.idea_id = i.id
            JOIN themes t ON i.theme_id = t.id
            WHERE r.evaluator_id = ?
            ORDER BY r.created_at DESC
        ");
        $stmt->execute([$evaluatorId]);
        $myRatings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../View/FrontOffice/evaluator_my_ratings.php';
    }


    // Show edit form for a rating
    public function editRatingForm($ideaId) {
        $this->checkEvaluator();

        $evaluatorId = $_SESSION['user']['id'];

        $stmt = $this->pdo->prepare("
            SELECT r.rating, i.title AS idea_title
            FROM ratings r
            JOIN ideas i ON r.idea_id = i.id
            WHERE r.evaluator_id = ? AND r.idea_id = ?
        ");
        $stmt->execute([$evaluatorId, $ideaId]);
        $rating = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$rating) {
            header('Location: index.php?page=my_ratings');
            exit;
        }

        include __DIR__ . '/../View/FrontOffice/evaluator_edit_rating.php';
    }

    // Handle POST update of a rating
    public function updateRating($ideaId) {
        $this->checkEvaluator();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evaluatorId = $_SESSION['user']['id'];
            $newRating = intval($_POST['rating']);

            $stmt = $this->pdo->prepare("
                UPDATE ratings SET rating = ? WHERE evaluator_id = ? AND idea_id = ?
            ");
            $stmt->execute([$newRating, $evaluatorId, $ideaId]);

            header('Location: index.php?page=my_ratings');
            exit;
        }
    }

    // Delete a rating
    public function deleteRating($ideaId) {
        $this->checkEvaluator();

        $evaluatorId = $_SESSION['user']['id'];

        $stmt = $this->pdo->prepare("
            DELETE FROM ratings WHERE evaluator_id = ? AND idea_id = ?
        ");
        $stmt->execute([$evaluatorId, $ideaId]);

        header('Location: index.php?page=my_ratings');
        exit;
    }

}
