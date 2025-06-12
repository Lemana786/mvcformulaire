<!--
Fichier : register.php
Auteur : Léane DEVILLE
Date de création : 07 avril 2025
Description : Vue pour la page d'inscription.
-->

<?php require "views/header.php"; ?>
</head>

<body>
    <?php require "views/menu.php"; ?>

    <div class="container">
        <h1>Inscription</h1>
        
        <?php
        // Afficher les messages
        if (isset($_GET['message']) && $_GET['message'] === 'accountdeleted') {
            echo '<div class="success-message">Votre compte a été supprimé avec succès.</div>';
        }
        
        // Afficher les erreurs
        if (!empty($error)) {
            echo '<div class="error-message">';
            switch ($error) {
                case 'emptyfields':
                    echo 'Veuillez remplir tous les champs.';
                    break;
                case 'passwordmismatch':
                    echo 'Les mots de passe ne correspondent pas.';
                    break;
                case 'usernametaken':
                    echo 'Ce nom d\'utilisateur est déjà pris.';
                    break;
                case 'dberror':
                    echo 'Erreur lors de l\'inscription. Veuillez réessayer.';
                    break;
                default:
                    echo 'Une erreur s\'est produite.';
            }
            echo '</div>';
        }
        ?>
        
        <div id="formBook" class="register-form">
            <form action="controllers/auth_controller.php?action=register" method="post">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                
                <input type="submit" value="S'inscrire">
            </form>
            
            <div class="form-footer">
                <p>Déjà inscrit? <a href="index.php?page=login">Se connecter</a></p>
            </div>
        </div>
    </div>
</body>
</html>