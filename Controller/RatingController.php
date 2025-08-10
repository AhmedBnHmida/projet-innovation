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

    public function listIdeasByTheme($themeId) {
        $this->checkEvaluator();

        $stmt = $this->pdo->prepare("SELECT * FROM ideas WHERE theme_id = ?");
        $stmt->execute([$themeId]);
        $ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            SELECT i.title, t.title AS theme_title, AVG(r.rating) AS avg_rating
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
}
