<?php

/**
 * 
 * TODO : à compléter
 * 
 * Auteur : Sean Ford
 * Date : 28.02.2022
 * Description : Connexion à la base de donnée
 */

 class Database {


    // Variable de classe
    private $connector;
   

    public function __construct(){

        try
        {
            $this -> connector = new PDO('mysql:host=localhost;dbname=db_books;charset=utf8,root, root');
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
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
            $req -> bindValue($key,$bind['value'],$bind['type']);
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
        $$getBookInfo = $this -> formatData($rep);
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


    public function addTeacher($gender,$firstname,$lastname,$surname,$origin,$section){

        $binds = array(
            "varName" => array(
                "value" => $firstname,
                "type" => PDO::PARAM_STR
            ),
            "varSurname" => array(
                "value" => $surname,
                "type" => PDO::PARAM_STR
            ),
            "varLastname" => array(
                "value" => $lastname,
                "type" => PDO::PARAM_STR
            ),
            "varOrigin" => array(
                "value" => $origin,
                "type" => PDO::PARAM_STR
            ),
            "varGender" => array(
                "value" => $gender,
                "type" => PDO::PARAM_STR
            ),
            "varSection" => array(
                "value" => $section,
                "type" => PDO::PARAM_INT
            )
        );

        $sql ="INSERT INTO t_teacher (teaFirstname, teaName, teaNickname,teaGender, teaOrigine, fkSection)
        VALUES (:varName, :varLastname, :varSurname,:varGender,:varOrigin,:varSection )";

        // TODO: appeler la méthode pour executer la requête
        $rep = $this -> queryPrepareExecute($sql, $binds);

        return $rep;

    }

    public function modifyTeacher($gender,$firstname,$lastname,$surname,$origin,$section){

        $binds = array(
            "varName" => array(
                "value" => $firstname,
                "type" => PDO::PARAM_STR
            ),
            "varSurname" => array(
                "value" => $surname,
                "type" => PDO::PARAM_STR
            ),
            "varLastname" => array(
                "value" => $lastname,
                "type" => PDO::PARAM_STR
            ),
            "varOrigin" => array(
                "value" => $origin,
                "type" => PDO::PARAM_STR
            ),
            "varGender" => array(
                "value" => $gender,
                "type" => PDO::PARAM_STR
            ),
            "varSection" => array(
                "value" => $section,
                "type" => PDO::PARAM_INT
            )
        );


    }

    public function deleteTeacher($id){
        $sql = "DELETE FROM t_teacher WHERE idTeacher =$id";
        $rep = $this -> querySimpleExecute($sql);
    }
    // + tous les autres méthodes dont vous aurez besoin pour la suite (insertTeacher ... etc)

}
?>