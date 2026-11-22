<?php
require_once('../database/connexion.php');

$id = (int) $_GET['id'];
$requete = $pdo->prepare("SELECT * FROM formations WHERE id_formation = ?");
$requete->execute([$id]);
$formation = $requete->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    exit("Formation introuvable.");
}

if (isset($_POST['modifier'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $duree = $_POST['duree_heures'];

    $requete = $pdo->prepare(
        "UPDATE formations SET nom = ?, description = ?, duree_heures = ? WHERE id_formation = ?"
    );
    $requete->execute([$nom, $description, $duree, $id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une formation</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Modifier une formation</h1>
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($formation['nom']) ?>" required><br><br>

        <label>Description :</label>
        <textarea name="description" required><?= htmlspecialchars($formation['description']) ?></textarea><br><br>

        <label>Durée en heures :</label>
        <input type="number" name="duree_heures" min="1" value="<?= $formation['duree_heures'] ?>" required><br><br>

        <button type="submit" name="modifier">Enregistrer</button>
    </form>
    <p><a href="index.php">Retour à la liste</a></p>
</body>
</html>
