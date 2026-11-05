<?php 

	function affiche_article(?string $titreArticle, string $nomAuteur) : void {
		if(null === $titreArticle){
			return;
		}
        echo "<section>";
		echo "<h3>".htmlspecialchars($titreArticle)."</h3>";
        echo "<p>de". htmlspecialchars($nomAuteur)."</p>";
        echo "</section>";
	}

?>