<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <table>
        <?php
        if (isset($_POST["selectoperatore"])) {
            $oggi = date('Y-m-d');
            $incasso = 0;

            $operatore = $_POST["selectoperatore"];

            $query = "SELECT storico_costo 
                    FROM noleggi
                    WHERE matr_dipendente = '$operatore' AND data_finenoleggio = '$oggi'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                $incasso = $incasso + $tupla["storico_costo"];
            }

            echo "
                <tr>
                    <th> MATRICOLA </th>
                    <th> COGNOME </th>
                    <th> INCASSO " . date('d/m/Y') . " </th>
                    <th> P.V.OPERANTE </th>
                </tr>";

            $query = "SELECT d.matr_dipendente, d.cognome, pv.rag_sociale 
                    FROM dipendenti d
                    INNER JOIN puntivendita pv
                    ON d.id_puntovendita = pv.id_puntovendita
                    WHERE d.matr_dipendente = '$operatore'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
                <tr>
                    <td>$tupla[matr_dipendente]</td>
                    <td>$tupla[cognome] </td>
                    <td>€ $incasso</td>
                    <td>$tupla[rag_sociale]</td>
                </tr>";
            }
            mysqli_free_result($risultato);
        }
        ?>
        <?php
        if (isset($_POST["selectpuntovendita"])) {
            $oggi = date('Y-m-d');
            $incasso = 0;

            $puntovendita = $_POST["selectpuntovendita"];

            $query = "SELECT n.storico_costo 
                    FROM noleggi n
                    INNER JOIN dipendenti d
                    ON n.matr_dipendente = d.matr_dipendente
                    INNER JOIN puntivendita pv
                    ON d.id_puntovendita = pv.id_puntovendita
                    WHERE pv.id_puntovendita = '$puntovendita' AND data_finenoleggio = '$oggi'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                $incasso = $incasso + $tupla["storico_costo"];
            }

            echo "
            <tr>
                <th> PUNTO VENDITA </th>
                <th> CITTA' </th>
                <th> P.IVA </th>
                <th> INCASSO " . date('d/m/Y') . " </th>
                </tr>";

            $query = "SELECT pv.rag_sociale, pv.piva_puntovendita, ct.nome 
                FROM puntivendita pv
                INNER JOIN citta ct
                ON pv.id_citta = ct.id_citta
                WHERE pv.id_puntovendita = '$puntovendita'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            while ($tupla = mysqli_fetch_array($risultato)) {
                echo "
            <tr>
                <td>$tupla[rag_sociale]</td>
                <td>$tupla[nome] </td>
                <td>$tupla[piva_puntovendita]</td>
                <td>€ $incasso</td>
                
            </tr>";
            }
            mysqli_free_result($risultato);
        }
        ?>
    </table>

</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>