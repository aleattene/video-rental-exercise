<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
include "dbconnection.php";

?>

<div id="project-section">
    <div id=subproject1>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='incassooperatore.php'\" value=\"Incasso Operatore\"/>";
        ?>
    </div>

    <div id=subproject2>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='incassopuntovendita.php'\" value=\"Incasso Punto Vendita\"/>";
        ?>
    </div>

    <div id=subproject3>
        <form id="formincassopuntovendita" name="formincassopuntovendita" action="incassoresults.php" method="POST">

            <select required id="selectopuntovendita" name="selectpuntovendita">
                <option value="" disabled selected> Seleziona Punto Vendita </option>

                <?php
                $query = "SELECT pv.id_puntovendita, pv.rag_sociale, ct.nome 
                    FROM puntivendita pv
                    INNER JOIN citta ct
                    ON pv.id_citta = ct.id_citta
                    ORDER BY id_puntovendita";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idpuntovendita = $tupla["id_puntovendita"];
                    $ragsociale = $tupla["rag_sociale"];
                    $citta = $tupla["nome"];
                    echo "<option value = '$idpuntovendita'> $ragsociale ($citta)</option> \n";
                }

                mysqli_free_result($risultato);
                ?>

            </select>
            <input type="submit" name="submit" value="Calcola Incasso" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>