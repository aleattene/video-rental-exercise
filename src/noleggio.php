<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
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

</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>