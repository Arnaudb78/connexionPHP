<?php
session_start();

$admin ='root';
$pass = 'root';

$bdd = new PDO('mysql:host=localhost;dbnam=espace_membres;charset=utf8;', $admin, $pass);

// isset() sert à vérifier qu'une variable existe
if(isset($_POST['envoi'])){
    //empty permet de verifier que le champs n'est pas vide 
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        //htmlspecialchars permet d'eviter l'insertion de code html si il y a un utilisateur malveillant...
        $pseudo = htmlspecialchars($_POST['pseudo']);
        //sha1 est un module qui permet de hasher le mdp 
        $mdp = sha1($_POST["mdp"]);
        //on va maintenant récupérer les users qui possède le pseudo et le password de le DB grâce à une requête SQL
        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
        //ici cela nous renvoie un tableau des infos demandées en fonction des entrées du formulaire 
        $recupUser->execute(array($pseudo, $mdp));

        //si on trouve un user dans la table
        if($recupUser->rowCount() > 0){

            //on déclare les sessions propres à l'utilisateur 
            $_SESSION['pseudo'] = $pseudo;
            //l'email correspond à l'email, idem pour le password entrée dans le form
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $recupUser->fetch()['id'];
            echo "j'ai reussis";
            //on renvoie l'utilisateur vers la page cible 
            
            
            //si on a aucun élément on affiche un message d'erreur     
        }else{
                echo "Votre mot de passe ou email est incorrect";
            }
        
    } else{
        //echo permet d'afficher un message 
        echo "Veuillez remplir tout les champs..";
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
<body align='center'>
    <form action="" method="post">

        <input type="text" name='pseudo'>
        <br/>
        <input type="password" name='mdp'>
        <br/><br/>
        <input type="submit" name='envoi'>

    </form>
</body>
</html>