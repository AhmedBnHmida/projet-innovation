<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include __DIR__ . '/../components/header.php';
?>

<div class="container my-5">
    <div class="card shadow">
        <img src="public/assets/avatar.jpg" class="card-img-top" alt="Idea image" style="height: 250px; object-fit: cover;">
        <div class="card-body">
            <h3 class="card-title"><?= htmlspecialchars($idea['title']) ?></h3>
            <h6 class="text-primary">Thématique: <?= htmlspecialchars($idea['theme_title']) ?></h6>
            <p class="text-muted mb-1">Soumis le: <?= htmlspecialchars($idea['created_at']) ?></p>
            <p class="card-text"><?= nl2br(htmlspecialchars($idea['description'])) ?></p>
            <p>
                <strong>Note moyenne: </strong> 
                <?= $idea['avg_rating'] ? number_format($idea['avg_rating'], 2) : 'Pas encore notée' ?>
            </p>

            <!-- Rating Form -->
            <form action="index.php?page=rate_idea&id=<?= $idea['id'] ?>" method="POST" class="d-flex mt-3">
                <input type="hidden" name="theme_id" value="<?= $idea['theme_id'] ?>">
                <input type="number" name="rating" min="1" max="10" class="form-control form-control-sm me-2" 
                    value="<?= $myRating['rating'] ?? '' ?>" placeholder="Votre note" required>
                <button type="submit" class="btn btn-warning btn-sm">
                    <?= $myRating ? 'Modifier ma note' : 'Noter' ?>
                </button>
            </form>
        </div>
    </div>

    <a href="index.php?page=top_ideas" class="btn btn-secondary btn-sm mt-3">← Retour aux Top idées</a>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
