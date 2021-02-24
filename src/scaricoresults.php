<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>
        <?php
        if (isset($_POST["selectcopiemagazzino"])) {

            $oggi = date('Y-m-d');
            echo "
                <tr>
                    <th> FORNITORE</th>
                    <th> TITOLO FILM</th>
                    <th> DATA SCADENZA</th>
                    <th> COD.COPIA SCARICARE </th>
                </tr>";

            $scarico = $_POST["selectcopiemagazzino"];  /* qui passa id_copiafilm */

            $query = "UPDATE filmcopiemagazzino 
                SET copia_noleggiabile ='0', copia_scaricata = '1'
                WHERE id_copiafilm = '$scarico'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');


            $query = "SELECT m.id_copiafilm, c.titolo, f.ragione_sociale, m.data_scadenza 
                FROM filmcopiemagazzino m 
                INNER JOIN fornitori f
                ON m.id_fornitore = f.id_fornitore
                INNER JOIN filmcatalogo c
                ON m.id_film = c.id_film
                WHERE m.data_scadenza ='$oggi' AND copia_scaricata ='0'
                ORDER BY f.ragione_sociale";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                <tr>
                    <td>$tupla[ragione_sociale] </td>
                    <td>$tupla[titolo]</td>
                    <td>$tupla[data_scadenza]</td>
                    <td>$tupla[id_copiafilm]</td>
               </tr>";
            }
            mysqli_free_result($risultato);
        }
        ?>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>