<?php

session_start();

unset($_SESSION['auth']);

$_SESSION['flash']['success-logout'] = "Vous êtes déconnecter !";

header('Location: ../index.php');

