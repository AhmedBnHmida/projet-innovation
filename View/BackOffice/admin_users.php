<?php
// Variables: $users (array), $error (optional string)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../components/header.php';
?>

<div class="container my-4">
    <h2>Gestion des utilisateurs</h2>

    <a href="index.php?page=admin_user_create" class="btn btn-success mb-3">Créer un nouvel utilisateur</a>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="index.php?page=admin_user_edit&id=<?= $user['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="index.php?page=admin_user_delete&id=<?= $user['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
