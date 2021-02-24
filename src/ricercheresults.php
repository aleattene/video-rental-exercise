<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>
        <?php
        if (isset($_POST["selectgenere"])) {
            echo "
                    <tr>
                        <th> GENERE </th>
                        <th> TITOLO </th>
                        <th> REGISTA </th>
                        <th> CASA PRODUTTRICE </th>
                    </tr>";

            $ricercagenere = $_POST["selectgenere"];

            $query = "SELECT genere,titolo,regista,casa_produttrice 
                    FROM filmcatalogo WHERE genere = '$ricercagenere' 
                    ORDER BY genere";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                <tr>
                    <td>$tupla[genere]</td>
                    <td>$tupla[titolo] </td>
                    <td>$tupla[regista]</td>
                    <td>$tupla[casa_produttrice]</td>
                </tr>";
            }
            mysqli_free_result($risultato);
        }
        ?>
        <?php
        if (isset($_POST["selecttitolo"])) {
            echo "
            <table>
                <tr>
                    <th> TITOLO </th>
                    <th> REGISTA </th>
                    <th> CASA PRODUTTRICE </th>
                    <th> GENERE </th>
                </tr>";
            $ricercatitolo = $_POST["selecttitolo"];

            $query = "SELECT titolo,regista,casa_produttrice, genere
                FROM filmcatalogo WHERE titolo = '$ricercatitolo'
                ORDER BY titolo";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                <tr>
                    <td>$tupla[titolo]</td>
                    <td>$tupla[regista]</td>
                    <td>$tupla[casa_produttrice]</td>
                    <td>$tupla[genere]</td>
                </tr>";
            }
            mysqli_free_result($risultato);
        }
        ?>
    </table>

</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>