<?php

include 'bdd.php';

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['id_carte']) && isset($_POST['classe']) && isset($_POST['statut'])) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $id_carte = $_POST['id_carte'];
  $classe = $_POST['classe'];
  $statut = $_POST['statut'];
  $sql = "INSERT INTO eleves (nom, prenom, email, id_carte, classe, statut) VALUES (:nom, :prenom, :email, :id_carte, :classe, :statut)";
  $stmt = $bdd->prepare($sql);
  $stmt->bindParam(':nom', $nom);
  $stmt->bindParam(':prenom', $prenom);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':id_carte', $id_carte);
  $stmt->bindParam(':classe', $classe);
  $stmt->bindParam(':statut', $statut);
  $stmt->execute();
  echo "Elève ajouté avec succès à la base de données !";
}


// Traitement de la soumission du formulaire de suppression d'utilisateur
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM eleves WHERE ID = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "Utilisateur supprimé avec succès de la base de données !";
}

// Récupération de tous les utilisateurs depuis la base de données
$sql = "SELECT ID, nom, prenom, id_carte, email
FROM eleves
WHERE classe = '$classeChoisie'";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4">Liste des élèves</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="">
                <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Email</th>
                  <th>Id_carte</th>
                  <th>Supprimer</th>
                  <th>Détails</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($utilisateurs as $utilisateur) { ?>
                <tr>
                  <td><?php echo $utilisateur['nom']; ?></td>
                  <td><?php echo $utilisateur['prenom']; ?></td>
                  <td><?php echo $utilisateur['email']; ?></td>
                  <td><?php echo $utilisateur['id_carte']; ?></td>
                  <td>
                    <form method="POST" action="">
                      <input type="hidden" name="delete_id" value="<?php echo $utilisateur['ID']; ?>">
                      <button type="submit" class="btn btn-primary">Supprimer</button>
                    </form>
                  </td>
                  <td>
                    <form method="POST" action="details.php">
                      <input type="hidden" name="nom" value="<?php echo $utilisateur['nom']; ?>">
                      <input type="hidden" name="prenom" value="<?php echo $utilisateur['prenom']; ?>">
                      <input type="hidden" name="id_carte" value="<?php echo $utilisateur['id_carte']; ?>"> <!-- Champ caché pour stocker la valeur de "id_carte" -->
                      <button type="submit" class="btn btn-primary">Détails</button>
                    </form>
                  </td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<h1>Ajouter un utilisateur</h1>
    <div class="container">
    <form method="post">
        <div class="row">
            <div class="col-md-6">
                <label for="nom">Nom</label>
                <input class="form-control" type="text" name="nom" id="nom">
            </div>
            <div class="col-md-6">
                <label for="prenom">Prénom</label>
                <input class="form-control" type="test" name="prenom" id="prenom">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>
            <div class="col-md-6">
                <label for="classe">Classe</label>
                <select class="form-control" name="classe" id="classe">
                    <option value="BTSS21">BTSS21</option>
                    <option value="BTSS22">BTSS22</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="id_carte">Id_carte</label>
                <input class="form-control" type="text" name="id_carte" id="id_carte">
            </div>
            <div class="col-md-6">
                <label for="statut">Statut</label>
                <select class="form-control" name="statut" id="statut">
                    <option value="admin">eleve</option>
                    <option value="user">intervenant</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">S'inscrire</button>
            </div>
        </div>
    </form>
</div>
