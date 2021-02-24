<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">

    <table>

        <?php
        if (isset($_POST['selectnoleggio']) && isset($_POST['selectcopiadanneggiata'])) {

            $matricoladipendente = $_SESSION['matr_dipendente'];
            $ruoloresponsabile = $_SESSION['ruolo_resp'];
            $scontoapplicato = 0;
            $sconto = 0;

            if ($ruoloresponsabile == 1) {
                $scontoapplicato = $_POST['selectsconto'];
            }
            $costonoleggio = 0;
            $oggi = date('Y-m-d');
            $idnoleggio = $_POST['selectnoleggio'];
            $costonoleggio = 0;
            $copiadanneggiata = $_POST['selectcopiadanneggiata'];

            $query = "UPDATE noleggi n
                    INNER JOIN filmcopiemagazzino m
                    ON n.id_copiafilm = m.id_copiafilm
                    SET n.data_finenoleggio = '$oggi', 
                        n.copia_danneggiata = '$copiadanneggiata',
                        m.copia_noleggiabile = '1'
                    WHERE n.id_noleggio = '$idnoleggio'";


            $risultao = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

            echo " 
                <tr>
                    <th> COGNOME </th>
                    <th> NOME </th>
                    <th> INIZIO NOLEGGIO </th>
                    <th> FINE NOLEGGIO </th>
                    <th> MATR.OPERATORE</th>
                </tr> ";

            $query = "SELECT cl.cognome, cl.nome, c.titolo, n.data_finenoleggio, n.data_inizionoleggio
                FROM  clienti cl
                INNER JOIN noleggi n
                ON n.id_cliente = cl.id_cliente
                INNER JOIN  filmcopiemagazzino m
                ON n.id_copiafilm = m.id_copiafilm
                INNER JOIN filmcatalogo c
                ON m.id_film = c.id_film
                WHERE n.id_noleggio = '$idnoleggio'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');



            while ($tupla = mysqli_fetch_array($risultato)) {
                $datainizionoleggio = $tupla['data_inizionoleggio'];
                $datainizionoleggioint = (int)(strtotime($datainizionoleggio));
                $datafinenoleggio = $tupla['data_finenoleggio'];
                $datafinenoleggioint = (int)(strtotime($datafinenoleggio));
                $duratanoleggio = (int)(($datafinenoleggioint - $datainizionoleggioint) / 86400);
                $costonoleggio = 0;
                $costopenale = 0;

                if ($duratanoleggio <= 7) {
                    $costonoleggio = $duratanoleggio * 3;
                } else if ($duratanoleggio > 7 && $duratanoleggio <= 30) {
                    $costonoleggio = 21 + ($duratanoleggio - 7) * 2;
                } else if ($duratanoleggio > 30 && $duratanoleggio <= 90) {
                    $costonoleggio = 67;
                    $costonoleggio = $costonoleggio + ($duratanoleggio - 30) * 1;
                } else {
                    $costonoleggio = 127;
                    $costopenale = 20;
                }

                if ($copiadanneggiata == 1) {
                    $costopenale = 20;
                }

                $sconto = $costonoleggio * ($scontoapplicato / 100);
                $costototale = $costonoleggio - $sconto + $costopenale;
                $cognome = $tupla["cognome"];
                $nome = $tupla["nome"];

                echo "
                <tr>
                    <td>$cognome</td>
                    <td>$nome </td>
                    <td>$datainizionoleggio </td>
                    <td>$datafinenoleggio </td>
                    <td>$matricoladipendente</td>
                </tr>
                <tr>
                    <th> DURATA NOLEGGIO </th>
                    <th> COSTO NOLEGGIO </th>
                    <th> SCONTO APPLICATO </th>
                    <th> COSTO DANNEGGIAMENTO </th>
                    <th> COSTO TOTALE</th>
                </tr>
                <tr>
                    <td>$duratanoleggio giorni</td>
                    <td>€ $costonoleggio </td>
                    <td> $scontoapplicato %   </td>
                    <td>€ $costopenale </td>
                    <td>€ $costototale </td>
                 </tr>";
            }

            $query = "UPDATE noleggi
        SET storico_costo = '$costototale' 
        WHERE id_noleggio = '$idnoleggio'";

            $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');
        }
        ?>
    </table>
    <?php
    if ($costopenale == 20 & $copiadanneggiata == 1) {
        echo " 
            <br/><br/><br/>
            <table>
                <tr>
                    <th> COGNOME </th>
                    <th> NOME </th>
                    <th> COSTO DANNEGGIAMENTO </th>
                    <th> DATA STAMPA RICEVUTA ADDEBITO</th>
                </tr>
                <tr>
                    <td>$cognome</td>
                    <td>$nome </td>
                    <td>€ $costopenale </td>
                    <td>$oggi </td>
                 </tr>
                 </table> ";
    }
    ?>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>