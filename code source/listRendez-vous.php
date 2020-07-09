<?php
    require 'include/header.php';
    if(!isset($_SESSION['id']))
    {
        echo "<script>{window.location.href = 'connection.php'};</script>";
    }
    elseif($_SESSION['type'] != "coiffeur")
    {
        echo "<div class='messageErreur'><p class='text-center font-weight-bolder'>Vous n'êtes pas autorisé à accéder à cette page</p></div>";
    }
    else
    {
        require 'include/database.php';
        $id=$_SESSION['id'];
        $db = Database::connect();
        $statement = $db->prepare("SELECT id_reservation,date_debut,nom,prixT FROM resrvation,users,employe,salon WHERE resrvation.idUser=users.idUser and resrvation.id_employe=employe.id_employe and employe.id_salon=salon.id_salon and salon.idUser=$id and etat_reservation='en attente' ORDER BY id_reservation ASC");
        $statement->execute();

        if ($statement->rowCount() > 0) {
            // output data of each row
            echo '<div class="divstandard"><table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id rendez-vous</th>
                    <th scope="col">nom client</th>
                    <th scope="col">date rendez-vous</th>
                    <th scope="col">prix</th>
                    <th scope="col">terminé</th>
                    <th scope="col">refusé</th>
                </tr>
                </thead>
                <tbody>';
            while($row = $statement->fetch()) {
                echo '<tr data-href="detailRendez-vous.php?idRendezVous='.$row["id_reservation"].'">
                        <form method="POST" action="">
                        <th scope="row">'. $row["id_reservation"].'</th>
                        <td>'. $row["nom"].'</td>
                        <td>'. $row["date_debut"].'</td>
                        <td>'. $row["prixT"].'</td>
                        <td><button type="submit" class="btn btn-lg btn_stndard" name="termine['. $row["id_reservation"].']">terminé</button></td>
                        <td><button type="submit" class="btn btn-danger btn-lg" name="refuse['. $row["id_reservation"].']">refusé</button></td>
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
        if(isset($_POST['termine']))
        {
            $db = Database::connect();
            $idReservation=array_keys($_POST["termine"])[0];
            $statement = $db->prepare("UPDATE resrvation SET etat_reservation='termine' WHERE id_reservation=$idReservation");
            if (!$statement->execute() === TRUE) {
                echo "<script>alert(\"erreur\")</script>";
            }
            Database::disconnect();
            echo '<script>javascript:history.go(-1);</script>';
        }
        if(isset($_POST['refuse']))
        {
            $db = Database::connect();
            $idReservation=array_keys($_POST["refuse"])[0];
            $statement = $db->prepare("UPDATE resrvation SET etat_reservation='refuse' WHERE id_reservation=$idReservation");
            if (!$statement->execute() === TRUE) {
                echo "<script>alert(\"erreur\")</script>";
            }
            Database::disconnect();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
    include('include/footer.php');
?>