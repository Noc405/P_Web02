<?php

/** 
 * Auteur : Sean Ford
 * Date : 28.02.2022
 * Description : Connexion à la base de donnée
 */
include_once 'userInfos/userInfos.php';

class Database {


    // Class Variables
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
            $this->connector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "PDOError: " . $e->getMessage()." In ".__FILE__;
        }
    }

    /**
     * Do the simple request (without binds)
     */
    private function querySimpleExecute($query){

        $req = $this -> connector->prepare($query);
        $req->execute();
        return $req;
    }

    /**
     *Do the prepare request (with the binds)
     */
    private function queryPrepareExecute($query, $binds){

        $req = $this -> connector->prepare($query);
        foreach($binds as $key => $bind){
            $req -> bindValue($key, $bind['value'], $bind['type']);
        }
        $req->execute();

        return $req;
    }

    /**
     * Format the data in a associativ array
     */
    private function formatData($req){

        $result = $req->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Destory a data
     */
    private function unsetData($req){

        $req->closeCursor();
    }

    /**
     * Get all the books
     */
    public function getAllBooks(){
        // Get all the books
        $sql = "SELECT * FROM t_book 
        INNER JOIN t_author on t_book.fkAuthor = t_author.idAuthor
        INNER JOIN t_editor on t_book.fkEditor = t_editor.idEditor
        INNER JOIN t_category on t_book.fkCategory = t_category.idCategory";

        // Execute the request
        $rep = $this ->querySimpleExecute($sql);
        
        // Format the result to an array
        $getBookInfo = $this -> formatData($rep);

        // Return the array
        return $getBookInfo;
    }

    /**
     * Get all the name of a book
     */
    public function getAllBooksName(){
        // Get the books name
        $sql ='SELECT booTitle FROM t_book';

        // Execute the request
        $rep = $this ->querySimpleExecute($sql);

        // Format to an array the returned variable
        $getBookInfo = $this -> formatData($rep);

        // Return the array
        return $getBookInfo;
    }

    /**
     * Get the informations of a book with the id
     */
    public function getBookInfoWithId($id){
        //Request for get the bok with an id
        $sql = "SELECT * FROM t_book 
        INNER JOIN t_author on t_book.fkAuthor = t_author.idAuthor
        INNER JOIN t_editor on t_book.fkEditor = t_editor.idEditor
        INNER JOIN t_category on t_book.fkCategory = t_category.idCategory
        INNER JOIN t_user on t_book.fkUser = t_user.idUser  
        WHERE idBook = :varId";

        // Array with the binds values
        $binds = array(
            "varId" => array(
                "value" => $id,
                "type" => PDO::PARAM_INT
            )
        );

        // Do the prpare request
        $rep = $this -> queryPrepareExecute($sql, $binds);
        
        // Format to an array the returned variable
        $getOneBook = $this -> formatData($rep);

        return $getOneBook;
    }

    /**
     * Get the informations of a book with the title
     */
    public function getBookInfoWithTitle($title){
        
        // Request for get the informations of a book with the title
        $queryRequest = "SELECT idBook FROM t_book WHERE booTitle = :title";
        
        // Array with binds
        $binds = array(
            "title" => array(
                "value" => $title,
                "type" => PDO::PARAM_INT
            )
        );
        
        // Do the prpare request
        $rep = $this->queryPrepareExecute($queryRequest, $binds);
        
        // Format to an array the returned variable
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

    /**
     * Get a user with his email
     */
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

    /**
     * Show note
    */
    public function getAllNote($id){
        // Vote the book that have the same id than $id
        $queryRequest = "SELECT * FROM t_note WHERE fkBook = :id";
        // Set an array with the binds values
        $binds = array(
            "id" => array(
                "value" => $id,
                "type" => PDO::PARAM_INT)
        );
        // Execute the request
        $rep = $this ->queryPrepareExecute($queryRequest, $binds);
        //Set an array with the query return
        $getAllNote = $this -> formatData($rep);
        // return the array
        return $getAllNote;
    }

    /**
     * Delete a book
    */
    public function deleteBook($id){
        // Delete the book that have the same id than $id
        $queryRequest = "DELETE FROM t_book WHERE 'idBook'= :id";
        // Set an array with the binds values
        $binds = array (
            "id" => array(
                "value" => $id,
                "type" => PDO::PARAM_INT)
            );
        // Execute the request
        $rep = $this ->queryPrepareExecute($queryRequest, $binds);
    }

    /**
     * Vote a book
    */
    public function voteBook($mark, $commentary, $id){
        // Vote the book that have the same id than $id
        $queryRequest = "INSERT INTO t_note (notMark, notCommentary, fkBook) 
        VALUES (:mark, :commentary, :id)";

        // Set an array with the binds values
        $binds = array (
            "mark" => array("value" => $mark, "type" => PDO::PARAM_INT),
            "commentary" => array("value" => $commentary, "type" => PDO::PARAM_STR),
            "id" => array("value" => $id,"type" => PDO::PARAM_INT)
            );
        // Execute the request
        $rep = $this ->queryPrepareExecute($queryRequest, $binds);
    }
}
?>