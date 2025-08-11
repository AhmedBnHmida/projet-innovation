<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Mes évaluations</h2>

    <?php if (empty($myRatings)): ?>
        <p>Vous n'avez pas encore évalué d'idées.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Idée</th>
                    <th>Thématique</th>
                    <th>Note attribuée</th>
                    <th>Date d'évaluation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($myRatings as $rating): ?>
                    <tr>
                        <td><?= htmlspecialchars($rating['idea_title']) ?></td>
                        <td><?= htmlspecialchars($rating['theme_title']) ?></td>
                        <td><?= htmlspecialchars($rating['rating']) ?></td>
                        <td><?= htmlspecialchars($rating['created_at']) ?></td>
                        <td>
                <a href="index.php?page=edit_rating&id=<?= $rating['idea_id'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                <a href="index.php?page=delete_rating&id=<?= $rating['idea_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette évaluation ?');">Supprimer</a>
            </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
