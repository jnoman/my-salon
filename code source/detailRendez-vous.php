<?php
    require 'include/header.php';
    if(!isset($_SESSION['id']))
    {
        echo "<script>{window.location.href = 'connection.php'};</script>";
    }
    elseif($_SESSION['type'] != "client" && $_SESSION['type'] != "coiffeur")
    {
        echo "<div class='messageErreur'><p class='text-center font-weight-bolder'>Vous n'êtes pas autorisé à accéder à cette page</p></div>";
    }
    elseif(isset($_GET["idRendezVous"]) && !empty( $_GET['idRendezVous'] ))
    {
        require 'include/database.php';
        $id=$_SESSION['id'];
        $idRendezVous=$_GET["idRendezVous"];
        $db = Database::connect();
        if($_SESSION['type'] == "client")
        {
            $statement = $db->prepare("SELECT service.* FROM service,lignereservation,resrvation WHERE service.id_service=lignereservation.id_service and lignereservation.id_reservation=$idRendezVous and lignereservation.id_reservation=resrvation.id_reservation and resrvation.idUser=$id");
        }
        else
        {
            $statement = $db->prepare("SELECT service.* FROM service,lignereservation,resrvation,employe,salon WHERE service.id_service=lignereservation.id_service and lignereservation.id_reservation=$idRendezVous and lignereservation.id_reservation=resrvation.id_reservation and resrvation.id_employe=employe.id_employe and employe.id_salon=salon.id_salon and salon.idUser=$id");
        }
        $statement->execute();

        if ($statement->rowCount() > 0) {
            // output data of each row
            echo '<div class="divstandard"><table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id service</th>
                    <th scope="col">nom service</th>
                    <th scope="col">durée</th>
                    <th scope="col">prix</th>
                </tr>
                </thead>
                <tbody>';
            while($row = $statement->fetch()) {
                echo '<tr>
                        <th scope="row">'. $row["id_service"].'</th>
                        <td>'. $row["nom_service"].'</td>
                        <td>'. $row["duree"].'</td>
                        <td>'. $row["prix"].' Dh</td>
                    </tr>';
            }
            echo "</tbody>
            </table></div>";
        } 
        else {
            echo '<div class="messageErreur"><p class="text-center font-weight-bolder">id de rendez-vous n\'est pas valid</p></div>';
        }
        Database::disconnect();
    }
    else 
    {
        echo "<div class='messageErreur'><p class='text-center font-weight-bolder'>Aucune id de rendez-vous sélectionner</p></div>";
    }
    include('include/footer.php');
?>