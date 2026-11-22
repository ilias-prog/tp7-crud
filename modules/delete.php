<?php
require_once('../database/connexion.php');

$id = (int) $_GET['id'];

if (isset($_POST['supprimer'])) {
    $requete = $pdo->prepare("DELETE FROM modules WHERE id_module = ?");
    $requete->execute([$id]);
    header("Location: index.php");
    exit;
}

$requete = $pdo->prepare("SELECT * FROM modules WHERE id_module = ?");
$requete->execute([$id]);
$module = $requete->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    exit("Module introuvable.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un module</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Supprimer un module</h1>
    <p>Voulez-vous supprimer <?= htmlspecialchars($module['nom']) ?> ?</p>
    <form method="post">
        <button type="submit" name="supprimer">Oui, supprimer</button>
        <a href="index.php">Annuler</a>
    </form>
</body>
</html>
