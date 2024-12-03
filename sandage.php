<?php

$email = $_POST['mail'];
$mp = $_POST['mp'];
$g = $_POST['genre'];
$r1 = $_POST['q1'];
$r2 = $_POST['q2'];
$r3 = $_POST['q3'];

$cnx = mysqli_connect('localhost', 'root', '', 'bac_2019') or die("pb cnx" . mysqli_error($cnx));

$req1 = "SELECT * FROM participant WHERE '$email' = Mail;";
$res1 = mysqli_query($cnx, $req1) or die("pb req1" . mysqli_error($cnx));

if (mysqli_num_rows($res1) != 0) {
    $t = mysqli_fetch_array($res1);
    if ($t[2] != $mp) {
        die("Erreur d'authentification ");
    }
    $id = $t[0];
    $req2 = "SELECT * FROM reponse WHERE idparticipant='$id';";
    $res2 = mysqli_query($cnx, $req2) or die("pb req2" . mysqli_error($cnx));

    if (mysqli_num_rows($res2) != 0) {
        $req4 = "UPDATE reponse SET rep='$r1' WHERE idparticipant='$id' AND numq='1' AND nums='1';";
        $req11 = "UPDATE reponse SET rep='$r2' WHERE idparticipant='$id' AND numq='2' AND nums='1';";
        $req12 = "UPDATE reponse SET rep='$r3' WHERE idparticipant='$id' AND numq='3' AND nums='1';";

        mysqli_query($cnx, $req4) or die("pb req4" . mysqli_error($cnx));
        mysqli_query($cnx, $req11) or die("pb req11" . mysqli_error($cnx));
        mysqli_query($cnx, $req12) or die("pb req12" . mysqli_error($cnx));

        if (mysqli_affected_rows($cnx) > 0) {
            echo "Mise à jour effectuée avec succès";
        }
    } else {
        $req5 = "INSERT INTO reponse(numq, nums, idparticipant, rep) VALUES (1, 1, $id, '$r1'), (2, 1, $id, '$r2'), (3, 1, $id, '$r3');";
        mysqli_query($cnx, $req5) or die("pb req5" . mysqli_error($cnx));

        if (mysqli_affected_rows($cnx) > 0) {
            echo "Participation au sondage effectuée avec succès";
        }
    }
} else {
    $reqins = "INSERT INTO participant (mail, mdp, genre) VALUES ('$email', '$mp', '$g');";
    mysqli_query($cnx, $reqins) or die("pb reqIns" . mysqli_error($cnx));

    if (mysqli_affected_rows($cnx)) {
        $reqq = "SELECT idparticipant FROM participant WHERE mail='$email';";
        $ress = mysqli_query($cnx, $reqq) or die("pb reqq" . mysqli_error($cnx));
        $ta = mysqli_fetch_array($ress);
        $id = $ta[0];

        $reqInsert = "INSERT INTO reponse VALUES ($id, 1, 1, '$r1'), ($id, 2, 1, '$r2'), ($id, 3, 1, '$r3');";
        mysqli_query($cnx, $reqInsert) or die("pb reqInsert" . mysqli_error($cnx));

        if (mysqli_affected_rows($cnx) > 0) {
            echo "Inscription et participation au sondage effectuées avec succès";
        }
    }
}

mysqli_close($cnx);
?>
