<!--
Fichier : admin.php
Auteur : Léane DEVILLE
Date de création : 13 avril 2025
Description : Vue pour la page d'administration.
-->

<?php require "views/header.php"; ?>
</head>

<body>
    <?php require "views/menu.php"; ?>

    <div class="container">
        <h1>Panneau d'administration</h1>

        <?php if (isset($_GET['message']) && $_GET['message'] === 'roleupdate'): ?>
            <div class="success-message">Le rôle de l'utilisateur a été mis à jour avec succès.</div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'notadmin'): ?>
            <div class="error-message">Vous devez être administrateur pour accéder à cette page.</div>
        <?php endif; ?>

        <h3>Liste des utilisateurs</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Rôle</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= $user['role'] === 'admin' ? 'Administrateur' : 'Utilisateur' ?></td>
                    <td><?= date('d/m/Y à H:i', strtotime($user['created_at'])) ?></td>
                    <td>
                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                            <form action="controllers/admin_controller.php?action=change_role" method="post"
                                class="inline-form">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="new_role"
                                    value="<?= $user['role'] === 'admin' ? 'user' : 'admin' ?>">

                                <?php if ($user['role'] === 'admin'): ?>
                                    <button type="submit" class="user-button role-tooltip"
                                        onclick="return confirm('Êtes-vous sûr de vouloir rétrograder cet administrateur en utilisateur simple?')">
                                        Rétrograder
                                    </button>
                                <?php else: ?>
                                    <button type="submit" class="admin-button role-tooltip"
                                        onclick="return confirm('Êtes-vous sûr de vouloir promouvoir cet utilisateur en administrateur?')">
                                        Promouvoir
                                    </button>
                                <?php endif; ?>
                            </form>
                        <?php else: ?>
                            <span class="disabled-button role-tooltip">
                                Action indisponible
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>