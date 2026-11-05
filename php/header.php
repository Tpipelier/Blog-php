<?php declare(strict_types=1); 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    
if(isset($_SESSION["connecter"]) && $_SESSION["connecter"] === false){
    header("location: connexion.php");
    exit(0);
} 

if(isset($_POST["deconnexion"])){
    unset($_SESSION['connecter']);
    unset($_SESSION['pseudo']);
    unset($_SESSION['admin']);
    unset($_SESSION['id']);

    header("location: connexion.php");
    exit(0);
            
} 
            

       

?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/header.css">
        <?php
        if (isset($page_css)){
            echo '<link rel="stylesheet" type="text/css" href="../css/'.$page_css. '">';
        }
        if(isset($titre)){
            echo "<title>".$titre."</title>";
        }
        
        ?>
    </head>
    <body>
        <header>
            <?php 
       

        if (!empty($_SESSION["connecter"]) && $_SESSION["connecter"] === true){
            ?><p>Connecté en tant que : <?php echo $_SESSION["pseudo"]; ?></p>
            
            <form method=POST action="">
                <button type="submit", name=deconnexion>Déconnexion</button>
                



            </form>
            <?php

            

        }

        ?>
        <section>
        <h1>Blog php</h1>
        </section>

        </header>


    

       
        