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

        // Set the model and get the informations of one book
        
        $database = new database();
        
        if(isset($_GET['idBook'])){
            $books = $database->getBookInfoWithId($_GET['idBook']);

            //
            $addDateWithoutHour = substr($books[0]['booAddDate'], 0, -9);
            $addDateBook = explode('-', $addDateWithoutHour);
            $books[0]['booAddDate'] = $addDateBook;

            $_SESSION['book'] = $books;
        }

        // Charge le fichier pour la vue
        $view = file_get_contents('view/page/detailsBook/detailsBook.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}