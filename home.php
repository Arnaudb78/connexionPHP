<?php
session_start();
/* //si la session n'est pas active on redirige vers 
// index pour éviter que des user
malveillant tente d'y accéder directement par l'url*/
if(!$_SESSION['mdp']){
    header('Location: index.php');
}
$pseudo = $_SESSION['pseudo'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Home</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body class='container-home'>
   <h2>Bienvenue <span><?php echo ($pseudo) ?></span> enjoy!</h2> 
   <a href="deconnexion.php">
        <button>Se déconnecter</button>
   </a>
    
   <!-- footer -->
   <?php include_once('footer.php'); ?>
</body>
</html>