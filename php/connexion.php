<?php 
$page_css = "connexion.css";
$titre = "Connexion";

require_once('header.php');
require_once('fonction_connexion.php');




// $_SERVER['REQUEST_METHOD'] renvoie la méthode de requete utilisée (c'est beaucoup plus propre)
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



    <section>
        <h2>Connexion</h2>
        <form method=POST action=connexion.php>
            <label>Pseudo
                <input name="pseudo" type="text" value=<?php
                if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
                    echo htmlspecialchars($_POST['pseudo']);

                    }?>>
            </label>

            <label>E-mail
                <input name="email" type="text" value=<?php
                if(isset($_POST['email']) && !empty($_POST['email'])){
                    echo htmlspecialchars($_POST['email']);

                    }?>>
            </label>
            <label>Mot de passe
                <input name="mdp" type="password" >
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