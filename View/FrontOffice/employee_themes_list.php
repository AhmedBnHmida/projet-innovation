<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2 class="mb-4">Liste des thématiques</h2>

    <?php if (empty($themes)): ?>
        <p>Aucune thématique disponible.</p>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($themes as $theme): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="public/assets/avatar.jpg" class="card-img-top" alt="Theme image" style="height: 200px; object-fit: cover;" >
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="index.php?page=theme_detail_employee&id=<?= (int)$theme['id'] ?>" class="text-decoration-none">
                                    <?= htmlspecialchars($theme['title']) ?>
                                </a>
                            </h5>
                            <?php if (!empty($theme['description'])): ?>
                                <p class="card-text text-muted"><?= htmlspecialchars($theme['description']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer text-end">
                            <a href="index.php?page=theme_detail_employee&id=<?= (int)$theme['id'] ?>" class="btn btn-primary btn-sm">
                                Voir
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
