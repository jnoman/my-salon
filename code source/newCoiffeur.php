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
    else
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
            <div class="divstandard">
                    <div class="divstandard">
                        <input type="file" name="imageCoi" accept="image/*" OnChange="showPreview(this)" required><hr>
                        <img id="imgAvatar" class="rounded mx-auto d-block" style="width: 500px;height:300px;margin-bottom: 50px;">
                    </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nom Coiffeur</label>
                        <input type="text" class="form-control" name="nomCoiffeur"  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Prenom</label>
                        <input class="form-control" name="prenom"  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Genre</label>
                        <select class="form-control" name="genre" id="genre" required>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                        
                    </div>
                    <div class="form-group col-md-6">
                    <label>Date fin</label>
                        <input type="date" class="form-control" name="datefin"  required>
                        </div>
                </div>
                
                <div class="form-group">
                    <label>email</label>
                    <input  class="form-control" name="email" required>
                </div>

                <div class="form-group ">
                        <label>password</label>
                        <input class="form-control" name="password"  required>
                </div>
                <button type="submit" class="btn btn-info btn-lg" name="addCoiffeur">ajouter</button>
            </div>
        </form>';
        if(isset($_POST['addCoiffeur']))
        {
            try{
                require 'include/database.php';
                $id=$_SESSION['id'];
                $db = Database::connect();
                
                //Select Max id
                $idUser=$db->prepare("SELECT MAX(idUser) AS max_id FROM users ");
                $idUser->execute();
                $max = $idUser->fetch(PDO::FETCH_ASSOC);
                $max_id = $max['max_id']+1;


                //Select nombre employe
                $nmbr_empl=$db->prepare("SELECT MAX(nombre_employes) AS max_employe FROM salon ");
                $nmbr_empl->execute();
                $max_empl = $nmbr_empl->fetch(PDO::FETCH_ASSOC);
                $max_nmbr_empl = $max_empl['max_employe']+1;


                    $imageCoiffeur=addslashes(file_get_contents($_FILES['imageCoi']['tmp_name']));
                    $nomCoiffeur=$_POST['nomCoiffeur'];
                    $prenom=$_POST['prenom'];
                    $genre=$_POST['genre'];
                    $datefin=$_POST['datefin'];
                    $email=$_POST['email'];
                    $password=$_POST['password'];

                    $statement = $db->prepare("INSERT INTO users(nom,prenom,email,password_user,roles) values ('$nomCoiffeur','$prenom','$email','$password','coiffeur')");
                    $statement->execute();
                    $statementt=$db->prepare("INSERT INTO salon(idUser,nombre_employes,date_fin,genre,image) values ($max_id,$max_nmbr_empl,'$datefin','$genre','$imageCoiffeur') ");
                    $statementt->execute();

                    echo "<script>alert(\"L'insertion de service  est terminer avec succès\");{window.location.href = 'listCoiffeur.php'};</script>";
                
                
            }catch(Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
            Database::disconnect();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
    require 'include/footer.php';
?>