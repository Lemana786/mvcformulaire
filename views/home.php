<!--
Fichier : home.php
Auteur : Léane DEVILLE
Date de création : 10 février 2025
Description :  Ce fichier représente la vue au niveau de l'accueil de la bibliothèque. La page contient un en-tête, 
un menu de navigation, et trois cartes de présentant le sdifférentes possibilités (afficher, modifier et ajouter). 
Ce fichier inclut également les fichiers `header.php` et `menu.php` pour la gestion de l'entête et du menu de navigation.
-->

<?php require "views/header.php"; ?>
</head>

<body>
    <?php require "views/menu.php"; ?>

    <div class="container">
        <div class="home-hero">
            <h1>Bienvenue dans votre Bibliothèque</h1>
            <p>Un système simple et efficace pour gérer votre collection de livres. Parcourez, ajoutez et modifiez votre
                bibliothèque en quelques clics.</p>
        </div>

        <div class="feature-cards">
            <div class="feature-card">
                <div class="icon">📚</div>
                <h3>Parcourir les Livres</h3>
                <p>Consultez l'ensemble de votre collection de livres.</p>
                <a href="index.php?page=books" class="feature-card-link">Voir la collection</a>
            </div>

            <div class="feature-card">
                <div class="icon">⚙️</div>
                <h3>Gérer la Collection</h3>
                <p>Modifiez ou supprimez les informations de vos livres existants.</p>
                <a href="index.php?page=books" class="feature-card-link">Gérer les livres</a>
            </div>

            <div class="feature-card">
                <div class="icon">➕</div>
                <h3>Ajouter un Livre</h3>
                <p>Enrichissez votre bibliothèque en ajoutant de nouveaux livres.</p>
                <a href="index.php?page=modify#add" class="feature-card-link">Ajouter un livre</a>
            </div>
        </div>
    </div>
</body>

</html>