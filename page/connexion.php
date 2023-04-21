<?php
session_start();

include '../fonction/bdd.php';

if(isset($_POST['nom_utilisateur']) && isset($_POST['mot_de_passe'])) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Query the database for the user's credentials
    $sql = "SELECT * FROM utilisateurs WHERE nom_utilisateur = :nom_utilisateur";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && $user['mot_de_passe'] === $mot_de_passe) {

        // Set the user session variable and redirect to the dashboard page
        $_SESSION['user'] = $user;
        $_SESSION['logged_in'] = true;
        $_SESSION['statut'] = $user['statut'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid nom_utilisateur or mot_de_passe, display an error message
        $error_message = "Nom d'utilisateur ou mot de passe invalide.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Connexion</title>
  <link rel="stylesheet" href="../formulaire.css" type="text/css" media="screen" />
</head>
<body>
  <div class="container mt-5">
    <h1>Connexion</h1>
    <?php if(isset($error_message)) { ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php } ?>
    <form method="POST">
      <div class="form-group">
        <label for="nom_utilisateur" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur" placeholder="Entrez votre nom d'utilisateur">
      </div>
      <div class="form-group">
        <label for="mot_de_passe" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez votre mot de passe">
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Se souvenir</label>
      </div>
      <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
  </div>
</body>
</html>