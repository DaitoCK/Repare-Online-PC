<?php
include '../db.php';


if (isset($_POST['form_submit'])) {
    $centre = $_POST['centre'];
    $nom = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['phone'];
    $msg = $_POST['message'];


    $insert = $pdo->prepare("INSERT INTO rdv (centre, email, nom, telephone, message) VALUES ('$centre', '$nom', '$email', '$tel', '$msg')");
    $insert->execute();

    header('Location: ../../index.php');
}
?>