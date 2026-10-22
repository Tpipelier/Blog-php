<?php 
    require_once('header.php');

    
?>


<section>
    <h2>Connexion</h2>
    <form method=POST action=cconnexion.php>
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



</section>











<?php 
    require_once('footer.php');
  
?>