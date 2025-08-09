<?php include __DIR__ . '/../components/header.php'; ?>

<body class="bg-light">

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 16px;">
        <h2 class="text-center mb-4 text-primary">Inscription</h2>

        <?php if (isset($error)) echo "<p class='text-danger text-center'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='text-success text-center'>$success</p>"; ?>

        <form method="POST" action="index.php?page=register">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Nom complet" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
            </div>
            <div class="mb-3">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirmer le mot de passe" required>
            </div>
            <button type="submit" class="btn btn-success w-100">S'inscrire</button>
        </form>

        <p class="mt-3 text-center">
            Vous avez déjà un compte ?
            <a href="index.php?page=login">Se connecter</a>
        </p>
    </div>
</div>

</body>

<?php include __DIR__ . '/../components/footer.php'; ?>
