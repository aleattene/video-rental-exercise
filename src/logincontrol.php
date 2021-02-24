<?php
include "dbconnection.php";

$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT matr_dipendente, cognome, nome, username, password, ruolo_resp, id_puntovendita
                FROM dipendenti
                WHERE username = '$username' AND password = '$password'";


$risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

$tupletrovate = mysqli_num_rows($risultato);

$tupla = mysqli_fetch_array($risultato);

if ($tupletrovate == 1) {

    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['matr_dipendente'] = $tupla["matr_dipendente"];
    $_SESSION['ruolo_resp'] = $tupla["ruolo_resp"];
    $_SESSION['id_puntovendita'] = $tupla["id_puntovendita"];
    header("Location: home.php");
} else { ?>

    <!DOCTYPE html> <!-- Inizio documento Html in Header.php e Fine in Footer.php -->

    <html lang="it">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />

        <title> BDC project </title>

        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    </head>

    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <img src="../assets/img/unigm_logo.jpg" alt="" width="240px" height="126px">
                </div>

                <div id="intestazione">
                    <h1>Università degli Studi <br> -------- </h1>
                </div>

                <div id="realizzazione">
                    <h3>Corso di Laurea in Ingegneria Informatica<br>
                        Insegnamento: -------- <br>
                        Docente: Prof. -------- <br>
                        Realizzazione: -------- <br>
                        Matricola: --------
                    </h3>
                </div>
            </div>
            <div id="container">
                <div id="subprojectlogin">
                    <form id="form" name="form" action="logincontrol.php" method="POST">
                        <p id=pform> Attenzione: nome utente e/o password errati</p>
                        <input required type="text" id="username" name="username" placeholder="Username &nbsp;(required)" maxlength="50" />

                        <input required type="password" id="password" name="password" placeholder="Password &nbsp; (required)" maxlength="50" />


                        <input type="submit" name="logincontrol" value="Effettua il Login" />
                        <input type="reset" name="reset" value="Annulla" />

                    </form>

                </div>
            </div>

        <?php }
    include "footer.php";  ?>
        </div>