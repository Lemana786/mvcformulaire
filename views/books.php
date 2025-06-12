<!--
Fichier : books.php
Auteur : Léane DEVILLE
Date de création : 10 février 2025
Description :  Ce fichier représente la vue de la bibliothèque, qui affiche la liste des livres présents dans la base de 
données. Cela compredn l'affichage des messages de succès après des opérations (ajout, modification, suppression) et fournit 
un tableau contenant les livres avec leurs informations (titre, auteur, année, résumé). Si aucun livre n'est présent, un 
message indiquant qu'il n'y a pas de livres dans la bibliothèque est affiché avec un lien pour en ajouter. Le fichier 
inclut également des liens pour modifier ou supprimer chaque livre de la liste.
-->

<?php require "views/header.php"; ?>
</head>

<body>
    <?php require "views/menu.php"; ?>

    <div class="container">
        <h1>Bibliothèque</h1>
        <h2>Liste des livres</h2>

        <?php
        // Afficher les messages de succès
        if (isset($_GET['message'])) {
            switch ($_GET['message']) {
                case 'success':
                    echo '<div class="success-message">Livre ajouté avec succès!</div>';
                    break;
                case 'updated':
                    echo '<div class="success-message">Livre modifié avec succès!</div>';
                    break;
                case 'deleted':
                    echo '<div class="success-message">Livre supprimé avec succès!</div>';
                    break;
            }
        }
        ?>

        <!--$data (tableau) contient les livres de la base de données-->
        <?php if (empty($data)): ?>
            <div class="home-content">
                <p>Aucun livre dans la bibliothèque. <a href="index.php?page=modify">Ajouter un livre</a>.</p>
            </div>
            <?php
            // Afficher les messages d'erreur
            if (isset($_GET['error']) && $_GET['error'] === 'nopermission') {
                echo '<div class="error-message">Vous n\'avez pas la permission de modifier ou supprimer ce livre.</div>';
            }
            ?>
        <?php else: ?>
            <table>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Année</th>
                    <th>Résumé</th>
                    <th>Ajouté par</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($data as $ligne):
                    $id = htmlspecialchars($ligne['id']); ?>
                    <tr>
                        <td><?= htmlspecialchars($ligne['name']) ?></td>
                        <td><?= htmlspecialchars($ligne['author']) ?></td>
                        <td><?= htmlspecialchars($ligne['year']) ?></td>
                        <td><?= htmlspecialchars($ligne['summary']) ?></td>
                        <td><?= $ligne['creator_name'] ? htmlspecialchars($ligne['creator_name']) : 'Anonyme' ?></td>
                        <td>
                            <?php
                            $canEdit = isset($_SESSION['user_id']) &&
                                (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ||
                                    (isset($ligne['creator_id']) && $ligne['creator_id'] == $_SESSION['user_id']));

                            if ($canEdit): ?>
                                <a href="index.php?page=modify&id=<?= $id ?>#edit" class="action-button modify-button">⚙️</a>
                                <a href="index.php?page=modify&id=<?= $id ?>#delete" class="action-button delete-button">❌</a>
                            <?php else: ?>
                                <span class="action-button disabled-button"
                                    title="Vous n'avez pas les permissions nécessaires">⚙️</span>
                                <span class="action-button delete-button disabled-button"
                                    title="Vous n'avez pas les permissions nécessaires">❌</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="index.php?page=modify#add"
                style="display: inline-block; background-color: var(--text-color); color: white; padding: 0.8rem 2rem; border-radius: 4px; font-weight: 600; text-decoration: none;">
                Ajouter un nouveau livre
            </a>
        </div>
    </div>
</body>

</html>