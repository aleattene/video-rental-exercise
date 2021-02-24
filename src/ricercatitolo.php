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
            onclick=\"location.href='ricercagenere.php'\" value=\"Ricerca per Genere\"/>";
        ?>
    </div>

    <div id=subproject2>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='ricercatitolo.php'\" value=\"Ricerca per Titolo\"/>";
        ?>
    </div>

    <div id=subproject3>
        <form id="formtitolo" name="formtitolo" action="ricercheresults.php" method="POST">

            <select required id="selecttitolo" name="selecttitolo">
                <option value="" disabled selected> Seleziona TITOLO </option>

                <?php
                $query = "SELECT DISTINCT titolo FROM filmcatalogo ORDER BY titolo";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $titolo = $tupla["titolo"];
                    echo "<option value = '$titolo'>$titolo</option> \n";
                }

                mysqli_free_result($risultato);
                ?>

            </select>
            <input type="submit" name="submit" value="Effettua Ricerca" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>