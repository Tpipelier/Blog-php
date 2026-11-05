<?php
$titre = "Blog";
require_once('header.php');

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

    if(!empty($vals)){
        creation_commentaire($commentaire,$article_id,$pseudo)
    }
?>
<?php
require_once('footer.php');
?>