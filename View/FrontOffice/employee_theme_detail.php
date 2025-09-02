<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../components/header.php';
?>

<div class="container my-5">
    <!-- Theme Card with Default Image -->
    <div class="card shadow-sm mb-4">
        <img src="public/assets/avatar.jpg" class="card-img-top" alt="Theme image" style="height: 200px; object-fit: cover;">
        <div class="card-body">
            <h2 class="card-title text-primary"><?= htmlspecialchars($theme['title']) ?></h2>
            <?php if (!empty($theme['description'])): ?>
                <p class="card-text text-muted"><?= nl2br(htmlspecialchars($theme['description'])) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Idea Submission Form 
    <div class="card shadow-sm">-->
    <div >
         <!--
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">💡 Proposer une idée pour cette thématique</h5>
        </div>-->
        <div class="card-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" action="index.php?page=theme_detail_employee&id=<?= (int)$theme['id'] ?>">
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Titre de l'idée <span class="text-danger">*</span></label>
                    <input type="text" id="title" name="title" class="form-control form-control-sm shadow-sm rounded" required
                           value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>"
                           placeholder="Entrez le titre de votre idée">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea id="description" name="description" class="form-control form-control-sm shadow-sm rounded" rows="4"
                              placeholder="Décrivez votre idée..."><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php?page=themes_employee" class="btn btn-outline-secondary btn-sm">
                        ← Retour à la liste des thématiques
                    </a>
                    <button type="submit" class="btn btn-success btn-sm">
                        🚀 Soumettre l'idée
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
