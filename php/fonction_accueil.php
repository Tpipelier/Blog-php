<?php
function affiche_article(?string $titreArticle, string $nomAuteur): void
{
	if (null === $titreArticle) {
		return;
	}
	echo "<section class=article>";
	echo "<h3>" . htmlspecialchars($titreArticle) . "</h3>";
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

	$sql = 'SELECT * FROM categorie ORDER BY nom ASC';
	$query = $connexion->query($sql, PDO::FETCH_ASSOC);
	$categories = $query->fetchAll();

	if (isset($_GET['categorie_id'])) {
		$categorie_active = $_GET['categorie_id'];
	} elseif (isset($categories[0]['id'])) {
		$categorie_active = $categories[0]['id'];
	} else {
		$categorie_active = null;
	}

	if (isset($_GET['pseudo'])) {
		$stmt = $connexion->prepare("SELECT * FROM article WHERE pseudo = :pseudo");
		$stmt->execute(['pseudo' => $_GET['pseudo']]);
		$vals = $stmt->fetchAll(PDO::FETCH_ASSOC);

	} elseif ($categorie_active !== null) {
		$stmt = $connexion->prepare("
        SELECT article.* 
        FROM article
        JOIN article_categorie ON article.id = article_categorie.article_id
        WHERE article_categorie.categorie_id = :cat_id
    ");
		$stmt->execute(['cat_id' => $categorie_active]);
		$vals = $stmt->fetchAll(PDO::FETCH_ASSOC);

	} else {
		$sql = 'SELECT * FROM article';
		$res = $connexion->query($sql, PDO::FETCH_ASSOC);
		$vals = $res->fetchAll();
	}
	return [
		'categories' => $categories,
		'categorie_active' => $categorie_active,
		'articles' => $vals
	];
}

?>