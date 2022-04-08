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
        // Set the model and get the informations
        $database = new database();
        $books = $database->getAllBooks();
        $_SESSION['allBooks'] = $books;

        // Load the view file
        $view = file_get_contents('view/page/browse/list.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}