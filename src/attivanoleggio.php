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
        <form id="formattivanoleggio" name="formattivanoleggio" action="attivanoleggioresults.php" method="POST">

            <select required id="selectfilmnoleggio" name="selectfilmnoleggio">
                <option value="" disabled selected> Seleziona FILM Disponibili </option>

                <?php
                $query = "SELECT c.titolo, c.regista, f.id_copiafilm
                    FROM filmcatalogo c
                    INNER JOIN filmcopiemagazzino f
                    ON c.id_film = f.id_film
                    WHERE f.copia_noleggiabile = '1'
                    ORDER BY titolo";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $idcopiafilm = $tupla["id_copiafilm"];
                    $titolo = $tupla["titolo"];
                    $regista = $tupla["regista"];

                    echo "<option value = '$idcopiafilm'> $titolo (di $regista) / 
                                                        Codice: $idcopiafilm </option> \n";
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
            <input type="submit" name="submit" value="Conferma Noleggio" />
        </form>
    </div>
</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>