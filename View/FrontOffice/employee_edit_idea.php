<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';

// Prepare form values (sticky form support)
$titleValue = $_POST['title'] ?? $idea['title'] ?? '';
$descriptionValue = $_POST['description'] ?? $idea['description'] ?? '';

// $theme associative array passed from controller with 'title' and 'description'
?>

<div class="container my-4">

    <!-- Theme details block (read-only) -->
    <div class="mb-4 p-3 border rounded bg-light">
        <h3>Thématique associée :</h3>
        <strong><?= htmlspecialchars($theme['title'] ?? 'N/A') ?></strong>
        <?php if (!empty($theme['description'])): ?>
            <p><?= nl2br(htmlspecialchars($theme['description'])) ?></p>
        <?php else: ?>
            <p><em>Aucune description disponible pour cette thématique.</em></p>
        <?php endif; ?>
    </div>

    <!-- Idea edit form -->
    <form method="post" action="index.php?page=update_idea&id=<?= htmlspecialchars($idea['id']) ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Titre de l'idée <span class="text-danger">*</span></label>
            <input type="text" id="title" name="title" class="form-control" required value="<?= htmlspecialchars($titleValue) ?>">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="5"><?= htmlspecialchars($descriptionValue) ?></textarea>
        </div>

        <!-- Hidden theme_id to keep association during submission -->
        <input type="hidden" name="theme_id" value="<?= htmlspecialchars($idea['theme_id']) ?>">

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="index.php?page=my_ideas" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
