<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ma page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <?php include '../navbar.html';?>
</head>
<link rel="stylesheet" href="../formulaire.css" type="text/css" />




<?php

$dateChoisie = "";
$classeChoisie = "";
$periodeChoisie = "";

if (isset($_POST['date']) && isset($_POST['classe']) && isset($_POST['periode'])) {
  $dateChoisie = $_POST['date'];
  $classeChoisie = $_POST['classe'];
  $periodeChoisie = $_POST['periode'];
  // Faites quelque chose avec les variables $dateChoisie, $classeChoisie, et $periodeChoisie ici
  // Par exemple, vous pouvez les utiliser pour exécuter une requête SQL pour récupérer des données de la base de données et les afficher sur la page.
} elseif (isset($_GET['date']) && isset($_GET['classe']) && isset($_GET['periode'])) {
  $dateChoisie = $_GET['date'];
  $classeChoisie = $_GET['classe'];
  $periodeChoisie = $_GET['periode'];
}
?>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Sélectionner une date, une classe et une période</h5>
            <form method="post">
              <div class="form-group">
                <label for="date-input" >Date</label>
                <input class="form-control" type="date" id="date-input" name="date" value="<?php echo htmlspecialchars($dateChoisie); ?>" min="2023-01-01" max="2030-12-31">
              </div>
              <div class="form-group">
                <label for="classe-select" >Classe</label>
                <select class="form-control" name="classe" id="classe-select">
                  <option value="BTSS21" <?php if ($classeChoisie == "BTSS21") echo "selected"; ?>>BTSS21</option>
                  <option value="BTSS22" <?php if ($classeChoisie == "BTSS22") echo "selected"; ?>>BTSS22</option>
                </select>
              </div>
              <div class="form-group">
                <label for="periode-select" >Période</label>
                <select class="form-control" name="periode" id="periode-select">
                  <option value="matin" <?php if ($periodeChoisie == "matin") echo "selected"; ?>>matin</option>
                  <option value="apres-midi" <?php if ($periodeChoisie == "apres-midi") echo "selected"; ?>>apres-midi</option>
                </select>
              </div>
              <button class="btn btn-success" type="submit">Envoyer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php include '../fonction/liste_des_retards.php';?>

<?php include '../fonction/liste_des_absences.php';?>

<?php include '../fonction/alerte.php';?>