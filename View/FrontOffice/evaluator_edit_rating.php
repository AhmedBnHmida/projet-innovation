<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Modifier mon évaluation pour : <?= htmlspecialchars($rating['idea_title']) ?></h2>

    <form method="POST" action="index.php?page=update_rating&id=<?= intval($_GET['id']) ?>">
        <div class="mb-3">
            <label for="rating" class="form-label">Note</label>
            <input type="number" min="1" max="10" id="rating" name="rating" class="form-control" required value="<?= htmlspecialchars($rating['rating']) ?>">
            <div class="form-text">Note entre 1 et 10.</div>
        </div>
        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="index.php?page=my_ratings" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
