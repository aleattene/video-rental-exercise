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
            onclick=\"location.href='prenotazione.php'\" value=\"Prenota Film\"/>";
        ?>
    </div>

    <div id=subproject2>
        <?php
        echo "<input type=\"button\" 
            onclick=\"location.href='prenotazionielenco.php'\" value=\"Visualizza Prenotazioni\"/>";
        ?>
    </div>
    <div id="subproject3">
        <form id="formprenotazione" name="formprenotazione" action="prenotazioniresults.php" method="POST">

            <select required id="selectfilmuscita" name="selectfilmuscita">
                <option value="" disabled selected> Seleziona FILM di PROSSIMA USCITA </option>

                <?php
                $query = "SELECT DISTINCT id_film, titolo, regista 
                        FROM filmcatalogo 
                        WHERE film_prenotabile = 1
                        ORDER BY titolo";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idfilm = $tupla["id_film"];
                    $titolo = $tupla["titolo"];
                    $regista = $tupla["regista"];
                    echo "<option value = '$idfilm'>Codice: $idfilm / $titolo (di $regista)</option> \n";
                }

                mysqli_free_result($risultato);
                ?>

            </select>

            <select required id="selectcliente" name="selectcliente">
                <option value="" disabled selected> Seleziona CLIENTE </option>

                <?php
                $query = "SELECT id_cliente, cognome, nome 
                    FROM clienti 
                    ORDER BY cognome";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idcliente = $tupla["id_cliente"];
                    $cognome = $tupla["cognome"];
                    $nome = $tupla["nome"];
                    echo "<option value = '$idcliente'>$cognome $nome (codice: $idcliente)</option> \n";
                }

                mysqli_free_result($risultato);
                ?>

            </select>
            <input type="submit" name="submit" value="Effettua Prenotazione" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>