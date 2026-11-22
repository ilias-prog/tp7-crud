<?php
require_once('../database/connexion.php');

$id = (int) $_GET['id'];
$requete = $pdo->prepare("SELECT * FROM modules WHERE id_module = ?");
$requete->execute([$id]);
$module = $requete->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    exit("Module introuvable.");
}

$formations = $pdo->query("SELECT * FROM formations")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['modifier'])) {
    $requete = $pdo->prepare(
        "UPDATE modules SET nom = ?, description = ?, volume_horaire = ?, formation_id = ?
         WHERE id_module = ?"
    );
    $requete->execute([
        $_POST['nom'],
        $_POST['description'],
        $_POST['volume_horaire'],
        $_POST['formation_id'],
        $id
    ]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un module</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Modifier un module</h1>
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($module['nom']) ?>" required><br><br>

        <label>Description :</label>
        <textarea name="description" required><?= htmlspecialchars($module['description']) ?></textarea><br><br>

        <label>Volume horaire :</label>
        <input type="number" name="volume_horaire" min="1" value="<?= $module['volume_horaire'] ?>" required><br><br>

        <label>Formation :</label>
        <select name="formation_id" required>
            <?php foreach ($formations as $formation) { ?>
                <option value="<?= $formation['id_formation'] ?>"
                    <?= $formation['id_formation'] == $module['formation_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($formation['nom']) ?>
                </option>
            <?php } ?>
        </select><br><br>

        <button type="submit" name="modifier">Enregistrer</button>
    </form>
    <p><a href="index.php">Retour à la liste</a></p>
</body>
</html>
