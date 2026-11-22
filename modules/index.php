<?php
require_once('../database/connexion.php');
$requete = $pdo->query(
    "SELECT modules.*, formations.nom AS formation
     FROM modules
     JOIN formations ON modules.formation_id = formations.id_formation"
);
$modules = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modules</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Liste des modules</h1>
    <p><a href="../">Accueil</a> | <a href="create.php">Ajouter un module</a></p>
    <table>
        <tr><th>Nom</th><th>Description</th><th>Volume horaire</th><th>Formation</th><th>Actions</th></tr>
        <?php foreach ($modules as $module) { ?>
            <tr>
                <td><?= htmlspecialchars($module['nom']) ?></td>
                <td><?= htmlspecialchars($module['description']) ?></td>
                <td><?= htmlspecialchars($module['volume_horaire']) ?> h</td>
                <td><?= htmlspecialchars($module['formation']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $module['id_module'] ?>">Modifier</a>
                    <a href="delete.php?id=<?= $module['id_module'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
