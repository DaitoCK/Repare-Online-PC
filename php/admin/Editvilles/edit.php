<?php
require '../db.php';

$id = $_GET["lign_update"];

$id = intval($id);

$sql = $pdo->prepare("SELECT * FROM villes WHERE id = '$id'");
$sql->execute();
$villes = $sql->fetch();


if(isset($_POST['btn-update'])){
    $nom_ville = $_POST['ville_name'];
    $adress_ville = $_POST['ville_adress'];
    $tel = $_POST['tel'];
    $lat = $_POST['ville_lat'];
    $lon = $_POST['ville_lon'];
    $horaires = $_POST['horaires'];

    $update = $pdo->prepare("UPDATE villes SET Villes='$nom_ville', adresse='$adress_ville', tel='$tel', lat='$lat', lon='$lon', horaires='$horaires' WHERE id = '$id'");
    $update->execute();
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Administration</title>
</head>
<body>
<div>
    <h3 style="margin-top: 100px">Ajouter une ville</h3>
    <form method="POST" class="form-group">

        <input type="text" name="ville_name"  class="form-control w-50 mt-2" value="<?= $villes['Villes']?>">

        <input type="text" name="ville_adress"  class="form-control w-50 mt-2" value="<?= $villes['adresse']?>">

        <input type="text" name="tel"  class="form-control w-50 mt-2" value="<?= $villes['tel']?>">

        <input type="text" name="ville_lat"  class="form-control w-50 mt-2" value="<?= $villes['lat']?>">

        <input type="text" name="ville_lon" class="form-control w-50 mt-2" value="<?= $villes['lon']?>">

        <input type="text" name="horaire"  class="form-control w-50 mt-2" value="<?= $villes['horaire']?>">

        <button type="submit" name="btn-update" class="btn btn-primary mt-2">Enregistrer</button>

        <a href="../gererlesvilles/edit_ville.php" class="btn btn-secondary" style="margin-top: 10px">Liste des villes</a>

        <?php if (isset($_POST['btn-update'])){
            echo '<div class="alert alert-success" role="alert">
            
  Enregistrer avec succés !
</div>';
            header('Location: ../EditVilles/edit_ville.php');
        }
        ?>
    </form>
</div>
</body>
</html>