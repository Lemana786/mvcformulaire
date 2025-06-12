<!--
Fichier : admin_model.php
Auteur : Léane DEVILLE
Date de création : 13 avril 2025
Description : Ce fichier contient les fonctions de gestion des utilisateurs, notamment la gestion des roles (admin et utilisateur) et des données en ce qui concerne les roles.
-->

<?php
/**
 * -- Récupère tous les utilisateurs de la base de données --
 * 
 * @param PDO $db           //La connexion à la base de données
 * @return array            //Les utilisateurs récupérés de la base de données
 */
function GetAllUsers($db)
{
    $sql = "SELECT id, username, role, created_at FROM users ORDER BY id ASC";
    $statement = $db->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * -- Change le rôle d'un utilisateur --
 * 
 * @param PDO $db           //La connexion à la base de données
 * @param int $userId       //L'ID de l'utilisateur
 * @param string $newRole   //Le nouveau rôle ('admin' ou 'user')
 * @return bool             //Le résultat de l'opération
 */
function ChangeUserRole($db, $userId, $newRole)
{
    if ($newRole !== 'admin' && $newRole !== 'user') {
        return false;
    }
    
    $sql = "UPDATE users SET role = ? WHERE id = ?";
    $statement = $db->prepare($sql);
    return $statement->execute([$newRole, $userId]);
}
?>