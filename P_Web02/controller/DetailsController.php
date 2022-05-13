<?php
/**
 * ETML
 * Auteur : Noah Favre
 * Date: 11.04.2022
 * Controller for show a book with his details and rate it
 */

include_once ("data/database.php");

class DetailsController extends Controller {

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
            return call_user_func(array($this, "detailOneBookAction"));
        }

    }

    /**
     * Get the book info and load the view
     *
     * @return string
     */
    private function detailOneBookAction() {
        //Unset the sessions of the marks
        unset($_SESSION['average']);
        unset($_SESSION['nbComments']);

        // Set the model and get the informations of one book
        $database = new database();
        
        if(isset($_GET['idBook'])){
            $books = $database->getBookInfoWithId($_GET['idBook']);

            $addDateWithoutHour = substr($books[0]['booAddDate'], 0, -9);
            $addDateBook = explode('-', $addDateWithoutHour);
            $books[0]['booAddDate'] = $addDateBook;

            $_SESSION['book'] = $books;

            $allNote = $database->getBookNotes($_GET['idBook']);
            
            if($allNote){
                $nbComment = 0;
                $sommeMarks = 0;
                foreach ($allNote as $key => $value) {
                    $nbComment += 1;
                    $sommeMarks += $allNote[$key]['notMark'];
                }
                $averageWithoutRound = $sommeMarks / count($allNote);
                $average = round($averageWithoutRound, 1);

                $_SESSION['average'] = $average;
                $_SESSION['nbComments'] = $nbComment;
            }
        }

        // Charge le fichier pour la vue
        $view = file_get_contents('view/page/detailsBook/detailsBook.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}