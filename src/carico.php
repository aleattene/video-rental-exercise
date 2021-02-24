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
            onclick=\"location.href='carico.php'\" value=\"Carica Nuovi Video\"/>";
        ?>
    </div>

    <div id=subproject2>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='scarico.php'\" value=\"Scarica Video Scaduti\"/>";
        ?>
    </div>

    <div id=subproject3>
        <form id="formcarico" name="formcarico" action="caricoresults.php" method="POST">

            <select required id="selectfilmcatalogo" name="selectfilmcatalogo">
                <option value="" disabled selected> Seleziona FILM in CATALOGO </option>

                <?php
                $query = "SELECT DISTINCT id_film,titolo,regista FROM filmcatalogo ORDER BY titolo";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idfilm = $tupla["id_film"];
                    $titolo = $tupla["titolo"];
                    $regista = $tupla["regista"];
                    echo "<option value = '$idfilm'> $titolo (di $regista) / Codice: $idfilm </option> \n";
                }

                mysqli_free_result($risultato);
                ?>

            </select>

            <select required id="selectfornitore" name="selectfornitore">
                <option value="" disabled selected> Seleziona FORNITORE </option>

                <?php
                $query = "SELECT id_fornitore,ragione_sociale FROM fornitori ORDER BY id_fornitore";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idfornitore = $tupla["id_fornitore"];
                    $ragionesociale = $tupla["ragione_sociale"];
                    echo "<option value = '$idfornitore'>Codice: 00$idfornitore / $ragionesociale</option> \n";
                }

                mysqli_free_result($risultato);
                ?>

            </select>
            <input type="submit" name="submit" value="Aggiorna Disponibilità" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>