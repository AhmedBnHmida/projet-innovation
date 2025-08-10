<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Idées pour la thématique</h2>

    <?php if (empty($ideas)): ?>
        <p>Aucune idée trouvée pour cette thématique.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date de soumission</th>
                    <th>Noter</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ideas as $idea): ?>
                    <tr>
                        <td><?= htmlspecialchars($idea['title']) ?></td>
                        <td><?= nl2br(htmlspecialchars($idea['description'])) ?></td>
                        <td><?= htmlspecialchars($idea['created_at']) ?></td>
                        <td>
                            <form action="index.php?page=rate_idea&id=<?= $idea['id'] ?>" method="POST" class="d-flex">
                                <input type="hidden" name="theme_id" value="<?= $idea['theme_id'] ?>">
                                <input type="number" name="rating" min="1" max="10" class="form-control form-control-sm me-2" placeholder="Note" required>
                                <button type="submit" class="btn btn-warning btn-sm">Noter</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="index.php?page=rate_ideas" class="btn btn-secondary mt-3">← Retour aux thématiques</a>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
