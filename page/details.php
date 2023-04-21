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
if (isset($_POST['date']) && isset($_POST['classe'])) {
  $dateChoisie = $_POST['date'];
  $classeChoisie = $_POST['classe'];
  // Faites quelque chose avec les variables $dateChoisie et $classeChoisie ici
  // Par exemple, vous pouvez les utiliser pour exécuter une requête SQL pour récupérer des données de la base de données et les afficher sur la page.
} elseif (isset($_GET['date']) && isset($_GET['classe'])) {
  $dateChoisie = $_GET['date'];
  $classeChoisie = $_GET['classe'];
}

?>

<?php include '../fonction/details_eleves.php';?>