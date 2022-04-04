<?php

/**
 * 
 * TODO : à compléter
 * 
 * Auteur : Sean Ford
 * Date : 28.02.2022
 * Description : Connexion à la base de donnée
 */
include_once 'userInfos/userInfos.php';

class Database {


    // Variable de classe
    private $connector;
    private $connexionValues;

    public function __construct(){
        //Get the values from the php file for the pdo
        $connexion = new connexionValues();
        $this->connexionValues = $connexion->getValues();

        //Get the value from the json file for the password
        $Json = file_get_contents("data/userInfos/passwords.json");
        // Converts to an array 
        $passwordArray = json_decode($Json, true);

        try {
            $dns = "mysql:host=".$this->connexionValues['host'].";dbname=".$this->connexionValues['dbname'].";charset=utf8";
            $this->connector = new PDO($dns, $this->connexionValues['user'], $passwordArray[0]['pass']);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "PDOError: " . $e->getMessage()." In ".__FILE__;
        }
    }

    /**
     * TODO: à compléter
     */
    private function querySimpleExecute($query){

        $req = $this -> connector->prepare($query);
        $req->execute();
        return $req;

        // TODO: permet de préparer et d’exécuter une requête de type simple (sans where)
    }

    /**
     * TODO: à compléter
     */
    private function queryPrepareExecute($query, $binds){

        $req = $this -> connector->prepare($query);
        foreach($binds as $key => $bind){
            $req -> bindValue($key, $bind['value'], $bind['type']);
        }
        $req->execute();

        return $req;
        
        // TODO: permet de préparer, de binder et d’exécuter une requête (select avec where ou insert, update et delete)
    }

    /**
     * TODO: à compléter
     */
    private function formatData($req){

        $result = $req->fetchALL(PDO::FETCH_ASSOC);
        return $result;

        // TODO: traiter les données pour les retourner par exemple en tableau associatif (avec PDO::FETCH_ASSOC)
    }

    /**
     * TODO: à compléter
     */
    private function unsetData($req){

        $req->closeCursor();

        // TODO: vider le jeu d’enregistrement
    }

    /**
     * Get all the name of a book
     */
    public function getAllBooksName(){

        
        // TODO: avoir la requête sql
        $sql ='SELECT booTitle FROM t_book';
        // TODO: appeler la méthode pour executer la requête
        $rep = $this ->querySimpleExecute($sql);
        // TODO: appeler la méthode pour avoir le résultat sous forme de tableau
        $getBookInfo = $this -> formatData($rep);
        // TODO: retour tous les enseignants
        return $getBookInfo;
    }

    /**
     * Get the informations of a book with the id
     */
    public function getBookInfoWithId($id){

        $binds = array(
            "varId" => array(
                "value" => $id,
                "type" => PDO::PARAM_INT
            )
        );

        $sql = "SELECT * FROM t_book 
        INNER JOIN t_author on t_book.fkAuthor = t_author.idAuthor
        INNER JOIN t_editor on t_book.fkEditor = t_editor.idEditor
        INNER JOIN t_category on t_book.fkAuthor = t_category.idCategory  
        WHERE idBook = :varId";

  
        $rep = $this -> queryPrepareExecute($sql, $binds);

        $getOneBook = $this -> formatData($rep);

        return $getOneBook;
    }

    /**
     * Get the informations of a book with the title
     */
    public function getBookInfoWithTitle($title){

        $binds = array(
            "title" => array(
                "value" => $title,
                "type" => PDO::PARAM_INT
            )
        );

        $queryRequest = "SELECT idBook FROM t_book WHERE booTitle = :title";

  
        $rep = $this->queryPrepareExecute($queryRequest, $binds);

        $getOneBook = $this->formatData($rep);

        return $getOneBook;
    }

    /**
     * Insert a book to the database
     */
    public function insertBook($title, $picture, $nbPage, $extract, $abstract, $date, $author, $categroy, $editor, $idUser){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $queryRequest = "INSERT INTO `t_book` (`idBook`, `booTitle`, `booPicture`, `booPage`, `booExtract`, `booAbstract`, `booDate`, `fkAuthor`, `fkCategory`, `fkEditor`, `fkUser`)
        VALUES (NULL, :title, :picture, :nbPage, :extract, :abstract, :date, :author, :category, :editor, :idUser);";
        // Set an array with the binds values
        $binds = array(
            "title" => array("value" => $title, "type" => PDO::PARAM_STR),
            "picture" => array("value" => $picture, "type" => PDO::PARAM_STR),
            "nbPage" => array("value" => $nbPage, "type" => PDO::PARAM_INT),
            "extract" => array("value" => $extract, "type" => PDO::PARAM_STR),
            "abstract" => array("value" => $abstract, "type" => PDO::PARAM_STR),
            "date" => array("value" => $date, "type" => PDO::PARAM_STR),
            "author" => array("value" => $author, "type" => PDO::PARAM_INT),
            "category" => array("value" => $categroy, "type" => PDO::PARAM_INT),
            "editor" => array("value" => $editor, "type" => PDO::PARAM_INT),
            "idUser" => array("value" => $idUser, "type" => PDO::PARAM_INT)
        );
        // Insert the user
        $this->queryPrepareExecute($queryRequest, $binds);
    }

    /**
     * Insert a user to the database
     */
    public function insertUser($email, $password, $username){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $queryRequest = "INSERT INTO `t_user` (`useMail`, `usePassword`, `useUsername`, `useVote`)
        VALUES (:email, :password, :username, :vote);";
        // Set an array with the binds values
        $binds = array(
            "email" => array("value" => $email, "type" => PDO::PARAM_STR),
            "password" => array("value" => $password, "type" => PDO::PARAM_STR),
            "username" => array("value" => $username, "type" => PDO::PARAM_STR),
            "vote" => array("value" => 0, "type" => PDO::PARAM_INT)
        );
        // Insert the user
        $this->queryPrepareExecute($queryRequest, $binds);
    }

    /**
     * Get all the users
     */
    public function getAllUser(){
        // Recover the id, the username and the password of all users
        $queryRequest = "SELECT * FROM t_user";
        $rep = $this ->querySimpleExecute($queryRequest);
        //Set an array with the query return
        $getAllUser = $this -> formatData($rep);
        // return the array
        return $getAllUser;
    }

    public function getAllUserByEmail($email){
        // Recover id, the username and the password for each user with the email as parameter
        $queryRequest = "SELECT * FROM t_user WHERE useMail = :email";
        // Set an array with the binds values
        $binds = array(
            "email" => array(
                "value" => $email,
                "type" => PDO::PARAM_STR
            )
        );
        //Execute the request
        $rep = $this->queryPrepareExecute($queryRequest, $binds);
        //Set an array with the result
        $getAllUser = $this->formatData($rep);
        //Return an array
        return $getAllUser;
    }

    /**
     * Get all the authors
     */
    public function getAllAuthors(){
        // Recover the id, the username and the password of all users
        $queryRequest = "SELECT * FROM t_author";
        $rep = $this ->querySimpleExecute($queryRequest);
        //Set an array with the query return
        $getAllAuthors = $this -> formatData($rep);
        // return the array
        return $getAllAuthors;
    }

    /**
     * Get all the categories
     */
    public function getAllCategories(){
        // Recover the id, the username and the password of all users
        $queryRequest = "SELECT * FROM t_category";
        $rep = $this ->querySimpleExecute($queryRequest);
        //Set an array with the query return
        $getAllCategories = $this -> formatData($rep);
        // return the array
        return $getAllCategories;
    }

    /**
     * Get all the editors
     */
    public function getAllEditors(){
        // Recover the id, the username and the password of all users
        $queryRequest = "SELECT * FROM t_editor";
        $rep = $this ->querySimpleExecute($queryRequest);
        //Set an array with the query return
        $getAllEditors = $this -> formatData($rep);
        // return the array
        return $getAllEditors;
    }
}
?>