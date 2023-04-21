<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Inscription</title>

  
</head>
<body>
  <div class="container mt-5">
    <h1>Connexion</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nom_utilisateur = $_POST["nom_utilisateur"];
      $mot_de_passe = $_POST["mot_de_passe"];

      try {
        $bdd = new PDO("mysql:host=localhost;dbname=site;charset=utf8", "root", "");
      } catch (Exception $e) {
        die("Erreur : ".$e->getMessage());
      }

      $stmt = $bdd->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = ? AND mot_de_passe = ?");
      $stmt->execute([$nom_utilisateur, $mot_de_passe]);
      $user = $stmt->fetch();

      if ($user) {
        $_SESSION["nom_utilisateur"] = $user["nom_utilisateur"];
        echo "<p>Connexion réussie ! Bienvenue ".$user["nom_utilisateur"].".</p>";
      } else {
        echo "<p>Nom d'utilisateur ou mot de passe incorrect.</p>";
      }
    }
    ?>
    <form method="post">
      <div class="form-group">
        <label for="nom_utilisateur" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur" placeholder="Entrez votre nom d'utilisateur">
      </div>
      <div class="form-group">
        <label for="mot_de_passe" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez votre mot de passe">
      </div>
      <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
  </div>
</body>
</html>