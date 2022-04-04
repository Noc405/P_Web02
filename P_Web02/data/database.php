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
     * TODO: à compléter
     */
    public function getAllBooksName(){

        
        // TODO: avoir la requête sql
        $sql ='SELECT livTitle, autName FROM t_livre INNER JOIN t_author on t_livre.fkAuthor = t_author.IDauthor';
        // TODO: appeler la méthode pour executer la requête
        $rep = $this ->querySimpleExecute($sql);
        // TODO: appeler la méthode pour avoir le résultat sous forme de tableau
        $getBookInfo = $this -> formatData($rep);
        // TODO: retour tous les enseignants
        return $getBookInfo;
    }

    /**
     *Récupère la liste des informations pour 1 enseignant
     */
    public function getBookInfo($id){

        $binds = array(
            "varId" => array(
                "value" => $id,
                "type" => PDO::PARAM_INT
            )
        );
        // TODO: récupère la liste des informations pour 1 enseignant
        // TODO: avoir la requête sql pour 1 enseignant (utilisation de l'id)
        $sql = "SELECT * FROM t_livre INNER JOIN t_author on t_livre.fkAuthor = t_author.IDauthor WHERE IDlivre = :varId";

  
        // TODO: appeler la méthode pour executer la requête
        $rep = $this -> queryPrepareExecute($sql, $binds);
        // TODO: appeler la méthode pour avoir le résultat sous forme de tableau
        $getOneTeacher = $this -> formatData($rep);
        // TODO: retour l'enseignant
        return $getOneTeacher;
    }

    /**
     * Insert a user to the database
     */
    public function insertUser($email, $password, $username){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $queryRequest = "INSERT INTO `t_users` (`useEmail`, `usePassword`, `useUsername`, `useAge`)
        VALUES (:email, :password, :username);";
        // Set an array with the binds values
        $binds = array(
            "email" => array("value" => $email, "type" => PDO::PARAM_STR),
            "password" => array("value" => $password, "type" => PDO::PARAM_STR),
            "username" => array("value" => $username, "type" => PDO::PARAM_STR),
        );
        // Insert the user
        $this->queryPrepareExecute($queryRequest, $binds);
    }

    public function getAllUser(){
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $queryRequest = "SELECT * FROM t_users";
        // Set an array with the binds values
       $rep = $this ->querySimpleExecute($queryRequest);
       // TODO: appeler la méthode pour avoir le résultat sous forme de tableau
       $getAllUser = $this -> formatData($rep);
       // TODO: retour tous les enseignants
       return $getAllUser;
    }

    public function getAllUserByEmail($email){

        $binds = array(
            "varemail" => array(
                "value" => $email,
                "type" => PDO::PARAM_STR
            )
        );
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $queryRequest = "SELECT * FROM t_users WHERE IDlivre = :varId";
        // Set an array with the binds values
       $rep = $this ->querySimpleExecute($queryRequest);
       // TODO: appeler la méthode pour avoir le résultat sous forme de tableau
       $getAllUser = $this -> formatData($rep);
       // TODO: retour tous les enseignants
       return $getAllUser;
    }

    public function AddComment($remarque){

        $binds = array(
            "varemail" => array(
                "value" => $remarque,
                "type" => PDO::PARAM_STR
            )
        );
        // Recover the id, the firstname, the name and the nickname of all the teachers 
        $queryRequest = "SELECT * FROM t_users WHERE IDlivre = :varId";
        // Set an array with the binds values
       $rep = $this ->querySimpleExecute($queryRequest);
       // TODO: appeler la méthode pour avoir le résultat sous forme de tableau
       $getAllUser = $this -> formatData($rep);
       // TODO: retour tous les enseignants
       return $getAllUser;
    }
}
?>