<?php

require_once '../db.php';

$id = $_REQUEST["lign_delete"];

$id = intval($id);

$sql = $pdo->prepare("DELETE FROM `rdv` WHERE id = $id");
$sql->execute();

header('Location: ../Editvilles/edit_ville.php');