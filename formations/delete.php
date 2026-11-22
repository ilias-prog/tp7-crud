<?php
require_once('../database/connexion.php');

$id = (int) $_GET['id'];

if (isset($_POST['supprimer'])) {
    $requete = $pdo->prepare("SELECT COUNT(*) FROM etudiants WHERE formation_id = ?");
    $requete->execute([$id]);
    $nombreEtudiants = $requete->fetchColumn();

    $requete = $pdo->prepare("SELECT COUNT(*) FROM modules WHERE formation_id = ?");
    $requete->execute([$id]);
    $nombreModules = $requete->fetchColumn();

    if ($nombreEtudiants == 0 && $nombreModules == 0) {
        $requete = $pdo->prepare("DELETE FROM formations WHERE id_formation = ?");
        $requete->execute([$id]);
        header("Location: index.php");
        exit;
    }

    $erreur = "Cette formation contient encore des étudiants ou des modules.";
}

$requete = $pdo->prepare("SELECT * FROM formations WHERE id_formation = ?");
$requete->execute([$id]);
$formation = $requete->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    exit("Formation introuvable.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer une formation</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Supprimer une formation</h1>
    <?php if (isset($erreur)) { ?><p><?= $erreur ?></p><?php } ?>
    <p>Voulez-vous supprimer <?= htmlspecialchars($formation['nom']) ?> ?</p>
    <form method="post">
        <button type="submit" name="supprimer">Oui, supprimer</button>
        <a href="index.php">Annuler</a>
    </form>
</body>
</html>
