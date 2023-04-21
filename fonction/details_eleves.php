<?php

include 'bdd.php';

if (isset($_POST['id_carte'])) {
  $id_carte = $_POST['id_carte'];
  echo "ID carte : " . $id_carte;
}

$sql = "SELECT eleves.nom, eleves.prenom, donnees_utilisateurs.jour, eleves.statut, donnees_utilisateurs.pointage_1, donnees_utilisateurs.pointage_2 
        FROM donnees_utilisateurs 
        INNER JOIN eleves ON donnees_utilisateurs.id_carte = eleves.id_carte
        WHERE donnees_utilisateurs.id_carte = $id_carte";
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
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>jour</th>
                  <th>Pointage 1</th>
                  <th>Pointage 2</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($utilisateurs as $utilisateur) { ?>
                  <tr>
                      <td><?php echo $utilisateur['nom']; ?></td>
                      <td><?php echo $utilisateur['prenom']; ?></td>
                      <td><?php echo $utilisateur['jour']; ?></td>
                      <td><?php echo $utilisateur['pointage_1']; ?></td>
                      <td><?php echo $utilisateur['pointage_2']; ?></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4">Liste des absences (période)</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Pointage 1</th>
                  <th>Pointage 2</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($utilisateurs as $utilisateur) {
                  if($utilisateur['statut'] === 'eleve' && (empty($utilisateur['pointage_1']) || empty($utilisateur['pointage_2']))){ ?>
                      <tr>
                          <td><?php echo $utilisateur['nom']; ?></td>
                          <td><?php echo $utilisateur['prenom']; ?></td>
                          <td style="<?php if(empty($utilisateur['pointage_1'])) {echo 'background-color: #FCC6C6;';} ?>"><?php echo $utilisateur['pointage_1']; ?></td>
                          <td style="<?php if(empty($utilisateur['pointage_2'])) {echo 'background-color: #FCC6C6;';} ?>"><?php echo $utilisateur['pointage_2']; ?></td>
                      </tr>
                  <?php }
              } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
