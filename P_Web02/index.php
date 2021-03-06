<?php
session_start();
/**
 * ETML
 * Auteur : Emilien Charpié
 * Date: 08.04.2022
 * Index of the website
 */

$debug = false;

if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

}
date_default_timezone_set('Europe/Zurich');

include_once 'controller/Controller.php';
include_once 'controller/HomeController.php';
include_once 'controller/BrowseController.php';
include_once 'controller/DetailsController.php';
include_once 'controller/LogUsersController.php';
include_once 'controller/BooksController.php';
include_once 'controller/VoteController.php';

class MainController {

    /**
     * Permet de sélectionner le bon contrôler et l'action
     */
    public function dispatch() {

        if (!isset($_GET['controller'])) {
            $_GET['controller'] = 'home';
            $_GET['action'] = 'home';
        }
        //Problem with the template, redirect to a page with correct header
        if(isset($_GET['q'])){
            header("Location:index.php?controller=browse&action=listBook&search=".$_GET['q']);
        }


        $currentLink = $this->menuSelected($_GET['controller']);
        $this->viewBuild($currentLink);
    }

    /**
     * Selectionner la page et instancier le contrôleur
     *
     * @param string $page : page sélectionner
     * @return $link : instanciation d'un contrôleur
     */
    protected function menuSelected ($page) {

        switch($_GET['controller']){
            case 'home':
                $link = new HomeController();
                break;
            case 'browse':
                $link = new BrowseController();
                break;
            case 'detailsBook':
                $link = new DetailsController();
                break;
            case 'log':
                $link = new LogUsersController();
                break;
            case 'books':
                $link = new BooksController();
                break;
            case 'vote':
                $link = new VoteController();
                break;
            default:
                $link = new HomeController();
                break;
        }

        return $link;
    }

    /**
     * Construction de la page
     *
     * @param $currentPage : page qui doit s'afficher
     */
    protected function viewBuild($currentPage) {

            $content = $currentPage->display();

            if($currentPage == new LogUsersController || $currentPage == new BooksController){
                include(dirname(__FILE__) . '/view/head.php');
                echo $content;
            }else{
                include(dirname(__FILE__) . '/view/head.php');
                include(dirname(__FILE__) . '/view/menu.php');
                echo $content;
                include(dirname(__FILE__) . '/view/footer.php');
            }
    }
}

/**
 * Affichage du site internet - appel du contrôleur par défaut
 */
$controller = new MainController();
$controller->dispatch();