<?php
/**
 * Auteur : Sean Ford
 * Date: 01.04.2022
 * Main Controller
 */

abstract class Controller {

    /**
     * Method the call the action
     *
     * @return mixed
     */
    public function display() {

        $page = $_GET['action'] . "Display";

        $this->$page();
    }
}