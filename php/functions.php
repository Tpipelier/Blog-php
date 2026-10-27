<?php 

	function showArticle(?string $titreArticle, string $nomAuteur) : void {
		if(null === $titreArticle){
			return;
		}
        echo "<section>";
		echo "<h3>$titreArticle</h3>";
        echo "<p>de $nomAuteur</p>";
        echo "</section>";
	}

?>