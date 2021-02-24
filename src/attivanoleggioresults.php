<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>

        <?php
        if (isset($_POST['selectcliente']) && isset($_POST['selectfilmnoleggio'])) {

            $oggi = date('Y-m-d');
            $matricoladipendente = $_SESSION["matr_dipendente"];
            $query = "INSERT INTO noleggi (data_inizionoleggio, id_copiafilm, id_cliente, matr_dipendente)
                VALUES (" . "'" . $oggi . "'," . $_POST['selectfilmnoleggio'] . "," . $_POST['selectcliente'] . "," .
                "'" . $matricoladipendente . "')";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');
            $copianoleggiata = $_POST['selectfilmnoleggio'];
            $query = "UPDATE filmcopiemagazzino
                    SET copia_noleggiabile = 0
                    WHERE id_copiafilm = '$copianoleggiata'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            echo " 
                <tr>
                    <th> COGNOME </th>
                    <th> NOME </th>
                    <th> FILM NOLEGGIATO </th>
                    <th> DATA INIZIO NOLEGGIO</th>
                    <th> MATR. OPERATORE </th>
                </tr> ";

            $filmnoleggiato = $_POST["selectfilmnoleggio"];
            $cliente = $_POST["selectcliente"];


            $query = "SELECT DISTINCT cl.cognome, cl.nome, c.titolo, n.data_inizionoleggio 
                    FROM  clienti cl
                    INNER JOIN noleggi n
                    ON n.id_cliente = cl.id_cliente
                    INNER JOIN  filmcopiemagazzino m
                    ON n.id_copiafilm = m.id_copiafilm
                    INNER JOIN filmcatalogo c
                    ON m.id_film = c.id_film
                    WHERE n.id_copiafilm = '$filmnoleggiato' AND n.id_cliente = '$cliente'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                <tr>
                    <td>$tupla[cognome]</td>
                    <td>$tupla[nome] </td>
                    <td>$tupla[titolo]</td>
                    <td>$tupla[data_inizionoleggio]</td>
                    <td>$matricoladipendente </td>
                </tr>";
            }
            mysqli_free_result($risultato);
        }
        ?>
    </table>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>