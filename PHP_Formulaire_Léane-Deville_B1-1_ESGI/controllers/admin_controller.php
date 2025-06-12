<!--
Fichier : admin_controller.php
Auteur : Léane DEVILLE
Date de création : 13 avril 2025
Description : Ce fichier contient le contrôleur d'administration qui gère les fonctionnalités d'utilisateur "simple" et d'administrateur.
-->

<?php
require_once __DIR__ . '/../models/dbconnexion.php';
require_once __DIR__ . '/../models/admin_model.php';

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* Vérifie si l'utilisateur est administrateur */
function IsAdminUser()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/*Affiche la page d'administration*/
function DisplayAdmin()
{
    // Vérifier si l'utilisateur est connecté et administrateur
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login&error=notconnected');
        exit();
    }
    
    if (!IsAdminUser()) {
        header('Location: index.php?page=home&error=notadmin');
        exit();
    }
    
    $db = DbConnexion();
    $users = GetAllUsers($db);
    
    require __DIR__ . '/../views/admin.php';
}

/*Traite le changement de rôle d'un utilisateur*/
function HandleChangeRole()
{
    // Vérifier si l'utilisateur est connecté et administrateur
    if (!isset($_SESSION['user_id']) || !IsAdminUser()) {
        header('Location: ../index.php?page=home&error=notadmin');
        exit();
    }
    
    $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    $newRole = filter_input(INPUT_POST, 'new_role', FILTER_SANITIZE_SPECIAL_CHARS);
    
    if (!$userId || !in_array($newRole, ['admin', 'user'])) {
        header('Location: ../index.php?page=admin&error=invaliddata');
        exit();
    }
    
    $db = DbConnexion();
    if (ChangeUserRole($db, $userId, $newRole)) {
        header('Location: ../index.php?page=admin&message=roleupdate');
    } else {
        header('Location: ../index.php?page=admin&error=dberror');
    }
    exit();
}

// Si ce fichier est appelé directement
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_GET['action'] ?? '';
        
        switch ($action) {
            case 'change_role':
                HandleChangeRole();
                break;
            default:
                header('Location: ../index.php');
                exit();
        }
    }
}
?>