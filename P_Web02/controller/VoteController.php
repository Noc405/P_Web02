<?php
/**
 * ETML
 * Auteur : Noah Favre
 * Date: 11.04.2022
 * Controller for show a book with his details and rate it
 */

include_once ("data/database.php");

class VoteController extends Controller {

    /**
     * Choose the action to do
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        // Call a method in this class
        try {
            return call_user_func(array($this, $action));
        } catch (\Throwable $th) {
            return call_user_func(array($this, "voteBookAction"));
        }

    }

    /**
     * Add a votation and a comment on a book
     *
     * @return string
     */
    private function VoteBookAction() {
        // Charge le fichier pour la vue
        $view = file_get_contents('view/page/voteBook/voteBook.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

        /**
     * Add a votation and a comment on a book
     *
     * @return string
     */
    private function checkVoteBookAction() {
                
        $database = new database();
        
        if(isset($_GET['idBook'])){
           if(isset($_POST["btnSubmit"]))
           {
               if(preg_match('/^([1-5]|[1-4]\.5){1}$/', $_POST["notMark"]))
               {
                    $database->voteBook($_POST['notMark'], $_POST['notCommentary'], $_GET['idBook'], $_SESSION['id']);
               }
               else{
                    header("Location:index.php?controller=vote&action=voteBook&idBook=" . $_GET['idBook'] . "&error=1");
               }
           }
        }
        header("Location:index.php?controller=detailsBook&action=detailOneBook&idBook=".$_GET['idBook']);
    }
}