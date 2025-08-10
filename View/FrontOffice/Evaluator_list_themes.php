<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Liste des thématiques</h2>

    <?php if (empty($themes)): ?>
        <p>Aucune thématique disponible.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($themes as $theme): ?>
                    <tr>
                        <td><?= htmlspecialchars($theme['title']) ?></td>
                        <td><?= nl2br(htmlspecialchars($theme['description'] ?? '')) ?></td>
                        <td>
                            <a href="index.php?page=rate_ideas_theme&id=<?= $theme['id'] ?>" class="btn btn-primary btn-sm">
                                Voir idées
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
