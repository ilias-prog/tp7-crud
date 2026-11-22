<?php
require_once('../database/connexion.php');
$requete = $pdo->query(
    "SELECT etudiants.*, formations.nom AS formation
     FROM etudiants
     JOIN formations ON etudiants.formation_id = formations.id_formation"
);
$etudiants = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Étudiants</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Liste des étudiants</h1>
    <p><a href="../">Accueil</a> | <a href="create.php">Ajouter un étudiant</a></p>
    <table>
        <tr><th>Nom</th><th>Prénom</th><th>E-mail</th><th>Date d'inscription</th><th>Formation</th><th>Actions</th></tr>
        <?php foreach ($etudiants as $etudiant) { ?>
            <tr>
                <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                <td><?= htmlspecialchars($etudiant['email']) ?></td>
                <td><?= htmlspecialchars($etudiant['date_inscription']) ?></td>
                <td><?= htmlspecialchars($etudiant['formation']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $etudiant['id_etudiant'] ?>">Modifier</a>
                    <a href="delete.php?id=<?= $etudiant['id_etudiant'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
