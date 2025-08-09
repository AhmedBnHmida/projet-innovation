<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2><?= htmlspecialchars($theme['title']) ?></h2>

    <?php if (!empty($theme['description'])): ?>
        <p><?= nl2br(htmlspecialchars($theme['description'])) ?></p>
    <?php endif; ?>

    <hr>

    <h3>Proposer une idée pour cette thématique</h3>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?page=theme_detail_employee&id=<?= (int)$theme['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Titre de l'idée <span class="text-danger">*</span></label>
            <input type="text" id="title" name="title" class="form-control" required value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="5"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Soumettre l'idée</button>
        <a href="index.php?page=themes" class="btn btn-secondary">Retour à la liste des thématiques</a>
    </form>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
