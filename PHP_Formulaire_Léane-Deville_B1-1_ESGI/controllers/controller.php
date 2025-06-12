<!--
Fichier : controller.php 
Auteur : Léane DEVILLE
Date de création : 10 février 2025
Description : Ce fichier contient le contrôleur de l'application qui agit comme un intermédiaire entre les modèles et les vues.
Il reçoit les requêtes de l'utilisateur, interagit avec le modèle pour récupérer ou manipuler les données, puis passe ces 
données à la vue pour affichage. Le contrôleur gère également la logique de l'application, comme la validation des entrées 
de l'utilisateur.
-->

<?php
require __DIR__ . '/../models/dbconnexion.php';
require __DIR__ . '/../models/model.php';

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier l'authentification par cookie si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id']) && isset($_COOKIE['auth_token'])) {
    // Ici, nous devrions vérifier le token dans la base de données
    // et récupérer les informations de l'utilisateur
    $db = DbConnexion();
    // Pour l'instant, on utilise une approche simplifiée
    if (isset($_SESSION['auth_token']) && $_COOKIE['auth_token'] === $_SESSION['auth_token']) {
        // La session a expiré mais le cookie est valide
        // On devrait restaurer la session avec les données de l'utilisateur
    }
}

//-- Affiche la page d'accueil --
function DisplayHome()
{
    require __DIR__ . '/../views/home.php';
}

//-- Affiche la liste des livres --
function DisplayBooks()
{
    $db = DbConnexion();
    $data = GetBooks($db);
    require __DIR__ . '/../views/books.php';
}

//-- Affiche la page de modification d'un livre --
//-- Affiche la page de modification d'un livre --
function DisplayModify()
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login&error=notconnected');
        exit();
    }
    
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $db = DbConnexion();
    
    if ($id) {
        // Vérifier les permissions pour modifier ce livre
        if (!HasPermissionForBook($db, $id)) {
            header('Location: index.php?page=books&error=nopermission');
            exit();
        }
        
        $data = GetBook($db, $id);
    } else {
        $data = null;
    }
    
    require __DIR__ . '/../views/modify.php';
}

//-- Gère les actions sur les livres (ajout, modification, suppression) --
function HandleBookActions()
{
    $db = DbConnexion();
    
    // Traitement de l'ajout d'un livre
    if (isset($_POST['newBook_name'])) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../index.php?page=login&error=notconnected");
            exit();
        }
        
        // Validation des données
        $name = filter_input(INPUT_POST, 'newBook_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $author = filter_input(INPUT_POST, 'newBook_author', FILTER_SANITIZE_SPECIAL_CHARS);
        $year = filter_input(INPUT_POST, 'newBook_year', FILTER_VALIDATE_INT);
        $summary = filter_input(INPUT_POST, 'newBook_summary', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (!$name || !$author || !$year || !$summary) {
            header("Location: ../index.php?page=modify&error=invaliddata");
            exit();
        }
        
        $data = [
            'newBook_name' => $name,
            'newBook_author' => $author,
            'newBook_year' => $year,
            'newBook_summary' => $summary
        ];
        
        AddBook($db, $data);
        header("Location: ../index.php?page=books&message=success");
        exit();
    }
    
    // Traitement de la modification d'un livre
    if (isset($_POST['chgBook_name']) && isset($_POST['book_id'])) {
        if (!isset($_SESSION['user_id']) || !HasPermissionForBook($db, $_POST['book_id'])) {
            header("Location: ../index.php?page=books&error=nopermission");
            exit();
        }
        
        ModifyBook($db, $_POST);
        header("Location: ../index.php?page=books&message=updated");
        exit();
    }
    
    // Traitement de la suppression d'un livre
    if ((isset($_POST['delBook_name']) || isset($_POST['book_id'])) && isset($_POST['book_id'])) {
        if (!isset($_SESSION['user_id']) || !HasPermissionForBook($db, $_POST['book_id'])) {
            header("Location: ../index.php?page=books&error=nopermission");
            exit();
        }
        
        DeleteBook($db, $_POST);
        header("Location: ../index.php?page=books&message=deleted");
        exit();
    }
}

//Si ce fichier est appelé directement, exécuter HandleBookActions
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    HandleBookActions();
}

/**
 * -- Vérifie si l'utilisateur a le droit de modifier ou supprimer un livre --
 *
 * @param PDO $db         //La connexion à la base de données
 * @param int $bookId     //L'ID du livre
 * @return bool           //True si l'utilisateur a le droit, sinon false
 */
function HasPermissionForBook($db, $bookId)
{
    // Si l'utilisateur n'est pas connecté, refuser l'accès
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    
    // Les administrateurs ont toujours la permission
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        return true;
    }
    
    // Vérifier si l'utilisateur est le créateur du livre
    $sql = "SELECT creator_id FROM books WHERE id = ?";
    $statement = $db->prepare($sql);
    $statement->execute([$bookId]);
    $book = $statement->fetch();
    
    if ($book && $book['creator_id'] == $_SESSION['user_id']) {
        return true;
    }
    
    return false;
}
?>