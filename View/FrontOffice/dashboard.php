<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

$user = $_SESSION['user'];
?>

<h1>Bienvenue <?= htmlspecialchars($user['email']) ?> (Rôle: <?= htmlspecialchars($user['role']) ?>)</h1>
<a href="index.php?page=logout">Déconnexion</a>

<?php if ($user['role'] === 'admin'): ?>
    <p><a href="index.php?page=admin_users">Gestion des utilisateurs</a></p>
    <p><a href="index.php?page=admin_themes">Gestion des thématiques</a></p>
<?php elseif ($user['role'] === 'salarié'): ?>
    <p><a href="index.php?page=submit_idea">Proposer une idée</a></p>
    <p><a href="index.php?page=my_feedback">Voir mes retours</a></p>
<?php elseif ($user['role'] === 'évaluateur'): ?>
    <p><a href="index.php?page=rate_ideas">Évaluer les idées</a></p>
    <p><a href="index.php?page=top_ideas">Meilleures idées</a></p>
<?php endif; ?>
