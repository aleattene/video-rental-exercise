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
            onclick=\"location.href='attivanoleggio.php'\" value=\"Effettua Noleggio\"/>";
        ?>
    </div>

    <div id=subproject2>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='terminanoleggio.php'\" value=\"Termina Noleggio\"/>";
        ?>
    </div>

    <div id=subproject3>
        <form id="formterminanoleggio" name="formterminanoleggio" action="terminanoleggioresults.php" method="POST">

            <select required id="selectnoleggio" name="selectnoleggio">
                <option value="" disabled selected> Seleziona Noleggio da Terminare </option>

                <?php
                $ruoloresponsabile = $_SESSION['ruolo_resp'];
                $oggi = date('Y-m-d');

                $query = "SELECT n.id_noleggio, n.id_cliente , cl.cognome, cl.nome
                    FROM noleggi n
                    INNER JOIN clienti cl
                    ON n.id_cliente = cl.id_cliente
                    WHERE n.data_inizionoleggio < '$oggi' AND n.storico_costo = '0'
                    ORDER BY n.id_noleggio";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idnoleggio = $tupla["id_noleggio"];
                    $cognome = $tupla["cognome"];
                    $nome = $tupla["nome"];

                    echo "<option value = '$idnoleggio'> Cod.Noleggio: $idnoleggio
                                                     ($cognome $nome) </option> \n";
                }

                mysqli_free_result($risultato);

                ?>
            </select>

            <?php
            if ($ruoloresponsabile == 1) {
            ?>

                <select required id="selectsconto" name="selectsconto">
                    <option value="" disabled selected> Seleziona eventuale Sconto </option>
                    <?php

                    $query = "SELECT id_percsconto, perc_sconto
                    FROM percentualisconto
                    ORDER BY id_percsconto";

                    $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                    while ($tupla = mysqli_fetch_array($risultato)) {
                        $idpercsconto = $tupla["id_percsconto"];
                        $percsconto = $tupla["perc_sconto"];

                        echo " <option value = '$percsconto'> $percsconto% di sconto </option> \n";
                    }

                    ?>

                    <option value="00"> Nessuno sconto </option>
                </select>
            <?php
            }
            ?>

            <select required id="selectcopiadanneggiata" name="selectcopiadanneggiata">
                <option value="" disabled selected> Copia Danneggiata [SI/NO] ?</option>
                <option value="1"> SI - Copia Danneggiata </option>
                <option value="0"> NO - Copia in Buono Stato </option>
            </select>

            <input type="submit" name="submit" value="Termina Noleggio" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>