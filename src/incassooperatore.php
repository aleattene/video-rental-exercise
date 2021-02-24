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
        <form id="formincassooperatore" name="formincassooperatore" action="incassoresults.php" method="POST">

            <select required id="selectoperatore" name="selectoperatore">
                <option value="" disabled selected> Seleziona Operatore </option>

                <?php
                $query = "SELECT matr_dipendente, cognome, nome 
                    FROM dipendenti 
                    ORDER BY matr_dipendente";

                $risultato = mysqli_query($dbconnection, $query) or die('Query non eseguibile');

                while ($tupla = mysqli_fetch_array($risultato)) {
                    $matricola = $tupla["matr_dipendente"];
                    $cognome = $tupla["cognome"];
                    $nome = $tupla["nome"];
                    echo "<option value = '$matricola'> Matricola $matricola / 
                                            Operatore: $cognome $nome </option> \n";
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