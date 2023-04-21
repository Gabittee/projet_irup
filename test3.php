<?php

include 'bdd.php';

// Traitement de la soumission du formulaire d'ajout d'utilisateur
if (isset($_POST['nom_utilisateur']) && isset($_POST['prenom']) && isset($_POST['classe']) && isset($_POST['statut']) && isset($_POST['pointage_1']) && isset($_POST['pointage_2']) && isset($_POST['pointage_3']) && isset($_POST['pointage_4'])) {
  $nom_utilisateur = $_POST['nom_utilisateur'];
  $prenom = $_POST['prenom'];
  $classe = $_POST['classe'];
  $statut = $_POST['statut'];
  $pointage_1 = $_POST['pointage_1'];
  $pointage_2 = $_POST['pointage_2'];
  $pointage_3 = $_POST['pointage_3'];
  $pointage_4 = $_POST['pointage_4'];
  $sql = "INSERT INTO donnees_utilisateurs (nom_utilisateur, prenom, classe, statut, pointage_1, pointage_2, pointage_3, pointage_4) VALUES (:nom_utilisateur, :prenom, :classe, :statut, :pointage_1, :pointage_2, :pointage_3, :pointage_4)";
  $stmt = $bdd->prepare($sql);
  $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
  $stmt->bindParam(':prenom', $prenom);
  $stmt->bindParam(':classe', $classe);
  $stmt->bindParam(':statut', $statut);
  $stmt->bindParam(':pointage_1', $pointage_1);
  $stmt->bindParam(':pointage_2', $pointage_2);
  $stmt->bindParam(':pointage_3', $pointage_3);
  $stmt->bindParam(':pointage_4', $pointage_4);
  $stmt->execute();
  echo "Utilisateur ajouté avec succès à la base de données !";
}

// Traitement de la soumission du formulaire de suppression d'utilisateur
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM donnees_utilisateurs WHERE ID = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "Utilisateur supprimé avec succès de la base de données !";
}

// Récupération de tous les utilisateurs depuis la base de données
$sql = "SELECT ID, nom_utilisateur, prenom, classe, statut, pointage_1, pointage_2, pointage_3, pointage_4 
FROM donnees_utilisateurs 
WHERE classe = '$classeChoisie' 
  AND jour = '$dateChoisie'
  AND (pointage_1 > '08:30:00' or pointage_3 > '13:30:00');
";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Liste des retards (période)</h5>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="">
                  <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pointage 1</th>
                    <th>Pointage 2</th>
                    <th>Pointage 3</th>
                    <th>Pointage 4</th>
                    <th>Anomalie</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($utilisateurs as $utilisateur) { ?>
                    <tr>
                        <td><?php echo $utilisateur['nom_utilisateur']; ?></td>
                        <td><?php echo $utilisateur['prenom']; ?></td>
                        <td style="<?php if($utilisateur['pointage_1'] > '08:30:00') {echo 'background-color: #F08484 ;';} ?>"><?php echo $utilisateur['pointage_1']; ?></td>
                        <td><?php echo $utilisateur['pointage_2']; ?></td>
                        <td style="<?php if($utilisateur['pointage_3'] > '13:30:00') {echo 'background-color: #F08484 ;';} ?>"><?php echo $utilisateur['pointage_3']; ?></td>
                        <td><?php echo $utilisateur['pointage_4']; ?></td>
                        <td><?php echo $utilisateur['statut']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>