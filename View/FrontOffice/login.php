<?php include __DIR__ . '/../components/header.php'; ?>

<body class="bg-light">

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 16px;">
        <h2 class="text-center mb-4 text-primary">Connexion</h2>

        <?php if (isset($error)) echo "<p class='text-danger text-center'>$error</p>"; ?>

        <form method="POST" action="index.php?page=login">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>

        <p class="mt-3 text-center">
            Pas de compte ?
            <a href="index.php?page=register">S'inscrire</a>
        </p>
    </div>
</div>

</body>

<?php include __DIR__ . '/../components/footer.php'; ?>
