<!--
Fichier : menu.php
Auteur : Léane DEVILLE
Date de création : 10 février 2025
Description :  Ce fichier représente la vue au niveau du menu de navigation. La page contient donc un menu de navigation
de trois possibilités (acceuil, collection et modifier/ajouter).
-->

<?php if (session_status() == PHP_SESSION_NONE)
    session_start(); ?>

<nav>
    <ul>
        <li><a href="index.php?page=home">Accueil</a></li>
        <li><a href="index.php?page=books">Collection</a></li>
        <li><a href="index.php?page=modify#add">Modifier/Ajouter</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="index.php?page=profile"><?= htmlspecialchars($_SESSION['username']) ?></a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="index.php?page=admin">Administration</a></li>
            <?php endif; ?>
        <?php else: ?>
            <li><a href="index.php?page=login">Connexion</a></li>
            <li><a href="index.php?page=register">Inscription</a></li>
        <?php endif; ?>
    </ul>
</nav>