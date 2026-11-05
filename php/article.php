<?php
$titre = "Article";
$page_css = "article.css";
require_once('header.php');
require_once('fonction_commentaire.php');


$donnees = recuperer_donnees_article();
$vals = $donnees['articles'];
$com = $donnees['commentaire'];



if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {

    
    if (isset($_POST['ajout'])){
        if (isset($_SESSION["connecter"]) && !empty($_POST['commentaire'])) {
            creation_commentaire($_POST['commentaire'],(int)$_GET['id_article'],$_SESSION['pseudo']);
        }
    }

    elseif (isset($_POST['sup'])){
        if(isset($_SESSION["connecter"]) && !empty($_POST['com_id'])){
           supprimer_commentaire($_POST['com_id'],(int)$_GET['id_article']);
        }
    }
    elseif (isset($_POST['art'])){
        supprimer_article((int)$_GET['id_article']);
    }
}

?>




<?php





if (!empty($vals)) {
    foreach ($vals as $row) {
        
        if($row['id']== $_GET['id_article']){
            affiche_article($row['titre'], $row['pseudo'],$row['description']);
            if($row['pseudo']==$_SESSION['pseudo']){
                ?>
                <form method="POST" action="">
                    <button type="submit" name="art">supprimer article</button>
                </form>
                 <?php       
            }
?>
<form method="POST" action="">
    <label for="commentaire">Ajouter un commentaire</label>
    <textarea type="text" name="commentaire" id="commentaire" placeholder="Entrez un commentaire"></textarea>
    <button type="submit" name="ajout">Envoyer</button>
   
</form>
<section class='zone_commentaire'>
<?php

            foreach ($com as $line) {
                if($line['article_id']==$_GET['id_article']){
                    echo "<section>";
                    echo "<p>" . nl2br(htmlspecialchars($line['description'])) . "</p>";
                    if($line['pseudo']==$_SESSION['pseudo']){
                        ?>                 
                        <form method="POST" action="">
                            <input type="hidden" name="com_id" value="<?= $line['id'] ?>">
                            <button type="submit" name="sup">Supprimer</button>
                        </form>
                        <?php
                    }
                    else{
                        echo "<p class='pseudo_com'>Posté par " .$line['pseudo'] . "</p>";
                    }
                    echo "</section>";
                }
            }
        }
    }
} ?>
</section>

<?php
require_once('footer.php');
?>