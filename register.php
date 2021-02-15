<?php
require 'php/admin/db.php';
//condition si on appuie sur le bouton//
if (isset($_POST['form_submit'])) {

    //déclaration des $_POST avec leurs sécurisation//
    $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
    $mdp_confirm = password_hash($_POST['mdp_confirm'], PASSWORD_BCRYPT);
    $identifiant = htmlspecialchars($_POST['identifiant']);

    //on limite le nombres de caractéres du pseudo//
    $identifiantlength = strlen($identifiant);
    if ($identifiantlength <= 255){

        //on verifie si le pseudo est disponible//
        $verifidentifiant = $pdo->prepare("SELECT * FROM users WHERE nom = ?");
        $verifidentifiant->execute([$identifiant]);
        $resultidentifiant = $verifidentifiant->rowCount();
        if ($resultidentifiant ==0) {

            //on verifie que le mdp correspond au mdp confirm//
            if ($_POST["mdp"] == $_POST["mdp_confirm"]) {
                $sql = $pdo->prepare("INSERT INTO users (nom, mot_de_passe) VALUES (?,?)");
                $sql->execute([$identifiant, $mdp]);
                $succes = 'Votre compte à bien été créer !';
                header("Refresh: 2; url='php/login.php'");
            } else {
                $erreur = 'Les mots de passe ne corresponde pas !';
            }

        }

        else{
            $erreur = 'Ce pseudo est déja pris';
        }
    }

    else{
        $erreur = 'Votre pseudo ne doit pas dépasser 255 caractères !';
    }

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Tivo is a HTML landing page template built with Bootstrap to help you crate engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
	<meta property="og:site_name" content="" /> <!-- website name -->
	<meta property="og:site" content="" /> <!-- website link -->
	<meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>S'enregistrer</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
	<link href="css/magnific-popup.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!-- Favicon  -->
    <link rel="icon" href="images/OFP.png">
</head>
<body data-spy="scroll" data-target=".fixed-top">
    
    <!-- Preloader -->
	<div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->
    

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.php">Tivo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="index.php"><img src="images/OFP.png" alt="alternative"></a>
            
            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <!-- end of mobile menu toggle button -->

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.php#header">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.php#services">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="index.php#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="ex-2-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>S'enregistrer</h1>
                   <p>Vous avez déjà un compte ?<a class="white" href="php/login.php">Se connecter</a></p>
                    <!-- Sign Up Form -->
                    <div class="form-container">
                        <form method="post" >
                            <div class="form-group">
                                <input type="text" placeholder="Nom" class="form-control" name="identifiant" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="mot de passe" class="form-control" name="mdp" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="mdp_confirm" placeholder="Confirmer mot de passe" class="form-control">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="form_submit" class="form-control-submit-button">SIGN UP</button>
                            </div>
                            <div class="form-message">
                                <div id="smsgSubmit" class="h3 text-center hidden"></div>
                            </div>
                        </form>
                        <?php
                        if (isset($erreur)) {
                            echo "<p style='color: red'>$erreur<p>";
                        }
                        if (isset($succes)){
                            echo "<p style='color: green'>$succes</p>";
                        }
                        ?>
                    </div> <!-- end of form container -->
                    <!-- end of sign up form -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->


    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>