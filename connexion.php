<?php
session_start();

$admin = 'root';
$pass = 'root';

$bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8;', $admin, $pass);
if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = sha1($_POST['mdp']);

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
        $recupUser->execute(array($pseudo, $mdp));

        if($recupUser->rowCount() > 0){
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $recupUser->fetch()['id'];
            header('Location: index.php');

        }else {
            echo "Votre pseudo ou mot de passe est incorrect..";
        }

    }else{
    echo "Veuillez compléter tous les champs...";
} 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <form method="POST" action="" align='center'>

        <input type="text" name='pseudo'>
        <br/>
        <input type="password" name='mdp'>
        <br/><br/>
        <input type="submit" name='envoi'>

    </form>
</body>
</html>