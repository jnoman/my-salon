<?php
    require 'include/header.php';
    if(!isset($_SESSION['id']))
    {
        echo "<script>{window.location.href = 'connection.php'};</script>";
    }
    elseif($_SESSION['type'] != "admin")
    {
        echo "<div class='messageErreur'><p class='text-center font-weight-bolder'>Vous n'êtes pas autorisé à accéder à cette page</p></div>";
    }
    elseif(isset($_GET["idUser"]) && !empty( $_GET['idUser'] ))
    {
        require 'include/database.php';
        $id=$_SESSION['id'];
        $idUser=$_GET["idUser"];
        $db = Database::connect();
        $statement = $db->prepare("SELECT nom,prenom,email,password_user,nombre_employes,date_fin,genre,image FROM users,salon WHERE users.idUser=salon.idUser and salon.idUser=$idUser ");
        $statement->execute();
        if($item = $statement->fetch())
        {
            echo '<form method="POST" action=""  enctype="multipart/form-data">
            
            <script language="JavaScript">
            function showPreview(ele)
            {
                $("#imgAvatar").attr("src", ele.value); // for IE
                        if (ele.files && ele.files[0]) {
                
                            var reader = new FileReader();
                    
                            reader.onload = function (e) {
                                $("#imgAvatar").attr("src", e.target.result);
                            }

                            reader.readAsDataURL(ele.files[0]);
                        }
            }
            </script>
            <div class="container">
            <input type="file" name="imageCoi" accept="image/*" OnChange="showPreview(this)">
            <hr>
            <img id="imgAvatar" src="data:image/*;base64,'.base64_encode($item['image'] ).'" class="rounded mx-auto d-block" style="width: 500px;height:300px;margin-bottom: 50px;">
            </div>


                <div class="container"  style="margin-left:250px;  margin-right:250px" >
                
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nom Coiffeur</label>
                            <input type="text" class="form-control" name="nomCoiffeur"  minlength="4" pattern="[A-Z][a-zA-Z]*$"  required  value="'.$item["nom"].'">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Prenom</label>
                            <input class="form-control" name="prenom"  minlength="4" pattern="[A-Z][a-zA-Z]*$"  required  value="'.$item["prenom"].'">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Nombre d employes</label>
                        <select class="form-control" name="nombre" id="nombre" required >
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        
                    </div>
                        <div class="form-group col-md-6">
                            <label>Genre</label>
                            <select class="form-control" name="genre" id="genre" required  >
                                <option value="Homme" >Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                            
                        </div>
                        <div class="form-group col-md-6">
                        <label>Date fin</label>
                            <input type="date" class="form-control" name="date_fin"  required  value="'.date('Y-m-d',strtotime($item["date_fin"])).'">
                            </div>
                    </div>
                    
                    <div class="form-group">
                        <label>email</label>
                        <input  class="form-control" name="email"  pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,3})$" required  value="'.$item["email"].'">
                    </div>
    
                    <div class="form-group ">
                            <label>password</label>
                            <input class="form-control" name="password"  pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$"   required  value="'.$item["password_user"].'">
                    </div>
                    <button type="submit" class="btn btn-info btn_stndard" name="updateCoiffeur">Modifier</button>
                    <button type="submit" class="btn btn-info btn_stndard" name="deleteCoiffeur">Supprimer</button>
                    <input type="button" value="Annuler" onClick="Annuler()" class="btn btn-info btn_stndard"/>
                </div>
            </form>';
        }
        else {
            echo '<div class="messageErreur"><p class="text-center font-weight-bolder">Id de Coiffeur n\'est pas valid</p></div>';
        }
        Database::disconnect();
        if(isset($_POST['updateCoiffeur']))
        {
            try{
                $db = Database::connect();
                    $imageCoiffeur=addslashes(file_get_contents($_FILES['imageCoi']['tmp_name']));
                    $nomCoiffeur=$_POST['nomCoiffeur'];
                    $prenom=$_POST['prenom'];
                    $nombre_empl=$_POST['nombre'];
                    $genre=$_POST['genre'];
                    $date_fin=$_POST['date_fin'];
                    $email=$_POST['email'];
                    $password=$_POST['password'];
                    
                    $statement = $db->prepare("UPDATE users,salon set image='$imageCoiffeur',  nom='$nomCoiffeur', prenom='$prenom',nombre_employes=$nombre_empl, genre='$genre', date_fin='$date_fin' , email='$email', password_user='$password' where users.idUser=salon.idUser and salon.idUser=$idUser");
                    $statement->execute();

                    echo "<script>alert(\"La modification de service  est terminer avec succès\");{window.location.href = 'listCoiffeur.php'};</script>";
                
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


    Database::disconnect();
    if(isset($_POST['deleteCoiffeur']))
    {
        try{
        $db = Database::connect();
        $sql = $db->prepare("SELECT * FROM users,salon where users.idUser=salon.idUser and salon.idUser=$idUser");
        $sql->execute();
        if ($sql->rowCount() > 0)
        {
            $statement = $db->prepare("DELETE FROM Users where idUser=$idUser ");
            $statement->execute();
                echo "<script>alert(\"suppression de produit terminer avec succès\")</script>";
                echo '<script>javascript:history.go(-2);</script>';
            
            
        }
    }catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
    Database::disconnect();
    }
    require 'include/footer.php';
?>
<script>
    function Annuler()
    {
        window.location.href = "listCoiffeur.php";
    }
</script>