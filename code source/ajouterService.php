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
        echo '<form method="POST" action="">
            <div class="container">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nom Service</label>
                        <input type="text" class="form-control" name="nomService" minlength="5" pattern="^[a-zA-Z_\- \']{5,}$" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Prix en Dh</label>
                        <input type="number" min="30.00" max="3000.00" class="form-control" name="prix" step="1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Durée en heure</label>
                    <input type="time" min="00:05" max="02:00" class="form-control" name="duree" required>
                </div>
                <button type="submit" class="btn btn-info btn-lg" name="addService">ajouter</button>
            </div>
        </form>';
        if(isset($_POST['addService']))
        {
            try{
                require 'include/database.php';
                $id=$_SESSION['id'];
                $db = Database::connect();
                $nomService=$_POST['nomService'];
                $statement = $db->prepare("SELECT nom_service FROM service,salon WHERE service.id_salon=salon.id_salon and salon.idUser=$id and nom_service='$nomService'");
                $statement->execute();
                if ($statement->rowCount() == 0)
                {
                    $prix=$_POST['prix'];
                    $duree=$_POST['duree'];
                    $statement = $db->prepare("INSERT INTO service(id_salon,nom_service,duree,prix) SELECT id_salon,'$nomService','$duree',$prix FROM salon WHERE salon.idUser=$id");
                    $statement->execute();
                    echo "<script>alert(\"L'insertion de service  est terminer avec succès\");{window.location.href = 'listServices.php'};</script>";
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
    require 'include/footer.php';
?>