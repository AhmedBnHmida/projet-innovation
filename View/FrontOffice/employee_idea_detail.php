<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Détail de l'idée</h2>

    <dl class="row">
        <dt class="col-sm-2">Titre</dt>
        <dd class="col-sm-10"><?= htmlspecialchars($idea['title']) ?></dd>

        <dt class="col-sm-2">Thématique</dt>
        <dd class="col-sm-10"><?= htmlspecialchars($idea['theme_title']) ?></dd>

        <dt class="col-sm-2">Description</dt>
        <dd class="col-sm-10"><?= nl2br(htmlspecialchars($idea['description'])) ?></dd>

        <dt class="col-sm-2">Date de soumission</dt>
        <dd class="col-sm-10"><?= htmlspecialchars($idea['created_at']) ?></dd>
    </dl>

    <a href="index.php?page=my_ideas" class="btn btn-secondary">Retour à mes idées</a>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
