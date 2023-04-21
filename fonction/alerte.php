<?php

include 'bdd.php';

// Traitement de la soumission du formulaire d'ajout d'alerte
if (isset($_POST['alerte']) ) {
  $alerte = $_POST['alerte'];
  $sql = "INSERT INTO alerte_classe (alerte) VALUES (:alerte)";
  $stmt = $bdd->prepare($sql);
  $stmt->bindParam(':alerte', $alerte);
  $stmt->execute();
  echo "alerte ajouté avec succès à la base de données !";
}

// Traitement de la soumission du formulaire de suppression d'alerte
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM alerte_classe WHERE ID = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "alerte supprimé avec succès de la base de données !";
}

// Récupération de tous les alertes depuis la base de données
$sql = "SELECT ID, alerte FROM alerte_classe WHERE classe = '$classeChoisie' and jour = '$dateChoisie'";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$alertes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Alerte</h5>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Alerte</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($alertes as $alerte) { ?>
                    <tr>
                        <td><?php echo $alerte['alerte']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>