<!--
Fichier : model.php
Auteur : Léane DEVILLE
Date de création : 10 février 2025
Description : Il est responsable des interactions avec les données. Ce modèle contient des fonctions qui 
manipulent les donnéesn et effectuent des opérations liées à la base de données
-->

<?php
/**
 * -- Récupère tous les livres de la base de données --
 * 
 * @param PDO $db           //La connexion à la base de données
 * @return array            //Les livres récupérés de la base de données
 */
function GetBooks($db)
{
    $sql = "SELECT books.*, users.username as creator_name 
            FROM books 
            LEFT JOIN users ON books.creator_id = users.id";
    $statement = $db->prepare($sql);
    if ($statement->execute()) {
        return $statement->fetchAll();
    } else {
        echo "Erreur avec la base de données";
        return [];
    }
}

/**
 * -- Récupère un livre spécifique de la base de données --
 * 
 * @param PDO $db           //La connexion à la base de données
 * @param int $id           //L'identifiant du livre à récupérer
 * @return array|false      //Les données du livre ou false en cas d'erreur
 */
function GetBook($db, $id)
{
    $sql = "SELECT * FROM books WHERE id = ?";
    $statement = $db->prepare($sql);
    if ($statement->execute([$id])) {
        return $statement->fetch();
    } else {
        echo "Erreur avec l'identifiant du livre";
        return false;
    }
}

/**
 * -- Ajoute un livre dans la base de données --
 * 
 * @param PDO $db           //La connexion à la base de données
 * @param array $data       //Les données du livre à ajouter
 * @return bool             //Le résultat de l'opération
 */
function AddBook($db, $data)
{
    $sql = "INSERT INTO books (name, author, year, summary, creator_id) VALUES (?, ?, ?, ?, ?)";
    $statement = $db->prepare($sql);
    $creatorId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    return $statement->execute([
        $data['newBook_name'], 
        $data['newBook_author'], 
        $data['newBook_year'], 
        $data['newBook_summary'],
        $creatorId
    ]);
}

/**
 * -- Modifie un livre dans la base de données --
 * 
 * @param PDO $db           //La connexion à la base de données
 * @param array $data       //Les données du livre à modifier
 * @return bool             //Le résultat de l'opération
 */
function ModifyBook($db, $data)
{
    $sql = "UPDATE books SET name = ?, author = ?, year = ?, summary = ? WHERE id = ?";
    $statement = $db->prepare($sql);
    return $statement->execute([$data['chgBook_name'], $data['chgBook_author'], $data['chgBook_year'], $data['chgBook_summary'], $data['book_id']]);
}

/**
 * -- Supprime un livre de la base de données --
 * 
 * @param PDO $db           //La connexion à la base de données
 * @param array $data       //Les données contenant l'ID du livre à supprimer
 * @return bool             //Le résultat de l'opération
 */
function DeleteBook($db, $data)
{
    $bookId = filter_var($data['book_id'], FILTER_VALIDATE_INT);
    if (!$bookId) {
        return false;
    }
    
    $sql = "DELETE FROM books WHERE id = ?";
    $statement = $db->prepare($sql);
    return $statement->execute([$bookId]);
}
?>