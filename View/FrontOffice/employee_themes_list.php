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
        <ul class="list-group">
            <?php foreach ($themes as $theme): ?>
                <li class="list-group-item">
                    <a href="index.php?page=theme_detail_employee&id=<?= (int)$theme['id'] ?>">
                        <?= htmlspecialchars($theme['title']) ?>
                    </a>
                    <?php if (!empty($theme['description'])): ?>
                        <br><small class="text-muted"><?= htmlspecialchars($theme['description']) ?></small>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
