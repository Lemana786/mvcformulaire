<!--
Fichier : index.php
Auteur : Léane DEVILLE
Date de création : 10 février 2025
Description : Ce fichier sert de porte d'entrée principal de l'application. Il gère le routage des différentes pages 
en fonction des paramètres passés dans l'URL. Selon la page demandée, il appelle les fonctions appropriées du 
contrôleur pour afficher le contenu.
-->

<?php
require "controllers/controller.php";
require "controllers/auth_controller.php";

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Récupération du paramètre de page
if (isset($_GET["page"])) {
    $page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_SPECIAL_CHARS);
} else {
    $page = "home";
}

//-- Routage vers la page appropriée --
switch ($page) {
    case "home":
        DisplayHome();
        break;
    case "books":
        DisplayBooks();
        break;
    case "modify":
        DisplayModify();
        break;
    case "login":
        DisplayLogin();
        break;
    case "register":
        DisplayRegister();
        break;
    case "profile":
        DisplayProfile();
        break;
    case "admin":
        // Inclure le contrôleur d'admin si ce n'est pas déjà fait
        require "controllers/admin_controller.php";
        DisplayAdmin();
        break;
    default:
        DisplayHome();
        break;
}
?>