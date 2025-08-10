<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Top 10 idées les mieux notées</h2>

    <?php if (empty($ideas)): ?>
        <p>Aucune idée notée pour le moment.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-danger">
                <tr>
                    <th>Titre de l'idée</th>
                    <th>Thématique</th>
                    <th>Note moyenne</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ideas as $idea): ?>
                    <tr>
                        <td><?= htmlspecialchars($idea['title']) ?></td>
                        <td><?= htmlspecialchars($idea['theme_title']) ?></td>
                        <td><?= number_format($idea['avg_rating'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
