<?php 
    require_once('header.php');
    require_once('fonction_connexion.php');

   // if(isset($_SESSION["connecter"]) && $_SESSION["connecter"] === true){
      //  header("location: accueil.php");
      //  exit(0);
  //  }
    
?>


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
        if (isset($_POST['pseudo']) && isset($_POST['email']) &&  isset($_POST['mdp'])){
            connexion(htmlspecialchars($_POST['pseudo']),htmlspecialchars($_POST['email']),htmlspecialchars($_POST['mdp']));
        }    
    ?>




</section>











<?php 
    require_once('footer.php');
  
?>