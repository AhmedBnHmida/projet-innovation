<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Mes retours sur mes idées</h2>

    <?php if (empty($feedback)): ?>
        <p>Aucun retour disponible pour le moment.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-info">
                <tr>
                    <th>Idée</th>
                    <th>Thématique</th>
                    <th>Note attribuée</th>
                    <th>Date du retour</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedback as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['idea_title']) ?></td>
                        <td><?= htmlspecialchars($row['theme_title']) ?></td>
                        <td><?= htmlspecialchars($row['rating']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
