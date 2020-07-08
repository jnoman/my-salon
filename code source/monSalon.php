<?php
    require 'include/header.php';
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
        $statement1 = $db->prepare("Select * from ville");
        $statement1->execute(); 
        echo '<form method="POST" id="foo" action="" enctype="multipart/form-data"><div class="divstandard">
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
                    <input type="text" class="form-control" name="nomSalon" value="'.$item["nom_salon"].'" pattern="^[a-zA-Z_- \']{10,}$" minlength="10" title="Le nom de la salon contient au moins 10 caractères" required>
                </div>
                <div class="form-group col-md-6">
                    <label>téléphone</label>
                    <input type="tele" class="form-control" name="telephone" pattern="^(06|05)([0-9]{8})$" minlength="10" maxlength="10" title="Le numéro de téléphone contient 10 numéros" required value="'.$item["telephone"].'" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label>adresse</label>
                    <input type="text" class="form-control" name="adresse" pattern="^[A-z0-9_- \']{10,}$" minlength="10" title="L\'adresse contient les caractères et les numéros" required value="'.$item["adresse"].'">
                </div>
                <div class="form-group col-md-4">
                    <label>ville</label>
                    <select class="form-control" name="ville">';
                        if ($item["ville"]==null) 
                        {
                            echo '<option>sélectionner votre ville</option>';
                        }
                        while($row = $statement1->fetch())
                        {
                            echo '<option value="'. $row["nom_ville"].'"';if($item["ville"]==$row["nom_ville"]){echo 'selected="selected"';} echo'>'. $row["nom_ville"].'</option>';
                        }
                    echo '</select>
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
                <button type="submit" class="btn_stndard" name="updateSalon">Modifier</button>
                <input type="button" value="Annuler" onClick="Annuler()" class="btn_stndard"/>
            </div>
        </form>';
        Database::disconnect();
        require 'include/footer.php';

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