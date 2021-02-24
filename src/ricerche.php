<?php
include "sessioncontrol.php";
include "header.php";
include "body.php";
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

</div>
</div> <!-- riguarda la chiusura di CONTAINER che si trova sul file BODY.php -->

<?php include "footer.php"; ?>