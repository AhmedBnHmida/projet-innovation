<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="index.php?page=register">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required><br>

        <!-- For now, hide role selection to public. You can add later if admin registers users -->
        <!-- <select name="role">
            <option value="salarié">Salarié</option>
            <option value="évaluateur">Évaluateur</option>
        </select><br> -->

        <button type="submit">S'inscrire</button>
    </form>
    <p>Vous avez déjà un compte ? <a href="index.php?page=login">Se connecter</a></p>
</body>
</html>
