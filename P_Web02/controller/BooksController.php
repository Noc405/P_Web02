<?php
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 08.04.2022
 * Controller for do some actions in the books
 */

 //Import the database file
include_once ("data/database.php");

class BooksController extends Controller {

    /**
     * Choose the action to do
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        //Call a method in this class
        //If the method doesn't exits, call a method that exits
        try {
            return call_user_func(array($this, $action));
        } catch (\Throwable $th) {
            return call_user_func(array($this, "addBooksAction"));
        }
    }
    
    /**
     * Get the infos for the form and show the edit book page
     *
     * @return string
     */
    private function editBookAction() {
        $database = new Database();
        //Get all the authors
        $authors = $database->getAllAuthors();
        //Get all the category
        $categories = $database->getAllCategories();
        //Get all the Editors                  
        $editors = $database->getAllEditors(); 
        // Get book info 
        if(isset($_GET['idBook'])){
            $books = $database->getBookInfoWithId($_GET['idBook']);
        }

        //Set the session variables
        $_SESSION['authors'] = $authors;
        $_SESSION['categories'] = $categories;
        $_SESSION['editors'] = $editors;
        $_SESSION['bookInfos'] = $books;

        //Charge the view file
        $view = file_get_contents('view/page/books/editBook.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Check the book informations for edit it
     *
     */
    private function checkEditBookAction(){
        $database = new Database();

        if(isset($_POST['btnSubmit'])){
            $_SESSION['editedBook'] = $_POST;
            unset($_SESSION['bookInfos']);

            //Go to the second page of the edit action (add the image and the extracts)
            header("Location:index.php?controller=books&action=editBooksImageAndExtract&idBook=".$_GET['idBook']);
        }
    }

    /**
     * Load the page for edit the book image and extract
     *
     * @return string
     */
    private function editBooksImageAndExtractAction(){
        //Charge the view file
        $view = file_get_contents('view/page/books/editBookImageAndExtract.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Check the image and extract books for edit a book
     *
     * @return string
     */
    private function checkEditBookImagesAndExtractAction(){
        $database = new Database();
        if(isset($_POST['btnSubmit'])){
            //Check if the user set the picture file
            if(isset($_FILES['picture']) && !empty($_FILES['picture']['name']))
            {
                //Set the max size and the good extentions
                $maxSize = 2097152;
                $extentionsValides = array('jpg', 'jpeg', 'gif', 'png');

                //Check if the uploaded file have the good size
                if($_FILES['picture']['size'] <= $maxSize)
                {
                    //Get the extention of the uploaded file
                    $extentionUpload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));
                    //Check if the extention is valid
                    if(in_array($extentionUpload, $extentionsValides))
                    {
                        //Replace the space and the specials chars by the "_"
                        $pictureName = str_replace(" ", "_", $_SESSION['addedBook']['title']);
                        $pictureName = str_replace("'", "_", $_SESSION['addedBook']['title']);
                        $pictureName = str_replace(":", "_", $_SESSION['addedBook']['title']);

                        //Set the path of the file
                        $path = 'resources/booksImage/'.$pictureName.".".$extentionUpload;
                        //Set the picture
                        $picture = $pictureName.".".$extentionUpload;
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

            //Check if the user set the pdf file
            if(isset($_FILES['extract']) && !empty($_FILES['extract']['name']))
            {
                //Set the max size and the good extentions
                $maxSize = 2097152;
                $extentionsValides = array('pdf');

                //Check if the uploaded file have the good size
                if($_FILES['extract']['size'] <= $maxSize)
                {
                    //Get the extention of the uploaded file
                    $extentionUpload = strtolower(substr(strrchr($_FILES['extract']['name'], '.'), 1));
                    //Check if the extention is valid
                    if(in_array($extentionUpload, $extentionsValides))
                    {
                        //Replace the space and the specials chars by the "_"
                        $PDFName = str_replace(" ", "_", $_SESSION['addedBook']['title']);
                        $PDFName = str_replace("'", "_", $_SESSION['addedBook']['title']);
                        $PDFName = str_replace(":", "_", $_SESSION['addedBook']['title']);

                        //Set the path of the file
                        $path = 'resources/booksExtract/'.$PDFName.".".$extentionUpload;
                        //Set the PDF
                        $PDF = $PDFName.".".$extentionUpload;
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

            if(isset($resultat)){
                //If the files have been moved, edit the book in the db
                if($resultat[0] || $resultat[1])
                {
                    //Check that all the informations of the part ona are good 
                    if(preg_match('/^([a-z]|[A-Z]|[0-9]|\-|\s|\'|.)+$/', $_SESSION['editedBook']['title']) && 
                    preg_match('/^[0-9]+$/', $_SESSION['editedBook']['nbPages']) && 
                    preg_match('/^.+$/', $_SESSION['editedBook']['abstract']) && 
                    preg_match('/^[0-9]{4}$/', $_SESSION['editedBook']['date']) && 
                    preg_match('/^[0-9]+$/', $_SESSION['editedBook']['author']) && 
                    preg_match('/^[0-9]+$/', $_SESSION['editedBook']['category']) && 
                    preg_match('/^[0-9]+$/', $_SESSION['editedBook']['editor']))
                    {
                        //Get the pdf and picture file before the editing
                        $pdfAndPicture = $database->getBookInfoWithId($_GET['idBook']);
                        //Edit the book if the user change the pdf and the image, just the pdf and just the image
                        if(isset($picture) && isset($PDF)){
                            //Edit the book
                            $database->editBook($_SESSION['editedBook']['title'], $picture, $_SESSION['editedBook']['nbPages'], $PDF, $_SESSION['editedBook']['abstract'], $_SESSION['editedBook']['date'], $_SESSION['editedBook']['author'], $_SESSION['editedBook']['category'], $_SESSION['editedBook']['editor'], $_GET['idBook']);
                        }elseif(isset($picture)){
                            //Edit the book
                            $database->editBook($_SESSION['editedBook']['title'], $picture, $_SESSION['editedBook']['nbPages'], $pdfAndPicture[0]['booExtract'], $_SESSION['editedBook']['abstract'], $_SESSION['editedBook']['date'], $_SESSION['editedBook']['author'], $_SESSION['editedBook']['category'], $_SESSION['editedBook']['editor'], $_GET['idBook']);
                        }elseif(isset($PDF)){
                            //Edit the book
                            $database->editBook($_SESSION['editedBook']['title'], $pdfAndPicture[0]['booPicture'], $_SESSION['editedBook']['nbPages'], $PDF, $_SESSION['editedBook']['abstract'], $_SESSION['editedBook']['date'], $_SESSION['editedBook']['author'], $_SESSION['editedBook']['category'], $_SESSION['editedBook']['editor'], $_GET['idBook']);
                        }
    
                        // Unset the variables
                        unset($_SESSION['editedBook']);
                        unset($_SESSION['authors']);
                        unset($_SESSION['categories']);
                        unset($_SESSION['editors']);
                        
                        header("Location:index.php?controller=detailsBook&action=detailOneBook&idBook=".$_GET['idBook']);
                    }else{
                        header("Location:index.php?controller=books&action=editBook&idBook=".$_GET['idBook']."&error=1");
                    }
                }
            //If the user don't edit the pdf and the image
            }else{
                //Check the regex of the first page
                if(preg_match('/^([a-z]|[A-Z]|[0-9]|\-|\ |\'|.)+$/', $_SESSION['editedBook']['title']) && 
                preg_match('/^[0-9]+$/', $_SESSION['editedBook']['nbPages']) && 
                preg_match('/^.+$/', $_SESSION['editedBook']['abstract']) && 
                preg_match('/^[0-9]{4}$/', $_SESSION['editedBook']['date']) && 
                preg_match('/^[0-9]+$/', $_SESSION['editedBook']['author']) && 
                preg_match('/^[0-9]+$/', $_SESSION['editedBook']['category']) && 
                preg_match('/^[0-9]+$/', $_SESSION['editedBook']['editor']))
                {
                    //Get the books infos
                    $pdfAndPicture = $database->getBookInfoWithId($_GET['idBook']);
                    //Edit the books
                    $database->editBook($_SESSION['editedBook']['title'], $pdfAndPicture[0]['booPicture'], $_SESSION['editedBook']['nbPages'], $pdfAndPicture[0]['booExtract'], $_SESSION['editedBook']['abstract'], $_SESSION['editedBook']['date'], $_SESSION['editedBook']['author'], $_SESSION['editedBook']['category'], $_SESSION['editedBook']['editor'], $_GET['idBook']);
    
                    // Unset the variables
                    unset($_SESSION['editedBook']);
                    unset($_SESSION['authors']);
                    unset($_SESSION['categories']);
                    unset($_SESSION['editors']);
    
                    header("Location:index.php?controller=detailsBook&action=detailOneBook&idBook=".$_GET['idBook']);
                }else{
                    header("Location:index.php?controller=books&action=editBook&idBook=".$_GET['idBook']."&error=1");
                }
            }

        }
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

            $bookExists = false;

            foreach ($books as $key => $value) {
                //Check if a book has the same name
                if($books[$key]['booTitle'] == $_POST['title']){
                    $bookExists = true;
                }
            }
            if($bookExists){
                header("Location:index.php?controller=books&action=addBooks&error=2");
            }else{
                $_SESSION['addedBook'] = $_POST;
                
                header("Location:index.php?controller=books&action=addBooksImageAndExtract");
            }
        }
    }

    /**
     * Load the page for add the book image and extract
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
                        //Replace the space and the specials chars by the "_"
                        $pictureName = str_replace(" ", "_", $_SESSION['addedBook']['title']);
                        $pictureName = str_replace("'", "_", $_SESSION['addedBook']['title']);
                        $pictureName = str_replace(":", "_", $_SESSION['addedBook']['title']);

                        //Set the path of the file
                        $path = 'resources/booksImage/'.$pictureName.".".$extentionUpload;
                        //Set the picture
                        $picture = $pictureName.".".$extentionUpload;
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
                        //Replace the space and the specials chars by the "_"
                        $pictureName = str_replace(" ", "_", $_SESSION['addedBook']['title']);
                        $pictureName = str_replace("'", "_", $_SESSION['addedBook']['title']);
                        $pictureName = str_replace(":", "_", $_SESSION['addedBook']['title']);

                        //Set the path of the file
                        $path = 'resources/booksExtract/'.$pictureName.".".$extentionUpload;
                        //Set the PDF
                        $PDF = $pictureName.".".$extentionUpload;
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
                if(preg_match('/^([a-z]|[A-Z]|[0-9]|\-|\s|.)+$/', $_SESSION['addedBook']['title']) && 
                preg_match('/^[0-9]+$/', $_SESSION['addedBook']['nbPages']) && 
                preg_match('/^.+$/', $_SESSION['addedBook']['abstract']) && 
                preg_match('/^[0-9]{4}$/', $_SESSION['addedBook']['date']) && 
                preg_match('/^[0-9]+$/', $_SESSION['addedBook']['author']) && 
                preg_match('/^[0-9]+$/', $_SESSION['addedBook']['category']) && 
                preg_match('/^[0-9]+$/', $_SESSION['addedBook']['editor']))
                {
                    //Insert the book
                    $database->insertBook($_SESSION['addedBook']['title'], $picture, $_SESSION['addedBook']['nbPages'], $PDF, $_SESSION['addedBook']['abstract'], $_SESSION['addedBook']['date'], $_SESSION['addedBook']['author'], $_SESSION['addedBook']['category'], $_SESSION['addedBook']['editor'], $_SESSION['id']);
    
                    header('Location:index.php?controller=home&action=home');

                    // Unset the variables
                    unset($_SESSION['addedBook']);
                    unset($_SESSION['author']);
                    unset($_SESSION['category']);
                    unset($_SESSION['editors']);
                }
                else{
                    header("Location:index.php?controller=books&action=addBooks&error=1");
                }
            }
            else
            {
                //Error on importation
            }
        }
    }

    /**
     * Load the page for confirm delte book
     *
     * @return string
     */
    private function confirmDeleteAction(){
        //Charge the view file
        $view = file_get_contents('view/page/deleteBook/confirmDelete.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Delete the book and redirect the user to the home page or redirect the user to the details of the book
     */
    private function deleteBookAction(){
        if(isset($_POST['btnDelete'])){
            $database = new Database();
    
            if(isset($_GET['idBook'])){
                $database->deleteBook($_GET['idBook']);
            }

            header("Location:index.php?controller=home&action=home");

        }elseif(isset($_POST['btnBack'])){
            header("Location:index.php?controller=detailsBook&action=detailOneBook&idBook=" . $_GET['idBook']);
        }
    }
}