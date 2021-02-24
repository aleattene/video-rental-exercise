<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>

        <?php
        if (isset($_POST['selectcliente']) && isset($_POST['selectfilmuscita'])) {

            $cliente = $_POST['selectcliente'];
            $filmprenotato = $_POST['selectfilmuscita'];

            $query = "SELECT id_cliente, id_film
                    FROM prenotazioni
                    WHERE id_cliente = '$cliente' AND id_film = '$filmprenotato'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            $tupletrovate = mysqli_num_rows($risultato);

            if ($tupletrovate == 1) {
                echo "<br/><br/> PRENOTAZIONE GIA' ESISTENTE <br/><br/>";
                echo "N.B. Ogni cliente può effettuare al massimo una prenotazione per Film";
            } else {

                $oggi = date('Y-m-d');

                $query = "INSERT INTO prenotazioni (id_cliente, id_film, data_prenotazione)
                VALUES (" . $_POST['selectcliente'] . "," . $_POST['selectfilmuscita'] . ",'" . $oggi . "')";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                echo " 
                <tr>
                    <th> COGNOME </th>
                    <th> NOME </th>
                    <th> FILM PRENOTATO </th>
                    <th> DATA PRENOTAZIONE</th>
                </tr> ";


                $query = "SELECT cl.cognome, cl.nome, c.titolo, p.data_prenotazione 
                FROM  clienti cl
                INNER JOIN prenotazioni p
                ON cl.id_cliente = p.id_cliente
                INNER JOIN filmcatalogo c
                ON c.id_film = p.id_film
                WHERE p.id_film = '$filmprenotato' AND p.id_cliente = '$cliente'";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    echo "
                <tr>
                    <td>$tupla[cognome]</td>
                    <td>$tupla[nome] </td>
                    <td>$tupla[titolo]</td>
                    <td>$tupla[data_prenotazione]</td>
                </tr>";
                }
                mysqli_free_result($risultato);
            }
        }
        ?>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>