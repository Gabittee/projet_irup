<?php

include 'bdd.php';


$sql = "SELECT eleves.nom, eleves.prenom, eleves.statut, donnees_utilisateurs.pointage_1, donnees_utilisateurs.pointage_2 
        FROM donnees_utilisateurs 
        INNER JOIN eleves ON donnees_utilisateurs.id_carte = eleves.id_carte 
        WHERE donnees_utilisateurs.jour = '$dateChoisie' AND eleves.classe = '$classeChoisie'";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pointageIntervenant = null;
$pointage2Intervenant = null;

foreach($utilisateurs as $utilisateur) {
    if($utilisateur['statut'] == 'intervenant') {
        if(isset($utilisateur['pointage_1'])) {
            $pointageIntervenant = $utilisateur['pointage_1'];
        }
        if(isset($utilisateur['pointage_2'])) {
            $pointage2Intervenant = $utilisateur['pointage_2'];
        }
    }
}
?>

<?php echo "Le cours du matin a commencer à : " . $pointageIntervenant;?>
<br>
<?php echo "Le cours de l'après-midi a commencer à  : " . $pointage2Intervenant;?>

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
                  <th>Pointage 1</th>
                  <th>Pointage 2</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($utilisateurs as $utilisateur) {
                  if($utilisateur['statut'] === 'eleve' && ((isset($utilisateur['pointage_1']) && $utilisateur['pointage_1'] > $pointageIntervenant) || (isset($utilisateur['pointage_2']) && $utilisateur['pointage_2'] > $pointage2Intervenant))){ ?>
                  <tr>
                      <td><?php echo $utilisateur['nom']; ?></td>
                      <td><?php echo $utilisateur['prenom']; ?></td>
                      <td style="<?php if(isset($utilisateur['pointage_1']) && $utilisateur['pointage_1'] > $pointageIntervenant) {echo 'background-color: #FCC6C6;';} ?>"><?php echo $utilisateur['pointage_1']; ?></td>
                      <td style="<?php if(isset($utilisateur['pointage_2']) && $utilisateur['pointage_2'] > $pointage2Intervenant) {echo 'background-color: #FCC6C6;';} ?>"><?php echo $utilisateur['pointage_2']; ?></td>
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