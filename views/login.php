<!--
Fichier : login.php
Auteur : Léane DEVILLE
Date de création : 07 avril 2025
Description : Vue pour la page de connexion.
-->

<?php require "views/header.php"; ?>
</head>

<body>
    <?php require "views/menu.php"; ?>

    <div class="container">
        <h1>Connexion</h1>

        <?php
        // Afficher les messages
        if (isset($_GET['message'])) {
            switch ($_GET['message']) {
                case 'registered':
                    echo '<div class="success-message">Inscription réussie! Vous pouvez maintenant vous connecter.</div>';
                    break;
                case 'loggedout':
                    echo '<div class="success-message">Vous avez été déconnecté avec succès.</div>';
                    break;
            }
        }

        // Afficher les erreurs
        if (!empty($error)) {
            echo '<div class="error-message">';
            switch ($error) {
                case 'emptyfields':
                    echo 'Veuillez remplir tous les champs.';
                    break;
                case 'wrongcredentials':
                    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
                    break;
                case 'notconnected':
                    echo 'Vous devez être connecté pour accéder à cette page.';
                    break;
                default:
                    echo 'Une erreur s\'est produite.';
            }
            echo '</div>';
        }
        ?>

        <div id="formBook" class="login-form">
            <form action="controllers/auth_controller.php?action=login" method="post">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>

                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="checkbox-label">Se souvenir de moi</label>
                </div>

                <input type="submit" value="Se connecter">
            </form>

            <div class="form-footer">
                <p>Pas encore de compte? <a href="index.php?page=register">S'inscrire</a></p>
            </div>
        </div>
    </div>
</body>

</html>