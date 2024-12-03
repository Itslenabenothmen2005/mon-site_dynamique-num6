
Soit la base de données décrite par la représentation textuelle suivante :
Sondage (NumS, Theme, DateDebut)
Question (NumQ, NumS#, Contenu)
Reponse (NumQ#, NumS#, IdParticipant, Rep)
Participant (IdParticipant, Mail, Mdp, Genre)
N.B : ci-dessous la description des champs
Champ Type Observation
NumS Entier auto incrémenté Numéro du sondage
Theme Chaîne de taille 50 Thème du sondage
DateDebut Date Date de lancement du sondage
NumQ Entier Numéro de la question
Contenu Chaîne de taille 150 Contenu de la question
IdParticipant Entier auto incrémenté Numéro du participant
Rep Caractère
Réponse d'un participant relative à
une question et qui aura comme va-
leur :
− "O" pour exprimer "Oui"
− "N" pour exprimer "Non"
− "S" pour exprimer "Sans avis"
IdParticipant Entier auto incrémenté Numéro du participant
Mail Chaîne de taille 50 Adresse mail du participant
Mdp Chaîne de taille 6 Mot de passe du participant
Genre Caractère
Genre du participant et qui aura
comme valeur :
− "M" pour le genre "Masculin"
− "F" pour le genre "Féminin"


mon travaille consiste à:

✓ d'afficher "Erreur d'authentification" dans le cas où l'adresse mail saisie existe dans la base
mais avec un mot de passe différent de la valeur du champ "Mot de passe" du formulaire,
ou bien,
✓ d'enregistrer les nouvelles réponses au sondage actuel et d'afficher le message "Mise à jour
effectuée avec succès" dans le cas où le participant ayant l'adresse mail saisie, a déjà envoyé
une réponse au sondage actuel
ou bien,
✓ d'enregistrer les réponses au sondage actuel et d'afficher le message "Participation au son-
dage effectuée avec succès" dans le cas où le participant ayant l'adresse mail saisie, n'a pas
participé au sondage actuel
ou bien,
✓ d'ajouter ce participant à la base, d'enregistrer ses réponses au sondage actuel et d'afficher
le message "Inscription et participation au sondage effectuées avec succès", dans le cas
où le couple des valeurs des champs "@Mail" et "Mot de passe" n'existe pas dans la base.
voici mon travaille:
<?php

$email=$_POST['email'];
$mp=$_POST['mp'];
$g=$_POST['genre'];
$r1=$_POST['q1'];
$r2=$_POST['q2'];
$r3=$_POST['q3'];
$cnx=mysqli_connect('localhost','root','','bac_2019')or die("pb cnx".mysqli_error($cnx));
$req1="select * from  participant  where '$email'=Mail;";
$res1=mysqli_query($cnx,$req1)or die("pb req1".mysqli_error($cnx));
if(mysqli_num_rows($res1)>0){
    $t=mysqli_fetch_array($res1);
    if($t[2]!=$mp){
        die("Erreur d'authentification ");
    }
    $req2="select * from reponse where idparticipant='$t[0]' ; ";
    $res2=mysqli_query($cnx,$req2)or die("pb req2".mysqli_error($cnx));
    if(mysqli_num_rows($res2)>0){
    $req4="update reponse set(1,1,$t[0],$r1),(2,1,$t[0],$r2),(3,1,$t[0],$r1) where idparticipant ='$t[0]';";
    mysqli_query($cnx,$req4)or die("pb req4".mysqli_error($cnx));
    if(mysqli_affected_rows($cnx)>0)echo( "Mise à jour
    effectuée avec succès" );
    }
    else{
        $req5="insert into reponse values(1,1,$t[0],$r1);";
        $req6="insert into reponse values(2,1,$t[0],$r2);";
        $req7="insert into reponse values(3,1,$t[0],$r1);";
        mysqli_query($cnx,$req5)or die("pb req5".mysqli_error($cnx));
        mysqli_query($cnx,$req6)or die("pb req6".mysqli_error($cnx));
        mysqli_query($cnx,$req7)or die("pb req7".mysqli_error($cnx));
        if(mysqli_affected_rows($cnx)>0)echo( "Participation au son-
        dage effectuée avec succès" );
    
    }
}
else{
    $req8="insert into reponse(numq,nums,rep)values (1,1,$r1);";
    $req9="insert into reponse(numq,nums,rep)values (2,1,$r2);";
    $req9="insert into reponse(numq,nums,rep)values (3,1,$r3);";
    mysqli_query($cnx,$req5)or die("pb req5".mysqli_error($cnx));
    mysqli_query($cnx,$req6)or die("pb req6".mysqli_error($cnx));
    mysqli_query($cnx,$req7)or die("pb req7".mysqli_error($cnx));
    if(mysqli_affected_rows($cnx)>0)echo( "Inscription et participation au sondage effectuées avec succès" );
    
}
mysqli_close($cnx);
?>
