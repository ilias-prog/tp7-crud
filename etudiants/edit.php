<?php
require_once('../database/connexion.php');

$id = (int) $_GET['id'];
$requete = $pdo->prepare("SELECT * FROM etudiants WHERE id_etudiant = ?");
$requete->execute([$id]);
$etudiant = $requete->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    exit("Étudiant introuvable.");
}

$formations = $pdo->query("SELECT * FROM formations")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['modifier'])) {
    $requete = $pdo->prepare(
        "UPDATE etudiants
         SET nom = ?, prenom = ?, email = ?, date_inscription = ?, formation_id = ?
         WHERE id_etudiant = ?"
    );
    $requete->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['date_inscription'],
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
    <title>Modifier un étudiant</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Modifier un étudiant</h1>
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required><br><br>

        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required><br><br>

        <label>E-mail :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($etudiant['email']) ?>" required><br><br>

        <label>Date d'inscription :</label>
        <input type="date" name="date_inscription" value="<?= $etudiant['date_inscription'] ?>" required><br><br>

        <label>Formation :</label>
        <select name="formation_id" required>
            <?php foreach ($formations as $formation) { ?>
                <option value="<?= $formation['id_formation'] ?>"
                    <?= $formation['id_formation'] == $etudiant['formation_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($formation['nom']) ?>
                </option>
            <?php } ?>
        </select><br><br>

        <button type="submit" name="modifier">Enregistrer</button>
    </form>
    <p><a href="index.php">Retour à la liste</a></p>
</body>
</html>
