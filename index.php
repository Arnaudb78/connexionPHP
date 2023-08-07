<?php
// je déclare la session qui permet au User de naviguer entre plusieurs page et resté connecté
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body class='container'>
    <div class='container-header'>
        <!-- header -->
        <?php include_once('header.php'); ?>
    </div>
    <div class='container-form'>
        <!-- Inscription Form -->
        <?php include_once('inscription.php');?>
        <!-- Connexion Form -->
        <?php include_once('connexion.php'); ?>
    </div>
    

    <!-- footer -->
    <?php include_once('footer.php'); ?>
    
</body>
</html>