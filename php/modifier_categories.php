<?php
$titre = "modifier_categories";
require_once('header.php');
require_once('fonction_accueil.php');
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("Location: index.php");
    exit();
}
try {
    $connexion = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $connexion->query("SELECT id, nom FROM categorie ORDER BY nom ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'create') {
            $stmt = $connexion->prepare("INSERT INTO categorie (nom) VALUES (?)");
            $stmt->execute([trim($_POST['nouveau_nom'])]);
            
        } elseif ($_POST['action'] === 'update') {
            $stmt = $connexion->prepare("UPDATE categorie SET nom = ? WHERE id = ?");
            $stmt->execute([trim($_POST['nom_modifie']), $_POST['id_categorie']]);
        } elseif ($_POST['action'] === 'delete') {
            $stmt = $connexion->prepare("DELETE FROM categorie WHERE id = ?");
            $stmt->execute([trim($_POST['id_categorie'])]);
        }
    }
} catch (PDOException $e) {
    die('Erreur PDO : ' . $e->getMessage());
}

?>
<form method="POST">
    <h3>1. Ajouter une catégorie</h3>
    <input type="hidden" name="action" value="create">
    <label for="nouveau_nom">Nom de la nouvelle catégorie :</label>
    <input type="text" id="nouveau_nom" name="nouveau_nom" required>
    <button type="submit" name="action" value="create">Ajouter</button>
</form>
<form method="POST">
    <h3>2. Modifier une catégorie</h3>

    <label for="id_modifier">Choisir la catégorie :</label>
    <select id="id_modifier" name="id_categorie" required>
        <option value="">-- Sélectionnez --</option>
        <?php
        foreach ($categories as $cat) { ?>
            <option value="<?= htmlspecialchars($cat['id']) ?>">
                <?= htmlspecialchars($cat['nom']) ?>
            </option>
            <?php
        }
        ?>
    </select>
    <button type="submit" name="action" value="update">Modifier</button>
    <label for="nom_modifie">Nouveau nom :</label>
    <input type="text" id="nom_modifie" name="nom_modifie" required>
</form>
<form method="POST" style="border-left: 5px solid #d9534f;"
    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
    <h3>3. Supprimer une catégorie</h3>

    <label for="id_supprimer">Choisir la catégorie :</label>
    <select id="id_supprimer" name="id_categorie" required>
        <option value="">-- Sélectionnez --</option>
        <?php
        foreach ($categories as $cat) { ?>
            <option value="<?= htmlspecialchars($cat['id']) ?>">
                <?= htmlspecialchars($cat['nom']) ?>
            </option>
            <?php
        }
        ?>
    </select>

    <button type="submit" name="action" value="delete"
        style="background: #d9534f; color: white; border: none;">Supprimer</button>
</form>
<?php
require_once('footer.php');
?>