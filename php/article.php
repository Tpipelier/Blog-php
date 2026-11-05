<?php
$titre = "Article";
require_once('header.php');
require_once('fonction_commentaire.php');

$donnees = recuperer_donnees_article();
$vals = $donnees['articles'];
$com = $donnees['commentaire'];



if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {

if (isset($_SESSION["connecter"]) && !empty($_POST['commentaire'])) {
    creation_commentaire($_POST['commentaire'],$_GET['id_article'],$_SESSION['pseudo']);
}
}

?>


<form method="POST" action="">
    <label for="commentaire">commentaire :</label>
    <input type="text" name="commentaire" id="commentaire" placeholder="Entrez un commentaire" />
    <button type="submit">envoyer</button>
   
</form>
<?php





if (!empty($vals)) {
    foreach ($vals as $row) {
        
        if($row['id']== $_GET['id_article']){
            affiche_article($row['titre'], $row['pseudo'],$row['description']);
            foreach ($com as $line) {
                if($line['article_id']==$_GET['id_article']){
                    echo "<section>";
                    echo "<h3>" . htmlspecialchars($line['description']) . "</h3>";
                    if($line['pseudo']==$_SESSION['pseudo']){
                        ?>                 
                        <form method="POST" action="">
                            <button type="submit">supprimer commentaire</button>
                        </form>
                        <?php
                    }
                    echo "</section>";
                }
            }
        }
    }
} 
    
?>
<?php
require_once('footer.php');
?>