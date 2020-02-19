<?php
    session_start();
    $page = "";
    $session = "";
    
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    if(isset($_GET['session'])){
        $session = $_GET['session'];
    }

    if($session != ""){
        $_SESSION[$session] = "";
    }
    if($page != ""){
        header('Location: https://projetofarmacia.000webhostapp.com/'.$page);
    }
?>