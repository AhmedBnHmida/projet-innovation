<?php
// Variables: $themes (array), $error (optional)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Gestion des thématiques</h2>

    <a href="index.php?page=admin_theme_create" class="btn btn-success mb-3">Créer une nouvelle thématique</a>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($themes as $theme): ?>
                <tr>
                    <td><?= htmlspecialchars($theme['id']) ?></td>
                    <td><?= htmlspecialchars($theme['title']) ?></td>
                    <td><?= htmlspecialchars($theme['description']) ?></td>
                    <td>
                        <a href="index.php?page=admin_theme_edit&id=<?= $theme['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="index.php?page=admin_theme_delete&id=<?= $theme['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Supprimer cette thématique ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
