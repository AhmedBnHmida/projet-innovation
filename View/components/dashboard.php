<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

$user = $_SESSION['user'];
?>

<?php include __DIR__ . '/../components/header.php'; ?>

<div class="text-center">
    <h1>Bienvenue, <?= htmlspecialchars($user['name']) ?> !</h1>

    <?php if ($user['role'] === ''): ?>
        <p style="color: red;">Wait for the admin to assign you a role.</p>
    <?php else: ?>
        <p>Vous êtes connecté en tant que <strong><?= htmlspecialchars($user['role']) ?></strong>.</p>
    <?php endif; ?>
    
</div>

<hr>

<?php if ($user['role'] === 'admin'): ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="index.php?page=admin_users" class="btn btn-outline-primary w-100">Gestion des utilisateurs</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="index.php?page=admin_themes" class="btn btn-outline-secondary w-100">Gestion des thématiques</a>
        </div>
    </div>

<?php elseif ($user['role'] === 'employee'): ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="index.php?page=themes_employee" class="btn btn-outline-success w-100">Thématiques</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="index.php?page=my_feedback" class="btn btn-outline-info w-100">Voir mes retours</a>
        </div>
    </div>

<?php elseif ($user['role'] === 'evaluator'): ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="index.php?page=rate_ideas" class="btn btn-outline-warning w-100">Évaluer les idées</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="index.php?page=top_ideas" class="btn btn-outline-dark w-100">Meilleures idées</a>
        </div>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../components/footer.php'; ?>
