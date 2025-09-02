<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plateforme Innovation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to right, #f3f9ff, #e8f5e9);
    }

    /* General nav link style (button-like) */
    .navbar-nav .nav-link {
        padding: 8px 15px;
        border-radius: 5px;
        transition: all 0.3s ease;
        color: #fff !important;
        margin-left: 5px;
    }

    .navbar-nav .nav-link:hover {
        text-decoration: none;
    }

    /* Dashboard/regular links hover effect */
    .navbar-nav .nav-link:not([href*="logout"]):not([href*="login"]):not([href*="register"]):hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff !important;
    }

    /* Déconnexion button style */
    .navbar-nav .nav-link[href*="logout"] {
        background-color: #c82333; /* Bootstrap danger */
        font-weight: bold;
    }

    .navbar-nav .nav-link[href*="logout"]:hover {
        background-color: #dc3545; /* brighter red */
        color: #fff !important;
    }

    /* Connexion button style */
    .navbar-nav .nav-link[href*="login"] {
        background-color: #007bff; /* Bootstrap primary */
        font-weight: bold;
    }

    .navbar-nav .nav-link[href*="login"]:hover {
        background-color: #0056b3; /* darker blue */
        color: #fff !important;
    }

    /* Créer un compte button style */
    .navbar-nav .nav-link[href*="register"] {
        background-color: #28a745; /* Bootstrap success */
        font-weight: bold;
    }

    .navbar-nav .nav-link[href*="register"]:hover {
        background-color: #218838; /* darker green */
        color: #fff !important;
    }
</style>


</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=landing">Innovation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=dashboard">Dashboard</a></li>

                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_users">Utilisateurs</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_themes">Thématiques</a></li>
                    
                    <?php elseif ($_SESSION['user']['role'] === 'employee'): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=themes_employee">Thématiques</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=my_ideas">Mes idées</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=my_feedback">Mes retours</a></li>
                    
                    <?php elseif ($_SESSION['user']['role'] === 'evaluator'): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=rate_ideas">Évaluer</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=top_ideas">Top idées</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=my_ratings">Mes évaluations</a></li>

                    <?php endif; ?>

                    <li class="nav-item"><a class="nav-link" href="index.php?page=logout">Déconnexion</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=login">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=register">Créer un compte</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
