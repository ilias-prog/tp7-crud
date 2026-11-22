<?php
require_once('../database/connexion.php');

$id = (int) $_GET['id'];

if (isset($_POST['supprimer'])) {
    $requete = $pdo->prepare("DELETE FROM etudiants WHERE id_etudiant = ?");
    $requete->execute([$id]);
    header("Location: index.php");
    exit;
}

$requete = $pdo->prepare("SELECT * FROM etudiants WHERE id_etudiant = ?");
$requete->execute([$id]);
$etudiant = $requete->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    exit("Étudiant introuvable.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un étudiant</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Supprimer un étudiant</h1>
    <p>Voulez-vous supprimer <?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']) ?> ?</p>
    <form method="post">
        <button type="submit" name="supprimer">Oui, supprimer</button>
        <a href="index.php">Annuler</a>
    </form>
</body>
</html>
