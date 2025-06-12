<!--
Fichier : auth_controller.php
Auteur : Léane DEVILLE
Date de création : 07 avril 2025
Description : Ce fichier contient le contrôleur d'authentification qui gère les fonctionnalités de connexion, d'inscription, et de déconnexion.
-->

<?php
require_once __DIR__ . '/../models/dbconnexion.php';
require_once __DIR__ . '/../models/auth_model.php';

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/*Affiche la page de connexion*/
function DisplayLogin()
{
    $error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    require __DIR__ . '/../views/login.php';
}

/*Affiche la page d'inscription*/
function DisplayRegister()
{
    $error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    require __DIR__ . '/../views/register.php';
}

/*Affiche la page du profil utilisateur*/
function DisplayProfile()
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login&error=notconnected');
        exit();
    }

    $db = DbConnexion();
    $user = GetUserById($db, $_SESSION['user_id']);

    require __DIR__ . '/../views/profile.php';
}

/*Traite la tentative de connexion*/
function HandleLogin()
{
    // Nettoyer et sécuriser les entrées
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        header('Location: ../index.php?page=login&error=emptyfields');
        exit();
    }

    $db = DbConnexion();
    $user = AuthenticateUser($db, $username, $password);

    if ($user) {
        // Démarrer la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Ajouter le rôle dans la session

        // Créer un cookie si l'option "Se souvenir de moi" est cochée
        if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
            $token = bin2hex(random_bytes(16));
            $expiry = time() + (30 * 24 * 60 * 60); // 30 jours

            // Stockage sécurisé du token (en production, utilisez un stockage plus sécurisé)
            setcookie('auth_token', $token, $expiry, '/', '', true, true);
            $_SESSION['auth_token'] = $token;
        }

        header('Location: ../index.php?page=home');
        exit();
    } else {
        header('Location: ../index.php?page=login&error=wrongcredentials');
        exit();
    }
}

/*Traite l'inscription d'un nouvel utilisateur*/
function HandleRegister()
{
    // Nettoyer et sécuriser les entrées
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($password) || empty($confirmPassword)) {
        header('Location: ../index.php?page=register&error=emptyfields');
        exit();
    }

    if ($password !== $confirmPassword) {
        header('Location: ../index.php?page=register&error=passwordmismatch');
        exit();
    }

    $db = DbConnexion();

    // Vérifier si le nom d'utilisateur existe déjà
    if (UsernameExists($db, $username)) {
        header('Location: ../index.php?page=register&error=usernametaken');
        exit();
    }

    // Inscrire l'utilisateur
    if (RegisterUser($db, $username, $password)) {
        header('Location: ../index.php?page=login&message=registered');
        exit();
    } else {
        header('Location: ../index.php?page=register&error=dberror');
        exit();
    }
}

/*Traite la déconnexion de l'utilisateur*/
function HandleLogout()
{
    // Détruire la session
    session_start();
    session_unset();
    session_destroy();

    // Supprimer le cookie d'authentification
    if (isset($_COOKIE['auth_token'])) {
        setcookie('auth_token', '', time() - 3600, '/');
    }

    header('Location: ../index.php?page=login&message=loggedout');
    exit();
}

/*Traite la suppression du compte utilisateur*/
function HandleDeleteAccount()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../index.php?page=login&error=notconnected');
        exit();
    }

    $db = DbConnexion();
    if (DeleteUserAccount($db, $_SESSION['user_id'])) {
        // Déconnexion après suppression
        session_unset();
        session_destroy();

        if (isset($_COOKIE['auth_token'])) {
            setcookie('auth_token', '', time() - 3600, '/');
        }

        header('Location: ../index.php?page=register&message=accountdeleted');
        exit();
    } else {
        header('Location: ../index.php?page=profile&error=deleteerror');
        exit();
    }
}

// Si ce fichier est appelé directement, déterminer quelle action effectuer
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_GET['action'] ?? '';

        switch ($action) {
            case 'login':
                HandleLogin();
                break;
            case 'register':
                HandleRegister();
                break;
            case 'delete_account':
                HandleDeleteAccount();
                break;
            default:
                header('Location: ../index.php');
                exit();
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $action = $_GET['action'] ?? '';

        if ($action === 'logout') {
            HandleLogout();
        } else {
            header('Location: ../index.php');
            exit();
        }
    }
}
?>