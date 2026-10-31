<?php
$titre = "Blog";
require_once('header.php');
require_once('fonction_accueil.php');

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
?>

<div>
    <h1>Blog php</h1>
</div>

<?php
foreach ($categories as $cat) {
    ?>
    <a href="index.php?categorie_id=<?= $cat['id'] ?>"
        style="margin-right: 15px; <?= ($cat['id'] == $categorie_active && empty($_GET['pseudo'])) ? 'font-weight: bold; text-decoration: underline;' : '' ?>"><?= htmlspecialchars($cat['nom']) ?></a>
    <?php
}
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    ?> <a href="modifier_categories.php" class="btn-navigation">/admin modifier les catégories</a><?php
}
?>

<section>

    <form method="GET" action="">
        <label for="pseudo">Filtrer par pseudo :</label>
        <input type="text" name="pseudo" id="pseudo" placeholder="Entrez un pseudo" />
        <button type="submit">Filtrer</button>
        <a href="index.php">Réinitialiser</a>
    </form>

</section>

<section>

    <?php
    if (isset($_SESSION["connecter"])) {
        ?><a href="creation_article.php" class="btn-navigation">Créer un article</a><?php
    } else {
        ?><a href="connexion.php" class="btn-navigation">Créer un article</a><?php
    }
    ?>

</section>

<?php
if (!empty($vals)) {
    foreach ($vals as $row) {
        affiche_article($row['titre'], $row['pseudo']);
    }
} else {
    echo '<p>article(s) introuvable(s)</p>';
}
?>

<?php
require_once('footer.php');
?>