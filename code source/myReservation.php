<?php
    require 'include/footer.php';
    if(!isset($_SESSION['id']))
    {
        echo "<script>{window.location.href = 'connection.php'};</script>";
    }
    elseif($_SESSION['type'] != "client")
    {
        echo "<div class='messageErreur'><p>Vous n'êtes pas autorisé à accéder à cette page</p></div>";
    }
    else
    {
        echo "yes";
    }
?>