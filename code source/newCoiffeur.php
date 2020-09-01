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
            <div class="container" style="margin-left:250px;  margin-right:250px" >
                    <div class="container">
                        <input type="file" name="imageCoi" accept="image/*" OnChange="showPreview(this)" required><hr>
                        <img id="imgAvatar" class="rounded mx-auto d-block" style="width: 500px;height:300px;margin-bottom: 50px;">
                    </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nom Coiffeur</label>
                        <input type="text" class="form-control" name="nomCoiffeur" minlength="4" pattern="[A-Z][a-zA-Z]*$" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Prenom</label>
                        <input class="form-control" name="prenom" minlength="4" pattern="[A-Z][a-zA-Z]*$" required>
                    </div>
                    
                    

                    <div class="form-group col-md-6">
                    <label>Nombre d employes</label>
                    <select class="form-control" name="nombre" id="nombre" required>
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
                        <select class="form-control" name="genre" id="genre" required>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                        
                    </div>
                    <div class="form-group col-md-6">
                    <label>Date fin</label>
                        <input type="date" class="form-control" name="date_fin"  required>
                        </div>
                </div>
                
                <div class="form-group">
                    <label>email</label>
                    <input  class="form-control" name="email" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,3})$" required>
                </div>

                <div class="form-group ">
                        <label>password</label>
                        <input type="password" class="form-control" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" required>
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

                    $imageCoiffeur=addslashes(file_get_contents($_FILES['imageCoi']['tmp_name']));
                    $nomCoiffeur=$_POST['nomCoiffeur'];
                    $prenom=$_POST['prenom'];
                    $genre=$_POST['genre'];
                    $nombre_empl=$_POST['nombre'];
                    $date_fin=$_POST['date_fin'];
                    $email=$_POST['email'];
                    $password=$_POST['password'];

                    $statement = $db->prepare("INSERT INTO users(nom,prenom,email,password_user,roles) values ('$nomCoiffeur','$prenom','$email','$password','coiffeur')");
                    $statement->execute();
                    $statementt=$db->prepare("INSERT INTO salon(idUser,nombre_employes,date_fin,genre,image) values ($max_id,$nombre_empl,'$date_fin','$genre','$imageCoiffeur') ");
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