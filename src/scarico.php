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
        <form id="formcarico" name="formcarico" action="scaricoresults.php" method="POST">

            <select required id="selectcopiemagazzino" name="selectcopiemagazzino">
                <option value="" disabled selected> Seleziona COPIA SCADUTA </option>

                <?php
                $oggi = date('Y-m-d');
                $query = "SELECT m.id_copiafilm, c.titolo, f.ragione_sociale, m.data_scadenza 
                    FROM filmcopiemagazzino m 
                    INNER JOIN fornitori f
                    ON m.id_fornitore = f.id_fornitore
                    INNER JOIN filmcatalogo c
                    ON m.id_film = c.id_film
                    WHERE m.data_scadenza = '$oggi' AND m.copia_scaricata = 0
                    ORDER BY f.ragione_sociale";
                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idcopiafilm = $tupla["id_copiafilm"];
                    $titolo = $tupla["titolo"];
                    $fornitore = $tupla["ragione_sociale"];
                    $datascadenza = $tupla["data_scadenza"];

                    echo "<option value = '$idcopiafilm'>$fornitore / $titolo (scadenza $datascadenza) 
                        </option> \n";
                }
                mysqli_free_result($risultato);
                ?>
            </select>
            <input type="submit" name="submit" value="Scarica Copia" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>