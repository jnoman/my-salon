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
    elseif(isset($_GET["idService"]) && !empty( $_GET['idService'] ))
    {
        require 'include/database.php';
        $id=$_SESSION['id'];
        $idService=$_GET["idService"];
        $db = Database::connect();
        $statement = $db->prepare("SELECT nom_service,duree,prix FROM service,salon WHERE service.id_salon=salon.id_salon and salon.idUser=$id and id_service=$idService");
        $statement->execute();
        if($item = $statement->fetch())
        {
            echo '<form method="POST" action="">
                <div class="container">
                    <div class="form-group">
                        <label>Nom Service</label>
                        <input type="text" class="form-control" name="nomService" minlength="5" pattern="^[a-zA-Z_\- \']{5,}$" required value="'.$item["nom_service"].'">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Prix en Dh</label>
                            <input type="number" min="30.00" max="3000.00" class="form-control" name="prix" step="1" required value="'.$item["prix"].'">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Durée</label>
                            <input type="time" min="00:05" max="02:00" class="form-control" name="duree" required value="'.date('H:i',strtotime($item["duree"])).'">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn_stndard" name="updateService">Modifier</button>
                    <input type="button" value="Annuler" onClick="Annuler()" class="btn btn-info btn_stndard"/>
                </div>
            </form>';
        }
        else {
            echo '<div class="messageErreur"><p class="text-center font-weight-bolder">id de service n\'est pas valid</p></div>';
        }
        Database::disconnect();
        if(isset($_POST['updateService']))
        {
            try{
                $db = Database::connect();
                $nomService=$_POST['nomService'];
                $statement = $db->prepare("SELECT nom_service FROM service,salon WHERE service.id_salon=salon.id_salon and salon.idUser=$id and nom_service='$nomService' and id_service<>$idService");
                $statement->execute();
                if ($statement->rowCount() == 0)
                {
                    $prix=$_POST['prix'];
                    $duree=$_POST['duree'];
                    $statement = $db->prepare("UPDATE service set nom_service='$nomService', duree='$duree', prix=$prix where id_service=$idService");
                    $statement->execute();
                    echo "<script>alert(\"La modification de service  est terminer avec succès\");{window.location.href = 'listServices.php'};</script>";
                }
                else {
                    echo "<script>alert(\"Le nom de service existe déjà\");</script>";
                }
            }catch(Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
            Database::disconnect();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
    else 
    {
        echo "<div class='messageErreur'><p class='text-center font-weight-bolder'>Aucune id de service sélectionner</p></div>";
    }
    require 'include/footer.php';
?>
<script>
    function Annuler()
    {
        window.location.href = "listServices.php";
    }
</script>