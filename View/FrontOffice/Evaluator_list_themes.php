<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-5">
    <h2 class="mb-4">Liste des thématiques</h2>

    <?php if (empty($themes)): ?>
        <p>Aucune thématique disponible.</p>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($themes as $theme): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Default avatar -->
                        <img src="public/assets/avatar.jpg" class="card-img-top" alt="Thématique image" style="height: 180px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <?= htmlspecialchars($theme['title']) ?>
                            </h5>
                            <?php if (!empty($theme['description'])): ?>
                                <p class="card-text text-muted flex-grow-1"><?= nl2br(htmlspecialchars($theme['description'])) ?></p>
                            <?php else: ?>
                                <p class="card-text text-muted flex-grow-1">Aucune description disponible.</p>
                            <?php endif; ?>
                            <a href="index.php?page=rate_ideas_theme&id=<?= $theme['id'] ?>" class="btn btn-primary btn-sm mt-2">
                                Voir idées
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
