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
        $statement = $db->prepare("SELECT service.* FROM service,salon WHERE service.id_salon=salon.id_salon and salon.idUser=$id");
        $statement->execute();
        if ($statement->rowCount() > 0) {
            // output data of each row
            echo '<div class="container"><table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id service</th>
                    <th scope="col">nom service</th>
                    <th scope="col">durée</th>
                    <th scope="col">prix</th>
                    <th scope="col">supprimer</th>
                </tr>
                </thead>
                <tbody>';
            while($row = $statement->fetch()) {
                echo '<tr data-href="modifierService.php?idService='.$row["id_service"].'">
                        <form method="POST" action="">
                        <th scope="row">'. $row["id_service"].'</th>
                        <td>'. $row["nom_service"].'</td>
                        <td>'. $row["duree"].'</td>
                        <td>'. $row["prix"].'</td>
                        <td><button type="submit" class="btn btn-danger btn-lg" name="supprimer['. $row["id_service"].']">supprimer</button></td>
                        </form>
                    </tr>';
            }
            echo "</tbody>
            </table></div>";
        } 
        else {
            echo '<div class="messageErreur"><p class="text-center font-weight-bolder">Aucune service</p></div>';
        }
        echo '<div class="container"><a href="ajouterService.php"><button type="button" class="btn btn-info btn_stndard">Ajouter service</button></a></div>';
        Database::disconnect();
        echo '<script>$("tr[data-href]").on("click", function() {
            document.location = $(this).data("href");
        });</script>';
        if(isset($_POST['supprimer']))
        {
            $db = Database::connect();
            $id_service=array_keys($_POST["supprimer"])[0];
            $statement = $db->prepare("DELETE FROM service WHERE id_service=$id_service");
            if (!$statement->execute() === TRUE) {
                echo "<script>alert(\"erreur\")</script>";
            }
            Database::disconnect();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
    include('include/footer.php');
?>