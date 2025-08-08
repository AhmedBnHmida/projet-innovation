<?php
// Variables:
// $user (User object or null for create)
// $error (optional string)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';

$isEdit = isset($user);
$formAction = $isEdit ? "index.php?page=admin_user_update&id=" . $user->getId() : "index.php?page=admin_user_create";
$formTitle = $isEdit ? "Modifier l'utilisateur" : "Créer un nouvel utilisateur";

$nameValue = $isEdit ? htmlspecialchars($user->getName()) : '';
$emailValue = $isEdit ? htmlspecialchars($user->getEmail()) : '';
$roleValue = $isEdit ? $user->getRole() : '';
?>

<div class="container my-4">
    <h2><?= $formTitle ?></h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= $formAction ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input required type="text" id="name" name="name" value="<?= $nameValue ?>" class="form-control" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input required type="email" id="email" name="email" value="<?= $emailValue ?>" class="form-control" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">
                <?= $isEdit ? 'Nouveau mot de passe (laisser vide pour garder actuel)' : 'Mot de passe' ?>
            </label>
            <input <?= $isEdit ? '' : 'required' ?> type="password" id="password" name="password" class="form-control" />
        </div>

        <div class="mb-3">
            <label for="confirm_password" class="form-label">
                <?= $isEdit ? 'Confirmer le nouveau mot de passe' : 'Confirmer le mot de passe' ?>
            </label>
            <input <?= $isEdit ? '' : 'required' ?> type="password" id="confirm_password" name="confirm_password" class="form-control" />
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select required id="role" name="role" class="form-select">
                <option value="" <?= $roleValue === '' ? 'selected' : '' ?>>Aucun</option>
                <option value="admin" <?= $roleValue === 'admin' ? 'selected' : '' ?>>admin</option>
                <option value="employee" <?= $roleValue === 'employee' ? 'selected' : '' ?>>employee</option>
                <option value="evaluator" <?= $roleValue === 'evaluator' ? 'selected' : '' ?>>evaluator</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Créer' ?></button>
        <a href="index.php?page=admin_users" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
