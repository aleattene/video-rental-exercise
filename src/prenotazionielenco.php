<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>
        <?php

        $query = "SELECT cl.cognome, cl.nome, c.titolo, c.regista, p.data_prenotazione
                FROM clienti AS cl, filmcatalogo AS c, prenotazioni AS p
                WHERE c.id_film = p.id_film AND cl.id_cliente = p.id_cliente";

        $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

        echo " 
                <tr>
                    <th> COGNOME </th>
                    <th> NOME </th>
                    <th> FILM PRENOTATO </th>
                    <th> REGISTA </th>
                    <th> DATA PRENOTAZIONE</th>
                </tr> ";

        while ($tupla = mysqli_fetch_array($risultato)) {
            echo "
                <tr>
                    <td>$tupla[cognome]</td>
                    <td>$tupla[nome] </td>
                    <td>$tupla[titolo] </td>
                    <td>$tupla[regista] </td>
                    <td>$tupla[data_prenotazione]</td>
                </tr>";
        }
        mysqli_free_result($risultato);
        ?>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>