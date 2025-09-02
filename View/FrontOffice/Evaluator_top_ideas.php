<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-5">
    <h2 class="mb-4">🏆 Top 10 idées les mieux notées</h2>

    <?php if (empty($ideas)): ?>
        <p>Aucune idée notée pour le moment.</p>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($ideas as $idea): ?>
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="public/assets/avatar.jpg" alt="Avatar" class="rounded-circle me-3" style="width:50px; height:50px; object-fit:cover;">
                                <div>
                                    <h5 class="card-title mb-0"><?= htmlspecialchars($idea['title']) ?></h5>
                                    <small class="text-muted">Thématique: <?= htmlspecialchars($idea['theme_title']) ?></small>
                                </div>
                            </div>

                            <p class="card-text text-truncate" style="max-height: 60px; overflow:hidden;">
                                <?= nl2br(htmlspecialchars($idea['description'] ?? 'Pas de description')) ?>
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-success">⭐ <?= number_format($idea['avg_rating'], 2) ?></span>
                                <a href="index.php?page=top_idea_detail&id=<?= $idea['id'] ?>" class="btn btn-primary btn-sm">Voir détails</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
