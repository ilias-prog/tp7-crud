<?php
require_once('../database/connexion.php');

$formations = $pdo->query("SELECT * FROM formations")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $volume_horaire = $_POST['volume_horaire'];
    $formation_id = $_POST['formation_id'];

    $requete = $pdo->prepare(
        "INSERT INTO modules (nom, description, volume_horaire, formation_id)
         VALUES (?, ?, ?, ?)"
    );
    $requete->execute([$nom, $description, $volume_horaire, $formation_id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un module</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Ajouter un module</h1>

    <?php if (count($formations) == 0) { ?>
        <p>Ajoutez d'abord une formation.</p>
    <?php } else { ?>
        <form method="post">
            <label>Nom :</label>
            <input type="text" name="nom" required><br><br>

            <label>Description :</label>
            <textarea name="description" required></textarea><br><br>

            <label>Volume horaire :</label>
            <input type="number" name="volume_horaire" min="1" required><br><br>

            <label>Formation :</label>
            <select name="formation_id" required>
                <option value="">Choisir une formation</option>
                <?php foreach ($formations as $formation) { ?>
                    <option value="<?= $formation['id_formation'] ?>">
                        <?= htmlspecialchars($formation['nom']) ?>
                    </option>
                <?php } ?>
            </select><br><br>

            <button type="submit" name="ajouter">Ajouter</button>
        </form>
    <?php } ?>

    <p><a href="index.php">Retour à la liste</a></p>
</body>
</html>
