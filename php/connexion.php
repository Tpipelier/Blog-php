<?php declare(strict_types=1);
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('fonction_connexion.php');
//
//if(isset($_SESSION["connecter"]) && $_SESSION["connecter"] === true){
//   header("location: accueil.php");
//  exit(0);
//} 



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['mdp'])) {
        $code_erreur = connexion(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['mdp']));
    } else {
        $code_erreur = -4;
    }



    if ($code_erreur == -1) {
        $erreur = "Pseudo incorrect";
    } elseif ($code_erreur == -2) {
        $erreur = "E-mail incorrect";
    } elseif ($code_erreur == -3) {
        $erreur = "Mot de passe incorrect";
    } elseif ($code_erreur == -4) {
        $erreur = "Merci de renseigner tout les champs";
    }


}
?>

<html>

<head>

    <title>Connexion</title>

    <link rel="stylesheet" type="text/css" href="../css/connexion.css">
</head>

<body>
    <section>
        <h2>Connexion</h2>
        <form method=POST action=connexion.php>
            <label>Pseudo
                <input name="pseudo" type="text">
            </label>

            <label>E-mail
                <input name="email" type="text">
            </label>
            <label>Mot de passe
                <input name="mdp" type="password">
            </label>


            <button type="submit">Se Connecter</button>
        </form>

        <?php
        if (isset($erreur)) {
            echo '<p class="erreur">' . $erreur . "</p>";
        }



        ?>


    </section>











    <?php
    require_once('footer.php');

    ?>