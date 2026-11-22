<?php
require_once('../database/connexion.php');

$formations = $pdo->query("SELECT * FROM formations")->fetchAll(PDO::FETCH_ASSOC);
$erreur = "";

if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date_inscription = $_POST['date_inscription'];
    $formation_id = $_POST['formation_id'];

    if ($nom == "" || $prenom == "" || $email == "" || $date_inscription == "" || $formation_id == "") {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $requete = $pdo->prepare(
            "INSERT INTO etudiants (nom, prenom, email, date_inscription, formation_id)
             VALUES (?, ?, ?, ?, ?)"
        );
        $requete->execute([$nom, $prenom, $email, $date_inscription, $formation_id]);

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un étudiant</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="../">Centre de formation</a>
        <nav>
            <a href="../formations/">Formations</a>
            <a href="index.php">Étudiants</a>
            <a href="../modules/">Modules</a>
        </nav>
    </header>

    <main class="container">
        <h1>Ajouter un étudiant</h1>
        <p>Remplissez les informations puis choisissez sa formation.</p>

        <?php if ($erreur != "") { ?>
            <p class="notice error"><?= htmlspecialchars($erreur) ?></p>
        <?php } ?>

    <?php if (count($formations) == 0) { ?>
        <p class="notice">Ajoutez d'abord une formation avant de créer un étudiant.</p>
    <?php } else { ?>
        <form method="post" class="form-card">
            <label for="nom">Nom</label>
            <input id="nom" type="text" name="nom" required>

            <label for="prenom">Prénom</label>
            <input id="prenom" type="text" name="prenom" required>

            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" required>

            <label for="date_inscription">Date d'inscription</label>
            <input id="date_inscription" type="date" name="date_inscription" required>

            <label for="formation_id">Formation</label>
            <select id="formation_id" name="formation_id" required>
                <option value="">Choisir une formation</option>
                <?php foreach ($formations as $formation) { ?>
                    <option value="<?= $formation['id_formation'] ?>">
                        <?= htmlspecialchars($formation['nom']) ?>
                    </option>
                <?php } ?>
            </select>

            <div class="form-actions">
                <button type="submit" name="ajouter">Ajouter l'étudiant</button>
                <a class="button secondary" href="index.php">Annuler</a>
            </div>
        </form>
    <?php } ?>
    </main>
</body>
</html>
