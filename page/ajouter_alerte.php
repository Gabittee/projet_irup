<?php

include '../fonction/bdd.php';

// Vérification de la soumission du formulaire
if (isset($_POST['date']) && isset($_POST['classe']) && isset($_POST['alerte'])) {

  // Récupération des données du formulaire
  $date = $_POST['date'];
  $alerte = $_POST['alerte'];
  $classe = $_POST['classe'];

  // Insertion des données dans la base de données
  $sql = "INSERT INTO alerte_classe (date, alerte, classe) VALUES (:date, :alerte, :classe)";
  $stmt = $bdd->prepare($sql);
  $stmt->bindParam(':date', $date);
  $stmt->bindParam(':alerte', $alerte);
  $stmt->bindParam(':classe', $classe);
  $stmt->execute();

}

// Récupération des alertes de la classe
$sql = "SELECT alerte, date, classe FROM alerte_classe";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$alertes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage des alertes
foreach ($alertes as $alerte) {
  echo "Date: " . $alerte['date'] . " | Classe: " . $alerte['classe'] . " | Alerte: " . $alerte['alerte'] . "<br>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Ajouter un alerte</title>
  <link rel="stylesheet" href="../formulaire.css" type="text/css" media="screen" />
</head>
<body>
  <?php include '../navbar.html';?>
  <div class="container mt-5">
    <h1>Ajouter un alerte</h1>
    <form action="ajouter_alerte.php" method="POST">
      <div class="form-group row">
        <div class="col-sm-6">
          <label for="date">Date</label>
          <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="col-sm-6">
          <label for="classe">Classe</label>
          <select class="form-control" id="classe" name="classe">
            <option value="btssn">BTSSN</option>
            <option value="segpa">SEGPA</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="alerte">alerte</label>
        <input type="text" class="form-control" id="alerte" name="alerte" placeholder="Entrez votre alerte">
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>      
    </form>
  </div>
</body>
</html>