<?php declare(strict_types=1); 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <?php
        if (isset($page_css)){
            echo '<link rel="stylesheet" type="text/css" href="../css/'.$page_css. '">';
        }
        
        ?>
    </head>

    <body>

        <?php 
       

        if (!empty($_SESSION["connecter"]) && $_SESSION["connecter"] === true){
            ?><p>Connecté en tant que :<?php echo $_SESSION["pseudo"]; ?></p><?php
        }else{
            ?><nav><button><a href="connexion.php">se connecter</a></button></nav><?php
        }
    
        ?>
        