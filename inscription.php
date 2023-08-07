<?php
//variable et mot de passe du compte phpmyadmin 
$admin = 'root';
$pass = 'root';

//connexion à la DB via PDO
$bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', $admin, $pass);
//isset vérifie que la variable existe
if(isset($_POST['envoi'])){
    //je vérifie que les champs pseudo et mdp ne sont pas vide 
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        // on utilise htmlspecialchars pour encoder l'entrée
        $pseudo = htmlspecialchars($_POST['pseudo']);
        // j'utilise sha1 pour hasher le password
        $mdp = sha1($_POST['mdp']);

        // je declare la variable insertUser pour insérer un USER en DB
        $insertUser = $bdd->prepare('INSERT INTO users(pseudo, mdp)VALUES(?, ?)');
        // on demande à php de nous renvoyer un tableau
        $insertUser-> execute(array($pseudo, $mdp));

        //cette requête me sert à récupérer l'id du USER en DB
        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
        $recupUser->execute(array($pseudo, $mdp));
        //Si le USER existe ( que c'est sup à 0)
        if($recupUser->rowCount() > 0){

            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            // je fetch pour tout récupérer et je cible le champs ID
            $_SESSION['id'] = $recupUser->fetch()['id']; 
            header('Location: home.php');
        }

      

    } else {
        echo "Veuillez compléter tous les champs...";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Inscription</title>
</head>
<body>
        <form action="" method="post" class='form'>
            <h2>Inscrivez-vous :</h2>
            <input type="text" name="pseudo" placeholder='Créez votre Pseudo' class='form-input'>
            <br/>
            <input type="password" name="mdp" placeholder='Créez votre Mot de passe' class='form-input'>

            <br/><br/>
            <input type="submit" name="envoi" class='form-btn'>

        </form>
</body>
</html>