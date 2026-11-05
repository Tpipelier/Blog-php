<?php
$titre = "Blog";
require_once('header.php');
require_once('fonction_commentaire.php');

$donnees = recuperer_donnees_article();
$vals = $donnees['articles'];
$com = $donnees['commentaire'];
?>

<div>
    <h1>Blog php</h1>
</div>
<form method="GET" action="">
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
                    echo "</section>";
                }
            }
        }
    }
} else {
    echo '<p>article(s) introuvable(s)</p>';
}

    
?>
<?php
require_once('footer.php');
?>