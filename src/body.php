<!-- Inizio sezione Body che segue Header.php ed anticipa Footer.php-->
<div id="container">

    <div id="top-menu">
        <div id="button-menu">
            <?php
            echo "<input type=\"button\" 
                onclick=\"location.href='home.php'\" value=\"Home\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php
            echo "<input type=\"button\" 
                onclick=\"location.href='caricoscarico.php'\" value=\"Carico e Scarico\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php
            echo "<input type=\"button\" 
                onclick=\"location.href='ricerche.php'\" value=\"Ricerche\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php
            echo "<input type=\"button\" 
                onclick=\"location.href='prenotazione.php'\" value=\"Prenotazioni\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php
            echo "<input type=\"button\" 
                onclick=\"location.href='noleggio.php'\" value=\"Noleggio\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php
            echo "<input type=\"button\" 
                onclick=\"location.href='calcoloincassi.php'\" value=\"Calcolo Incassi\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php
            echo "<input type=\"button\" 
                onclick=\"location.href='logout.php'\" value=\"Logout\"/>";
            ?>
        </div>
        <div id="button-menu">
            <?php
            echo "<input type=\"button\" 
                onclick=\"location.href='#'\" value=\"--------\"/>";
            ?>
        </div>
    </div>
    <!-- ricordarsi nei file collegati di chiudere il CONTAINER-->
    <!-- Fine sezione Body che segue Header.php ed anticipa Footer.php-->