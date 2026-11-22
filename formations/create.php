<?php
require_once('../database/connexion.php');

if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $duree = $_POST['duree_heures'];

    $requete = $pdo->prepare(
        "INSERT INTO formations (nom, description, duree_heures) VALUES (?, ?, ?)"
    );
    $requete->execute([$nom, $description, $duree]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une formation</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Ajouter une formation</h1>
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" required><br><br>

        <label>Description :</label>
        <textarea name="description" required></textarea><br><br>

        <label>Durée en heures :</label>
        <input type="number" name="duree_heures" min="1" required><br><br>

        <button type="submit" name="ajouter">Ajouter</button>
    </form>
    <p><a href="index.php">Retour à la liste</a></p>
</body>
</html>
