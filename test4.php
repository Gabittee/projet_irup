<?php



try {
    $bdd = new PDO("mysql:host=localhost;dbname=site;charset=utf8", "root", "");
} catch (Exception $e) {
    die("Erreur : ".$e -> getMessage());
}



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

// Récupération de tous les utilisateurs depuis la base de données
$sql = "SELECT ID, nom, prenom, id_carte, email
FROM eleves";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


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