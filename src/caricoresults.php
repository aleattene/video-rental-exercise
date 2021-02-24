<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>
        <?php
        if (isset($_POST["selectfilmcatalogo"])) {
            $oggi = date('Y-m-d');
            $tremesi = date('Y-m-d', strtotime("+ 3 month"));
            $query = "INSERT INTO filmcopiemagazzino (id_fornitore, data_consegna, data_scadenza, id_film)
                VALUES (" . $_POST['selectfornitore'] . ",'" . $oggi . "','" . $tremesi . "'," .
                $_POST['selectfilmcatalogo'] . ")";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');
            echo "
                <tr>
                    <th> CODICE COPIA </th>
                    <th> FORNITORE </th>
                    <th> TITOLO FILM </th>
                    <th> DATA CARICO </th>
                </tr>";

            $carico = $_POST["selectfilmcatalogo"];

            $query = "SELECT m.id_copiafilm, f.ragione_sociale, c.titolo, m.data_consegna 
                FROM filmcopiemagazzino m 
                INNER JOIN fornitori f
                ON m.id_fornitore = f.id_fornitore
                INNER JOIN filmcatalogo c
                ON m.id_film = c.id_film
                WHERE c.id_film = '$carico'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                <tr>
                    <td>$tupla[id_copiafilm]</td>
                    <td>$tupla[ragione_sociale] </td>
                    <td>$tupla[titolo]</td>
                    <td>$tupla[data_consegna]</td>
                </tr>";
            }
            mysqli_free_result($risultato);
        }
        ?>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>