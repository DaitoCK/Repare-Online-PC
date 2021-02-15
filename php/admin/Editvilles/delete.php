<?php

    require_once '../db.php';

    $id = $_REQUEST["lign_delete"];

    $id = intval($id);

    $sql = $pdo->prepare("DELETE FROM `villes` WHERE id = $id");
    $sql->execute();

header('Location: edit_ville.php');