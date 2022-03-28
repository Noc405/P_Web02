<?php
/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controler pour gérer les pages classiques
 */

class HomeController extends Controller {

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
     * Display Index Action
     *
     * @return string
     */
    private function homeAction() {

        $view = file_get_contents('view/page/home/home.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}