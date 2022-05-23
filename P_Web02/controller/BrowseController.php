<?php
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 08.04.2022
 * Controller for show all the books
 */

include_once ("data/database.php");

class BrowseController extends Controller {

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
            return call_user_func(array($this, "listBookAction"));
        }
    }

    /**
     * Get all the books and show the pages
     *
     * @return string
     */
    private function listBookAction() {
        $database = new database();

        if(isset($_GET['search'])){
            //Get the information of the searched book
            $books = $database->searchBook(htmlspecialchars($_GET['search']));
        }else{            
            //Get the informations of all books
            $books = $database->getAllBooks();
        }
        $_SESSION['allBooks'] = $books;
        
        //Get the number of the reviews
        foreach ($books as $key => $value) { 
            $notes = $database->getBookNotes($books[$key]['idBook']);
            $_SESSION['numberComments'][$key] = count($notes);
        }
        
        
        // Load the view file
        $view = file_get_contents('view/page/browse/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}