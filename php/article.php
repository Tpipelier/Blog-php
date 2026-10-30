<?php
$titre = "Blog";
require_once('header.php');




?>

<div>
    <h1>Blog php</h1>
</div>
<form method="GET" action="">
    <label for="commentaire">commentaire :</label>
    <input type="text" name="pseudo" id="commentaire" placeholder="Entrez un commentaire" />
    <button type="submit">envoyer</button>
    
</form>
<?php

    if(!empty($vals)){
        foreach ($vals as $row) {
                showArticle($row['titre'], $row['pseudo']);
            
        }
    }else{
        echo '<p>pseudo introuvable</p>';
    }
?>
<?php
require_once('footer.php');
?>