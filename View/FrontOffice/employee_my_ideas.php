<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Mes idées soumises</h2>

    <?php if (empty($ideas)): ?>
        <p>Vous n'avez encore soumis aucune idée.</p>
        <a href="index.php?page=submit_idea" class="btn btn-success">Proposer une idée</a>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Thématique</th>
                    <th>Description</th>
                    <th>Date de soumission</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ideas as $idea): ?>
                    <tr>
                        <td><?= htmlspecialchars($idea['title']) ?></td>
                        <td><?= htmlspecialchars($idea['theme_title']) ?></td>
                        <td><?= nl2br(htmlspecialchars($idea['description'])) ?></td>
                        <td><?= htmlspecialchars($idea['created_at']) ?></td>
                        <td>
                            <a href="index.php?page=view_idea&id=<?= $idea['id'] ?>" class="btn btn-info btn-sm">Voir</a>
                            <a href="index.php?page=edit_idea&id=<?= $idea['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
                            <a href="index.php?page=delete_idea&id=<?= $idea['id'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Supprimer cette idée ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
