<?php
$titre = "Créer un article";
require_once('header.php');
require_once('fonction_creation_article.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['titre'])  && !empty($_POST['titre']) && isset($_POST['description']) && !empty($_POST['description']) &&  isset($_POST['categorie'])&& !empty($_POST['categorie'])){
            $code_erreur =  cree_article(htmlspecialchars($_POST['titre']),htmlspecialchars($_POST['description']),$_POST['categorie']);
    }
    else{
        $code_erreur = -1;
    }
    if($code_erreur == -1){
        $erreur = "Merci de renseigner tout les champs";
    }

}



?>



<section>
    <h2>Créer un article</h2>
    <form method=POST action=creation_article.php>
        <label>Titre
        <input name="titre" type="text"> 
        </label>

        <label>Description
            <textarea name="description" type="text"></textarea>
        </label>
            <label>Catégorie
            <select name="categorie[]" multiple>
                
            <?php
                option_categorie();
            ?>
            </select>
        </label>

    
    <button type="submit">Créer l'article</button>
    </form>

    <?php 
    if(isset($erreur)){
        echo '<p class="erreur">'. $erreur ."</p>";
    }
       
            
    
    ?>


</section>

<?php
require_once('footer.php');
?>