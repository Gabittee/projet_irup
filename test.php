<?php

include 'fonction/bdd.php';

// Traitement de la soumission du formulaire d'ajout de jeu
if (isset($_POST['nom_utilisateur']) && isset($_POST['mot_de_passe']) && isset($_POST['email']) && isset($_POST['statut']) && isset($_POST['prenom'])) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $email = $_POST['email'];
    $statut = $_POST['statut'];
    $prenom = $_POST['prenom'];
    $sql = "INSERT INTO jeux (nom_utilisateur, mot_de_passe, email, statut, prenom) VALUES (:nom_utilisateur, :mot_de_passe, :email, :statut, :prenom)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->execute();
    echo "Jeu ajouté avec succès à la base de données !";
}

// Traitement de la soumission du formulaire de suppression de jeu
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM jeux WHERE ID = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "Jeu supprimé avec succès de la base de données !";
}

// Récupération de tous les jeux depuis la base de données
$sql = 'SELECT ID, nom_utilisateur, mot_de_passe, email, statut, prenom FROM jeux';
$stmt = $bdd->prepare($sql);
$stmt->execute();
$jeux = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajouter, modifier ou supprimer un jeu</title>
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

    <link rel="stylesheet" href="formulaire.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
                    <option value="user">Utilisateur</option>
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


    <h2>Liste des jeux :</h2>
    <table>
        <thead>
            <tr>
                <th>Nom du jeu</th>
                <th>Description</th>
                <th>Icône</th>
                <th>ROM</th>
                <th>Console</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jeux as $jeu) { ?>
                <tr>
                    <td>
                        <form method="post">
                            <input type="hidden" name="update_id" value="<?php echo $jeu['ID']; ?>">
                            <input type="text" name="nom_utilisateur" value="<?php echo $jeu['nom_utilisateur']; ?>">
                    </td>
                    <td><textarea name="description" rows="3"><?php echo $jeu['Description']; ?></textarea></td>
                    <td><input type="text" name="icon" value="<?php echo $jeu['Icon']; ?>"></td>
                    <td><input type="text" name="rom" value="<?php echo $jeu['ROM']; ?>"></td>
                    <td><input type="text" name="console" value="<?php echo $jeu['Console']; ?>"></td>
                    <td>
                        <input type="submit" value="Modifier">
                        </form>
                        <form method="post" style="display:inline-block">
                            <input type="hidden" name="delete_id" value="<?php echo $jeu['ID']; ?>">
                            <input type="submit" value="Supprimer">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>