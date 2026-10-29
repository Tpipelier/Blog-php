<?php
$titre = "Blog";
require_once('header.php');
require_once('functions.php');

try {
    $connexion = new PDO('mysql:host=localhost;dbname=blog;', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur PDO: ' . $e->getMessage());
} catch (Exception $e) {
    die('Erreur Générale : ' . $e->getMessage());
}

if (!empty($_GET['pseudo'])) {
   
    $stmt = $connexion->prepare("SELECT * FROM article WHERE pseudo = :pseudo");
    $stmt->execute(['pseudo' => $_GET['pseudo']]);
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
<form method="GET" action="">
    <label for="pseudo">Filtrer par pseudo :</label>
    <input type="text" name="pseudo" id="pseudo" placeholder="Entrez un pseudo" />
    <button type="submit">Filtrer</button>
    <a href="index.php">Réinitialiser</a>
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