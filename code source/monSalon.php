<?php
    require 'include/footer.php';
    if(!isset($_SESSION['id']))
    {
        echo "<script>{window.location.href = 'connection.php'};</script>";
    }
    elseif($_SESSION['type'] != "coiffeur")
    {
        echo "<div class='messageErreur'><p>Vous n'êtes pas autorisé à accéder à cette page</p></div>";
    }
    else
    {
        require 'include/database.php';
        $id=$_SESSION['id'];
        $db = Database::connect();
        $statement = $db->prepare("Select * from Salon where idUser = $id");
        $statement->execute(); 
        $item = $statement->fetch();
        echo '<form method="POST" action="" enctype="multipart/form-data"><div class="divstandard">
            <script language="JavaScript">
                function showPreview(ele)
                {
                    $("#imgAvatar").attr("src", ele.value);
                    if (ele.files && ele.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("#imgAvatar").attr("src", e.target.result);
                        }
                        reader.readAsDataURL(ele.files[0]);
                    }
                }
                function Annuler()
                {
                    window.location.href = "index.php";
                }
            </script>
            <div class="divstandard">
                <input type="file" name="imageSalon" accept="image/*" OnChange="showPreview(this)">
                <hr>
                <img id="imgAvatar" src="data:image/jpeg;base64,'.base64_encode($item['image'] ).'" class="rounded mx-auto d-block" style="width: 800px;height:300px;margin-bottom: 50px;">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>nom salon</label>
                    <input type="text" class="form-control" name="nomSalon" required value="'.$item["nom_salon"].'">
                </div>
                <div class="form-group col-md-6">
                    <label>telephone</label>
                    <input type="tele" class="form-control" name="telephone" required value="'.$item["telephone"].'">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label>adresse</label>
                    <input type="text" class="form-control" name="adresse" required value="'.$item["adresse"].'">
                </div>
                <div class="form-group col-md-4">
                    <label>ville</label>
                    <select class="form-control" name="ville">
                        <option value="safi">safi</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label>date debut travail</label>
                <input class="form-control" type="time" min="05:00" max="16:00" name="dateDebutTravail" value="'.date('H:i',strtotime($item["date_debut_travail"])).'">
            </div>
            <div class="form-group col-md-6">
                <label>date fin travail</label>
                <input class="form-control" type="time" min="16:00" max="23:59" name="dateFinTravail" value="'.date('H:i',strtotime($item["date_fin_travail"])).'">
            </div>
            </div>
                <button type="submit" class="btn btn-info btn-lg" name="updateSalon">Modifier</button>
                <input type="button" value="Annuler" onClick="Annuler()" class="btn btn-info btn-lg"/>
            </div>
        </form>';
        Database::disconnect();


        if(isset($_POST['updateSalon']))
        {
            try{
            $db = Database::connect();
            $nom_salon=$_POST['nomSalon'];
            $telephone=$_POST['telephone'];
            $adresse=$_POST['adresse'];
            $ville=$_POST['ville'];
            $dateDebutTravail=$_POST['dateDebutTravail'];
            $dateFinTravail=$_POST['dateFinTravail'];
            $sql = "UPDATE Salon SET nom_salon='$nom_salon', telephone='$telephone', adresse='$adresse', ville='$ville', date_debut_travail='$dateDebutTravail' , date_fin_travail='$dateFinTravail' where idUser=$id";
            if($_FILES['imageSalon']['tmp_name'])
            {
                $imageSalon=addslashes(file_get_contents($_FILES['imageSalon']['tmp_name']));
                $sql = "UPDATE Salon SET image='$imageSalon', nom_salon='$nom_salon', telephone='$telephone', adresse='$adresse', ville='$ville', date_debut_travail='$dateDebutTravail' , date_fin_travail='$dateFinTravail' where idUser=$id";
            }
            $statement = $db->prepare($sql);
            $statement->execute();
            echo "<script>alert(\"La modification des données et terminer avec succès\")</script>";
            }catch(Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
            Database::disconnect();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
?>