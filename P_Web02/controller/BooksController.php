<?php
/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controller for the actions of the books (delete, modify, add, etc..)
 */

include_once ("data/database.php");

class BooksController extends Controller {

    /**
     * Permet de choisir l'action à effectuer
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        // Appelle une méthode dans cette classe (ici, ce sera le nom + action (ex: listAction, detailAction, ...))
        return call_user_func(array($this, $action));
    }

    /**
     * Get the form to add a new book
     *
     * @return string
     */
    private function addBooksAction() {
        $database = new Database();
        //Get all the authors
        $authors = $database->getAllAuthors();
        //Get all the category
        $categories = $database->getAllCategories();
        //Get all the Editors
        $editors = $database->getAllEditors();

        //Set the session variables
        $_SESSION['authors'] = $authors;
        $_SESSION['categories'] = $categories;
        $_SESSION['editors'] = $editors;

        //Charge the view file
        $view = file_get_contents('view/page/books/addBook.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Check the book informations for add it
     *
     */
    private function checkAddBookAction(){
        $database = new Database();

        if(isset($_POST['btnSubmit'])){

            $books = $database->getAllBooksName();

            foreach ($books as $key => $value) {
                //Check if a book has the same name
                if($books[$key]['booTitle'] == $_POST['title']){
                    header("Location:index.php?controller=books&action=addBooks&error=2");
                }
            }
            $_SESSION['addedBook'] = $_POST;
            
            header("Location:index.php?controller=books&action=addBooksImageAndExtract");
        }
    }

    /**
     * Load te page for add the book image and extract
     *
     * @return string
     */
    private function addBooksImageAndExtractAction(){
        //Charge the view file
        $view = file_get_contents('view/page/books/addBookImageAndExtract.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Check the book image and extract
     *
     */
    private function checkAddBookImagesAndExtractAction(){
        $database = new Database();
        
        $resultat = array();

        if(isset($_POST['btnSubmit'])){
            extract($_POST);

            $bookInfos = $database->getBookInfoWithTitle($_SESSION['addedBook']['title']);

            //Check if the user set the picture file
            if(isset($_FILES['picture']) && !empty($_FILES['picture']['name']))
            {
                //Set the max size and the good extentions
                $maxSize = 2097152;
                $extentionsValides = array('jpg', 'jpeg', 'gif', 'png');

                //Check if the uploaded file have the good size
                if($_FILES['picture']['size'] <= $maxSize)
                {
                    //Get the extention of the uploaded fil 
                    $extentionUpload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));
                    //Check if the extention is valid
                    if(in_array($extentionUpload, $extentionsValides))
                    {
                        //Set the path of the file
                        $path = 'resources/booksImage/'.$bookInfos[0]['idBook'].".".$extentionUpload;
                        //Set the picture
                        $picture = $bookInfos[0]['idBook'].".".$extentionUpload;
                        //Move the file to the path
                        $resultat[0] = move_uploaded_file($_FILES['picture']['tmp_name'], $path);
                    }
                    else
                    {
                        //Picture as not the good extention
                    }
                }
                else
                {
                    //Picture is to fat
                }
            }

            //Check if the user set the pdf fil 
            if(isset($_FILES['extract']) && !empty($_FILES['extract']['name']))
            {
                //Set the max size and the good extentions
                $maxSize = 2097152;
                $extentionsValides = array('pdf');

                //Check if the uploaded file have the good size
                if($_FILES['extract']['size'] <= $maxSize)
                {
                    //Get the extention of the uploaded fil 
                    $extentionUpload = strtolower(substr(strrchr($_FILES['extract']['name'], '.'), 1));
                    //Check if the extention is valid
                    if(in_array($extentionUpload, $extentionsValides))
                    {
                        //Set the path of the file
                        $path = 'resources/booksExtract/'.$bookInfos[0]['idBook'].".".$extentionUpload;
                        //Set the PDF
                        $PDF = $bookInfos[0]['idBook'].".".$extentionUpload;
                        //Move the file to the path
                        $resultat[1] = move_uploaded_file($_FILES['extract']['tmp_name'], $path);
                    }
                    else
                    {
                        //PDF has not the good extention
                    }
                }
                else
                {
                    //PDF is too fat
                }
            }


            //If the files have been moved, insert the book in the db
            if($resultat[0] && $resultat[1])
            {
                //Insert the book
                $database->insertBook($_SESSION['addedBook']['title'], $picture, $_SESSION['addedBook']['nbPages'],  $PDF, $_SESSION['addedBook']['abstract'], $_SESSION['addedBook']['date'], $_SESSION['addedBook']['author'], $_SESSION['addedBook']['category'], $_SESSION['addedBook']['editor'], $_SESSION['id']);

                header('Location:index.php?controller=home&action=home');
            }
            else
            {
                //Error on importation
            }
        }
    }
}