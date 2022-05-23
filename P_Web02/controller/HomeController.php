<?php
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 08.04.2022
 * Controller for the home page
 */

class HomeController extends Controller {

    /**
     * Dispatch current action
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        // Call a method in this class
        try {
            return call_user_func(array($this, $action));
        } catch (\Throwable $th) {
            return call_user_func(array($this, "homeAction"));
        }
    }

    /**
     * Display Index Action
     *
     * @return string
     */
    private function homeAction() {
        // Set the model and get the informations
        $database = new database();
        $books = $database->getAllBooks();

        //Sort the array with the last added book in first
        usort($books, 'DescSort');
        
        $_SESSION['allBooks'] = $books;
        
        //Get the number of the reviews
        for ($i=0; $i < 5; $i++) { 
            $notes = $database->getBookNotes($books[$i]['idBook']);
            $_SESSION['numberComments'][$i] = count($notes);
        }

        $view = file_get_contents('view/page/home/home.php');
        
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        
        return $content;
    }
}

// Function for order the books
function DescSort($firstItem,$secondItem)
{
    $firstDatetime = strtotime($firstItem['booAddDate']);
    $secondDatetime = strtotime($secondItem['booAddDate']);
    return $secondDatetime - $firstDatetime;
}