<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Modification de mot de passe</title>
  <?php include 'navbar.html';?>
  <link rel="stylesheet" href="formulaire.css" type="text/css" media="screen" />

</head>
<body>
  <div class="container mt-5">
    <h1>Modification de mot de passe</h1>
    <form>
      <div class="form-group">
        <div class="class">
          <label for="username">Nom d'utilisateur</label>
          <input type="text" class="form-control" id="username" placeholder="Entrez votre nom d'utilisateur">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-6">
          <label for="password">Nouveau mot de passe</label>
          <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe">
        </div>
        <div class="col-sm-6">
          <label for="password">Code à 4 chiffres*</label>
          <input type="password" class="form-control" id="password" placeholder="Entrez votre code à 4 chiffres">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
  </div>
</body>
</html>