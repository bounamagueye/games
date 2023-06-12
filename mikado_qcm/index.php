<?php
    //démarrer  la session
    session_start();
    //verifier l'envoi du  formulaire
    if(isset($_POST['button'])){
        //vérifier que le champs nom n'est pas vide
        if(isset($_POST['name']) && $_POST['name'] != ""){
           //créer une variable session qui vas comporté le pseudo
           $_SESSION['name'] = $_POST['name'];
           //redirection vers la page qcm
           header('location:niveau.php');
        }else{
            //si le champ est vide
            $error = "veillez choisir un pseudo !";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pseudo Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  
<!-- nous allons inclure le menu dans toutes les pages-->
 <?php include "menu.php" ?>
    <section class="pseudo">
        <form action="index.php" method="POST">
            <p class="error">
                <?php
                //afficher l'erreur si elle existe
                if(isset($error)) echo $error;
                ?>

            </p>
            <label>Entrez votre pseudo</label>
            <!--mettons le pseudo dans l'input si la variable session pseudo existe-->
            <input type="text" name="name" placeholder="Ex: faiz"
            value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name'] ?>">
            <button class="style_btn" name="button">soumettre</button>
        </form>
    </section>
</body>
</html>