<!--
Fichier : auth_model.php
Auteur : Léane DEVILLE
Date de création : 07 avril 2025
Description : Ce fichier contient les fonctions de gestion des utilisateurs, notamment l'inscription, la connexion et la vérification des données d'authentification.
-->

<?php
/**
 * -- Vérifie si un nom d'utilisateur existe déjà --
 * 
 * @param PDO $db         //La connexion à la base de données
 * @param string $username //Le nom d'utilisateur à vérifier
 * @return bool           //True si le nom d'utilisateur existe, sinon false
 */
function UsernameExists($db, $username)
{
    $username = trim($username); // Nettoyer les espaces
    if (empty($username)) {
        return false;
    }
    
    $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
    $statement = $db->prepare($sql);
    $statement->execute([$username]);
    return $statement->fetchColumn() > 0;
}

/**
 * -- Inscrit un nouvel utilisateur --
 * 
 * @param PDO $db           //La connexion à la base de données
 * @param string $username   //Le nom d'utilisateur
 * @param string $password   //Le mot de passe
 * @return bool             //Le résultat de l'opération
 */
function RegisterUser($db, $username, $password, $role = 'user')
{
    // Générer un sel aléatoire
    $salt = bin2hex(random_bytes(16));
    
    // Hasher le mot de passe avec bcrypt
    $hashedPassword = password_hash($password . $salt, PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO users (username, password, salt, role) VALUES (?, ?, ?, ?)";
    $statement = $db->prepare($sql);
    return $statement->execute([$username, $hashedPassword, $salt, $role]);
}

/**
 * -- Authentifie un utilisateur --
 * 
 * @param PDO $db           //La connexion à la base de données
 * @param string $username   //Le nom d'utilisateur
 * @param string $password   //Le mot de passe
 * @return array|false      //Les données de l'utilisateur ou false
 */
function AuthenticateUser($db, $username, $password)
{
    $sql = "SELECT id, username, password, salt, role FROM users WHERE username = ?";
    $statement = $db->prepare($sql);
    $statement->execute([$username]);
    $user = $statement->fetch();
    
    if ($user && password_verify($password . $user['salt'], $user['password'])) {
        return $user;
    }
    
    return false;
}

/**
 * -- Récupère un utilisateur par son ID --
 * 
 * @param PDO $db         //La connexion à la base de données
 * @param int $userId     //L'identifiant de l'utilisateur
 * @return array|false    //Les données de l'utilisateur ou false
 */
function GetUserById($db, $userId)
{
    $sql = "SELECT id, username, role, created_at FROM users WHERE id = ?";
    $statement = $db->prepare($sql);
    $statement->execute([$userId]);
    return $statement->fetch();
}

/**
 * -- Supprime un compte utilisateur et ses données associées --
 * 
 * @param PDO $db         //La connexion à la base de données
 * @param int $userId     //L'identifiant de l'utilisateur
 * @return bool           //Le résultat de l'opération
 */
function DeleteUserAccount($db, $userId)
{
    // Mettre à jour les livres où cet utilisateur est créateur
    $sql1 = "UPDATE books SET creator_id = NULL WHERE creator_id = ?";
    $statement1 = $db->prepare($sql1);
    $statement1->execute([$userId]);
    
    // Supprimer l'utilisateur
    $sql2 = "DELETE FROM users WHERE id = ?";
    $statement2 = $db->prepare($sql2);
    return $statement2->execute([$userId]);
}

/**
 * -- Vérifie si un utilisateur est administrateur --
 * 
 * @param array $user     //Les données de l'utilisateur
 * @return bool           //True si l'utilisateur est administrateur, sinon false
 */
function IsAdmin($user)
{
    return isset($user['role']) && $user['role'] === 'admin';
}


?>