<!--
Fichier : modify.php
Auteur : Léane DEVILLE
Date de création : 10 février 2025
Description : Vue pour la page de getsion de la bibliothèque modification.
-->

<?php require "views/header.php"; ?>
</head>

<body>
    <?php require "views/menu.php"; ?>

    <div class="container">
        <h1>Gestion de la Bibliothèque</h1>

        <?php
        // Vérifier si des messages sont passés dans l'URL
        if (isset($_GET['message'])) {
            switch ($_GET['message']) {
                case 'success':
                    echo '<div class="success-message">Livre ajouté à la bibliothèque avec succès!</div>';
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

        <div id="formBook" class="add-form">
            <h3 id="add">Ajouter un livre</h3>
            <form action="controllers/controller.php" method="post">
                <label for="newBook_name">Nom</label>
                <input type="text" id="newBook_name" name="newBook_name" required>

                <label for="newBook_author">Auteur</label>
                <input type="text" id="newBook_author" name="newBook_author" required>

                <label for="newBook_year">Année de publication</label>
                <input type="number" id="newBook_year" name="newBook_year" required>

                <label for="newBook_summary">Résumé</label>
                <textarea id="newBook_summary" name="newBook_summary" required rows="4"></textarea>

                <input type="submit" value="Ajouter">
            </form>
        </div>

        <hr>

        <?php if (isset($data) && $data): ?>
            <div id="formBook" class="edit-form">
                <h3 id="edit">Modifier un livre</h3>
                <h4>Informations actuelles :</h4>
                <table>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Année</th>
                        <th>Résumé</th>
                    </tr>
                    <tr>
                        <td><?= htmlspecialchars($data['name']) ?></td>
                        <td><?= htmlspecialchars($data['author']) ?></td>
                        <td><?= htmlspecialchars($data['year']) ?></td>
                        <td><?= htmlspecialchars($data['summary']) ?></td>
                    </tr>
                </table>

                <h4>Modifier les informations :</h4>
                <form action="controllers/controller.php" method="post">
                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($id) ?>">

                    <label for="chgBook_name">Nom</label>
                    <input type="text" id="chgBook_name" name="chgBook_name" value="<?= htmlspecialchars($data['name']) ?>"
                        required>

                    <label for="chgBook_author">Auteur</label>
                    <input type="text" id="chgBook_author" name="chgBook_author"
                        value="<?= htmlspecialchars($data['author']) ?>" required>

                    <label for="chgBook_year">Année de publication</label>
                    <input type="number" id="chgBook_year" name="chgBook_year"
                        value="<?= htmlspecialchars($data['year']) ?>" required>

                    <label for="chgBook_summary">Résumé</label>
                    <textarea id="chgBook_summary" name="chgBook_summary" required
                        rows="4"><?= htmlspecialchars($data['summary']) ?></textarea>

                    <input type="submit" value="Modifier">
                </form>
            </div>

            <hr>

            <div id="formBook" class="delete-form">
                <h3 id="delete">Supprimer un livre</h3>
                <form action="controllers/controller.php" method="post">
                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($id) ?>">
                    <input type="hidden" name="delBook_name" value="<?= htmlspecialchars($data['name']) ?>">

                    <label for="del_name">Nom</label>
                    <input type="text" id="del_name" value="<?= htmlspecialchars($data['name']) ?>" disabled>

                    <label for="del_author">Auteur</label>
                    <input type="text" id="del_author" value="<?= htmlspecialchars($data['author']) ?>" disabled>

                    <label for="del_year">Année de publication</label>
                    <input type="number" id="del_year" value="<?= htmlspecialchars($data['year']) ?>" disabled>

                    <label for="del_summary">Résumé</label>
                    <textarea id="del_summary" disabled rows="4"><?= htmlspecialchars($data['summary']) ?></textarea>

                    <input type="submit" value="Supprimer"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre?');">
                </form>
            </div>
        <?php else: ?>
            <div id="formBook">
                <h3>Sélectionnez un livre à modifier</h3>
                <p>Pour modifier ou supprimer un livre, veuillez le sélectionner depuis la <a
                        href="index.php?page=books">page des livres</a>.</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>