<?php
require_once('../database/connexion.php');
$requete = $pdo->query("SELECT * FROM formations");
$formations = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formations</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Liste des formations</h1>
    <p><a href="../">Accueil</a> | <a href="create.php">Ajouter une formation</a></p>
    <table>
        <tr><th>Nom</th><th>Description</th><th>Durée</th><th>Actions</th></tr>
        <?php foreach ($formations as $formation) { ?>
            <tr>
                <td><?= htmlspecialchars($formation['nom']) ?></td>
                <td><?= htmlspecialchars($formation['description']) ?></td>
                <td><?= htmlspecialchars($formation['duree_heures']) ?> h</td>
                <td>
                    <a href="edit.php?id=<?= $formation['id_formation'] ?>">Modifier</a>
                    <a href="delete.php?id=<?= $formation['id_formation'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
