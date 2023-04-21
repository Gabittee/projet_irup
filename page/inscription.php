<?php

include '../fonction/bdd.php';

// Traitement de la soumission du formulaire d'ajout d'utilisateur
if (isset($_POST['nom_utilisateur']) && isset($_POST['mot_de_passe']) && isset($_POST['email']) && isset($_POST['statut']) && isset($_POST['prenom']) && isset($_POST['nom'])) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $email = $_POST['email'];
    $statut = $_POST['statut'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $sql = "INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, email, statut, prenom, nom) VALUES (:nom_utilisateur, :mot_de_passe, :email, :statut, :prenom, :nom)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->execute();
    echo "Utilisateur ajouté avec succès à la base de données !";
}

// Traitement de la soumission du formulaire de suppression d'utilisateur
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM utilisateurs WHERE ID = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "Utilisateur supprimé avec succès de la base de données !";
}

// Récupération de tous les utilisateurs depuis la base de données
$sql = 'SELECT ID, nom_utilisateur, mot_de_passe, email, statut, prenom, nom FROM utilisateurs';
$stmt = $bdd->prepare($sql);
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajouter ou supprimer un utilisateur</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #dddddd;
        }
    </style>
    <link rel="stylesheet" href="../formulaire.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php include '../navbar.html';?>
</head>
<body>


    <h1>Ajouter un utilisateur</h1>
    <div class="container">
    <form method="post">
        <div class="row">
            <div class="col-md-6">
                <label for="nom_utilisateur">Nom d'utilisateur :</label>
                <input class="form-control" type="text" name="nom_utilisateur" id="nom_utilisateur">
            </div>
            <div class="col-md-6">
                <label for="mot_de_passe">Mot de passe :</label>
                <input class="form-control" type="password" name="mot_de_passe" id="mot_de_passe">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="email">Email :</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>
            <div class="col-md-6">
                <label for="statut">Statut :</label>
                <select class="form-control" name="statut" id="statut">
                    <option value="admin">Administrateur</option>
                    <option value="utilisateur">Utilisateur</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="prenom">Prénom :</label>
                <input class="form-control" type="text" name="prenom" id="prenom">
            </div>
            <div class="col-md-6">
                <label for="nom">Nom :</label>
                <input class="form-control" type="text" name="nom" id="nom">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">S'inscrire</button>
            </div>
        </div>
    </form>
</div>


<h2>Liste des utilisateurs :</h2>
<table>
    <thead>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Mot de passe</th>
            <th>Email</th>
            <th>Statut</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($utilisateurs as $utilisateur) { ?>
            <tr>
                <td><?php echo $utilisateur['nom_utilisateur']; ?></td>
                <td><?php echo $utilisateur['mot_de_passe']; ?></td>
                <td><?php echo $utilisateur['email']; ?></td>
                <td><?php echo $utilisateur['statut']; ?></td>
                <td><?php echo $utilisateur['prenom']; ?></td>
                <td><?php echo $utilisateur['nom']; ?></td>
                <td>
                    <form method="post" style="display:inline-block">
                        <input type="hidden" name="delete_id" value="<?php echo $utilisateur['ID']; ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>