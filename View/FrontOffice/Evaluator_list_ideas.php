<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-5">
    <!-- Thématique as a Post -->
    <div class="card shadow mb-4">
        <img src="public/assets/avatar.jpg" class="card-img-top" alt="Thématique image" style="height: 200px; object-fit: cover;">
        <div class="card-body">
            <h3 class="card-title text-primary"><?= htmlspecialchars($theme['title']) ?></h3>
            <?php if (!empty($theme['description'])): ?>
                <p class="card-text"><?= nl2br(htmlspecialchars($theme['description'])) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <h4 class="mb-3">💡 Idées proposées</h4>

    <?php if (empty($ideas)): ?>
        <p>Aucune idée trouvée pour cette thématique.</p>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($ideas as $idea): ?>
                <!-- Idea as Comment -->
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex mb-2 align-items-start">
                            <img src="public/assets/avatar.jpg" class="rounded-circle me-3" alt="User avatar" style="width:40px; height:40px; object-fit:cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-1"><?= htmlspecialchars($idea['title']) ?></h6>
                                <p class="mb-1 text-muted"><?= nl2br(htmlspecialchars($idea['description'])) ?></p>
                                <small class="text-muted">Soumis le: <?= htmlspecialchars($idea['created_at']) ?></small>
                            </div>
                        </div>

                        <!-- Rating Form -->
                        <form action="index.php?page=rate_idea&id=<?= $idea['id'] ?>" method="POST" class="d-flex mt-2">
                            <input type="hidden" name="theme_id" value="<?= $idea['theme_id'] ?>">
                            <input type="number" name="rating" min="1" max="10" class="form-control form-control-sm me-2" placeholder="Note" required>
                            <button type="submit" class="btn btn-warning btn-sm">Noter</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <a href="index.php?page=rate_ideas" class="btn btn-secondary btn-sm mt-3">← Retour aux thématiques</a>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
