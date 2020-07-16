<?php
    require 'include/header.php';
    if(!isset($_SESSION['id']))
    {
        echo "<script>{window.location.href = 'connection.php'};</script>";
    }
    elseif($_SESSION['type'] != "client")
    {
        echo "<div class='messageErreur'><p class='text-center font-weight-bolder'>Vous n'êtes pas autorisé à accéder à cette page</p></div>";
    }
    elseif(isset($_GET["idSalon"]) && !empty( $_GET['idSalon'] ))
    {
        require 'include/database.php';
        $id=$_SESSION['id'];
        $idSalon=$_GET["idSalon"];
        $db = Database::connect();
        $statement = $db->prepare("SELECT nom_salon,adresse,ville,genre,image,date_debut_travail,date_fin_travail FROM salon WHERE id_salon=$idSalon and date_fin>=CURRENT_DATE");
        $statement->execute();
        if($item = $statement->fetch())
        {
            echo 'yes';
        }
        else {
            echo '<div class="messageErreur"><p class="text-center font-weight-bolder">id de salon n\'est pas valid</p></div>';
        }
        Database::disconnect();
    }
    else 
    {
        echo "<div class='messageErreur'><p class='text-center font-weight-bolder'>Aucune id de salon sélectionner</p></div>";
    }
    require 'include/footer.php';
?>