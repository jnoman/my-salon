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
    else
    {
        require 'include/database.php';
        $id=$_SESSION['id'];
        $db = Database::connect();
        $statement = $db->prepare("SELECT id_reservation,date_debut,nom_salon,prixT,etat_reservation FROM resrvation,users,employe,salon WHERE users.idUser=$id and users.idUser=resrvation.idUser and resrvation.id_employe=employe.id_employe and employe.id_salon=salon.id_salon and etat_reservation<>'supprimer' ORDER BY id_reservation ASC");
        $statement->execute();

        if ($statement->rowCount() > 0) {
            // output data of each row
            echo '<div class="container"><table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id rendez-vous</th>
                    <th scope="col">nom client</th>
                    <th scope="col">date rendez-vous</th>
                    <th scope="col">prix</th>
                    <th scope="col">etat reservation</th>
                    <th scope="col">supprimer</th>
                </tr>
                </thead>
                <tbody>';
            while($row = $statement->fetch()) {
                echo '<tr data-href="detailRendez-vous.php?idRendezVous='.$row["id_reservation"].'">
                        <form method="POST" action="">
                        <th scope="row">'. $row["id_reservation"].'</th>
                        <td>'. $row["nom_salon"].'</td>
                        <td>'. $row["date_debut"].'</td>
                        <td>'. $row["prixT"].'</td>
                        <td>'. $row["etat_reservation"].'</td>
                        <td><button type="submit" class="btn btn-danger btn-lg" name="supprimer['. $row["id_reservation"].']">supprimer</button></td>
                        </form>
                    </tr>';
            }
            echo "</tbody>
            </table></div>";
        } 
        else {
            echo '<div class="messageErreur"><p class="text-center font-weight-bolder">Aucun rendez-vous</p></div>';
        }
        Database::disconnect();
        echo '<script>$("tr[data-href]").on("click", function() {
            document.location = $(this).data("href");
        });</script>';
        if(isset($_POST['supprimer']))
        {
            $db = Database::connect();
            $idReservation=array_keys($_POST["supprimer"])[0];
            $statement = $db->prepare("UPDATE resrvation SET etat_reservation='supprimer' WHERE id_reservation=$idReservation");
            if (!$statement->execute() === TRUE) {
                echo "<script>alert(\"erreur\")</script>";
            }
            Database::disconnect();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
    include('include/footer.php');
?>