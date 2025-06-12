<!--
Fichier : dbConnexion.php
Auteur : Léane DEVILLE
Date de création : 10 février 2025
Description : Ce fichier contient la fonction `DbConnexion()` qui établit une connexion à la base de données en utilisant PDO. 
Elle permet à l'application de se connecter à la base de données MySQL et retourne l'objet PDO nécessaire pour interagir avec 
la base de données. En cas d'échec de la connexion, une exception est lancée et un message d'erreur est affiché.
-->


<?php
/**
 * -- Établit une connexion à la base de données --
 * 
 * @return PDO //L'objet de connexion à la base de données
 */
function DbConnexion()
{
    try {
        // -- Remplacez les valeurs par les informations de votre base de données --
        $db = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        die();
    }
}
?>