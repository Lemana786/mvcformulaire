<!--
Fichier : profile.php
Auteur : Léane DEVILLE
Date de création : 07 avril 2025
Description : Vue pour la page du profil utilisateur.
-->

<?php require "views/header.php"; ?>
</head>

<body>
    <?php require "views/menu.php"; ?>

    <div class="container">
        <h1>Mon profil</h1>

        <?php
        // Afficher les erreurs
        if (isset($_GET['error']) && $_GET['error'] === 'deleteerror') {
            echo '<div class="error-message">Erreur lors de la suppression du compte.</div>';
        }
        ?>

    <!--Informations sur le profil connecté-->
        <div id="formBook" class="profile-info">
            <h3>Informations du compte</h3>

            <div class="info-group">
                <label>Nom d'utilisateur:</label>
                <p><?= htmlspecialchars($user['username']) ?></p>
            </div>

            <div class="info-group">
                <label>Rôle:</label>
                <p><?= $user['role'] === 'admin' ? 'Administrateur' : 'Utilisateur' ?></p>
                <?php if ($user['role'] === 'admin'): ?>
                    <span>Vous êtes administrateur, vous pouvez modifier et supprimer n'importe quel livre de la
                        bibliothèque.</span>
                <?php else: ?>
                    <span>Vous êtes simple utilisateur, vous ne pouvez modifier et supprimer que vos propres livres dans la
                        bibliothèque.</span>
                <?php endif; ?>
            </div>


            <div class="info-group">
                <label>Compte créé le:</label>
                <p><?= date('d/m/Y à H:i', strtotime($user['created_at'])) ?></p>
            </div>

            <div class="button-group">
                <a href="controllers/auth_controller.php?action=logout" class="logout-button">Déconnexion</a>

                <form action="controllers/auth_controller.php?action=delete_account" method="post"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte? Cette action est irréversible.');">
                    <button type="submit" class="delete-account-button">Supprimer mon compte</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>