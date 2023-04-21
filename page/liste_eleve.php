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
$classeChoisie = "";
if (isset($_POST['classe'])) {
  $classeChoisie = $_POST['classe'];
  // Faites quelque chose avec les variables $dateChoisie et $classeChoisie ici
  // Par exemple, vous pouvez les utiliser pour exécuter une requête SQL pour récupérer des données de la base de données et les afficher sur la page.
} elseif (isset($_GET['classe'])) {
  $classeChoisie = $_GET['classe'];
}

?>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Sélectionner une classe</h5>
            <form method="post">
              <div class="form-group">
                <label for="classe-select" >Classe</label>
                <select class="form-control" name="classe" id="classe-select">
                  <option value="BTSS21" <?php if ($classeChoisie == "BTSS21") echo "selected"; ?>>BTSS21</option>
                  <option value="BTSS22" <?php if ($classeChoisie == "BTSS22") echo "selected"; ?>>BTSS22</option>
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



<?php include '../fonction/liste_totale.php';?>