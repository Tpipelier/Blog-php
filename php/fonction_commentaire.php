<?php
function affiche_article(?string $titreArticle, string $nomAuteur, string $description): void
{
	if (null === $titreArticle) {
		return;
	}
	echo "<section>";
	echo "<h2>" . htmlspecialchars($titreArticle) . "</h2>";
	echo "<h2>" . nl2br(htmlspecialchars($description)) . "</h2>";
	echo "<p> de" . htmlspecialchars($nomAuteur) . "</p>";
	echo "</section>";
}


function recuperer_donnees_article()
{
	try {
		$connexion = new PDO('mysql:host=localhost;dbname=blog;', 'root', '');
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		die('Erreur PDO: ' . $e->getMessage());
	} catch (Exception $e) {
		die('Erreur Générale : ' . $e->getMessage());
	}

	
	$sql = 'SELECT * FROM article';
	$res = $connexion->query($sql, PDO::FETCH_ASSOC);
	$vals = $res->fetchAll();
	

    $sql = 'SELECT * FROM commentaire';
	$res = $connexion->query($sql, PDO::FETCH_ASSOC);
	$com = $res->fetchAll();

	return [
		'articles' => $vals,
        'commentaire' => $com
	];
}

function creation_commentaire(string $description, int $article_id, string $pseudo){
    try{
        $commentaire = new PDO('mysql:host=localhost;dbname=blog','root','');
        $commentaire->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $commentaire->prepare("INSERT INTO  commentaire (description,article_id,pseudo) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $description);
            $stmt->bindParam(2, $article_id);
            $stmt->bindParam(3, $pseudo);



            $stmt->execute();

            header("location: article.php?id_article=$article_id");

         

    } catch(PDOException $e){
        die('Erreur PDO : ' . $e->getMessage());
    }catch(Exception $e){
        die('Erreur Générale : ' . $e->getMessage());
    }

}

function supprimer_commentaire(int $commentaire_id, int $article_id){
    try{
    $commentaire = new PDO('mysql:host=localhost;dbname=blog','root','');
    $commentaire->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $commentaire->prepare("DELETE from  commentaire WHERE id = ? and article_id=?");
    $stmt->bindParam(1, $commentaire_id);
    $stmt->bindParam(2, $article_id);
            

    $stmt->execute();

    header("location: article.php?id_article=$article_id");
    //exit(0);

    } catch(PDOException $e){
        die('Erreur PDO : ' . $e->getMessage());
    }catch(Exception $e){
        die('Erreur Générale : ' . $e->getMessage());
    }



}

   


?>