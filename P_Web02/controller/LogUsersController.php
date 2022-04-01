<?php
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 01.04.2022
 * Controller pour gérer la connexion et l'incription des utilisateur
 */
include('data/database.php');

class LogUsersController extends Controller {

    /**
     * Dispatch current action
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        return call_user_func(array($this, $action));
    }

    /**
     * Run the signin page
     *
     * @return string
     */
    private function signinAction() {

        $view = file_get_contents('view/page/logUsers/signin.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Run the login page
     *
     * @return string
     */
    private function loginAction() {

        $view = file_get_contents('view/page/logUsers/login.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Logout the user
     *
     * @return string
     */
    private function logoutAction() {

        $view = file_get_contents('view/page/logUsers/logout.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Connect the user
     *
     * @return string
     */
    private function checkLoginAction() {

        $view = file_get_contents('view/page/logUsers/logout.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Signin the user
     *
     * @return string
     */
    private function checkSigninAction() {
        if(isset($_POST['btnSubmit'])){
            //Get the class Database
            $database = new Database();

            extract($_POST);

            //Check if the user correctly entered the values
            if(preg_match('/^([a-z]+|\.)+\@[a-z]+\.[a-z]+$/', $email) && 
            preg_match('/^([a-z]|[A-z]|\d|\_)+$/', $username)){
                //Check if the user entered the same passwords
                if($password == $passwordConfirm){
                    //Hash password
                    $hashPass = password_hash($password, PASSWORD_BCRYPT);

                    //Insert the user
                    $database->insertUser($email, $hashPass, $username);

                    //Connect the user
                    $usersFound = $database->selectUserWithEmail($email);

                    if($usersFound){
                        foreach ($usersFound as $key => $value) {
                            $passwordFromDB = $usersFound[$key]['usePassword'];
                            if($hashPass == $passwordFromDB){
                                $_SESSION['username'] = $usersFound[$key]['useUsername'];
                                $_SESSION['id'] = $usersFound[$key]['idUser'];
                                header("Location:index.php?controller=home&action=home");
                            }else{
                                //Write an error message if the password is false
                            }
                        }
                    }
                }else{
                    //Write error message if the password not corresponding
                    header("Location:index.php?controller=log&action=signin&error=2");
                }
            }else{
                //Write a message error if the fields have wrong inputs
                header("Location:index.php?controller=log&action=signin&error=1");
            }
        }else{
            //Redirect the user to the home page if he can't see the page
            header("Location:index.php?controller=home&action=home");
        }
    }
}