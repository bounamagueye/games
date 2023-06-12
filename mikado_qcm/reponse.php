<?php
//démarer la session
session_start();
//verifier si les variables session name et niveau existe
if(!isset($_SESSION['name'])){
    header('location:index.php'); //si le pseudo n'existe pas redirection
    //vers index.php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat QCM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    //menu
    include "menu.php"
    ?>
    <section class="resultats">
        <h1>Résultat du QCM de 
            <span class="change_color"><?=$_SESSION['name']?></span>
        </h1>
        <?php 
             include "connect.php";
             $note = 0;
             foreach($_POST as $cle=>$val){
                //$scle représente idq (identifiant de la question) et $val représente idr (l'identifiant de sa réponse)
                //cette reponse nous opermet d'afficher la bonne rèponse
                $req = "SELECT * FROM reponses WHERE idr = $val AND verite = 1";
                //execution
                $res= mysqli_query($id, $req);
                if(mysqli_num_rows($res)>0){
                    //si cette réponse retourne un nombre de ligne > 0 on ajoute 4 a la note 
                    $note  = $note +4;
                }else{
                    //sinon
                    ?>
                     <p class="color">Tu t'es planté à la question <?=$cle?> : </p>
                        <?php
                            //liste des questions qui ont été mal répondues
                            $req2 = "SELECT * FROM questions WHERE idq =$cle";
                            $res2 = mysqli_query($id,$req2);
                            $ligne = mysqli_fetch_assoc($res2);
                        ?>
                      <p class="question_error"><?=$ligne['libelleQ']?></p>
                      <p class="color">Il fallait répondre</p>
                            <?php
                            //liste vrais rèponses
                            $req3 = "SELECT * FROM reponses WHERE idq =$cle AND verite=1";
                            $res3 = mysqli_query($id,$req3);
                            $ligne3 = mysqli_fetch_assoc($res3);
                            ?>
                            <p class="reponse_vrai"><?=$ligne3['libeller']?></p>
                    <?php
                }
                
             }
        ?>
         <?php
             //changer la couleur de la note

             if($note < 10){
                echo "<style> .note_value{ color: red ;}</style>";
             }else if($note  == 10){
                echo "</style> .note_value{ color:orange ;}</style>";
             }else {
                echo "<style> .note_value{ color:green ;}</style>";
             }
         ?>


        <p class="note">tu as eu <span class="note_value"><?=$note?> / 20</span></p>
    </section>
</body>
</html>