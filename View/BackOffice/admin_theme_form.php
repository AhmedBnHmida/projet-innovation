<?php
// Variables:
// $theme (Theme object when editing, null when creating)
// $error (optional string)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../components/header.php';

$isEdit = isset($theme);
$formAction = $isEdit ? 'index.php?page=admin_theme_update&id=' . $theme->getId() : 'index.php?page=admin_theme_create';
$formTitle = $isEdit ? "Modifier la thématique" : "Créer une nouvelle thématique";

$titleValue = $isEdit ? htmlspecialchars($theme->getTitle()) : '';
$descriptionValue = $isEdit ? htmlspecialchars($theme->getDescription() ?? '') : '';
?>

<div class="container my-4">
    <h2><?= $formTitle ?></h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="<?= $formAction ?>" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" id="title" name="title" class="form-control" required value="<?= $titleValue ?>">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4"><?= $descriptionValue ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Créer' ?></button>
        <a href="index.php?page=admin_themes" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
