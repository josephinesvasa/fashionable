<?php
session_start();
class StartController
{

    public function indexAction()
    {
        if (isset($_SESSION['status'])) {

            require_once './views/account.php';
        }
        else if(!isset($_SESSION['status'])) {

            require_once './views/startpage.php';

        }

    }
}
