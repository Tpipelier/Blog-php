<?php
$page_css = "index.css";
$titre = "Blog";
require_once('header.php');
require_once('fonction_accueil.php');

$donnees = recuperer_donnees_article();
$categories = $donnees['categories'];
$categorie_active = $donnees['categorie_active'];
$vals = $donnees['articles'];
?>


<?php
foreach ($categories as $cat) {
    ?>
    <a href="index.php?categorie_id=<?= $cat['id'] ?>"
        style="margin-right: 15px; <?= ($cat['id'] == $categorie_active && empty($_GET['pseudo'])) ? 'font-weight: bold; text-decoration: underline;' : '' ?>"><?= htmlspecialchars($cat['nom']) ?></a>
    <?php
}
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    ?> <a href="modifier_categories.php" ">/admin modifier les catégories</a>
    <?php
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
        ?><a href="creation_article.php" ">Créer un article</a><?php
    } else {
        ?><a href="connexion.php" ">Créer un article</a><?php
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