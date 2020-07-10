<?php
    require 'include/header.php';
    require 'include/database.php';
    $db = Database::connect();
    $statement1 = $db->prepare("Select * from ville");
    $statement1->execute(); 
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-dark justify-content-center">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <form method="POST" action="" style="margin: 10px 20px">
                    <select class="form-control" name="genre" onchange="this.form.submit()">
                        <option>sélectionner genre</option>
                        <option value="femme" ';if(isset($_GET["genre"]) && !empty( $_GET['genre'] && $_GET["genre"]=='femme')){echo 'selected="selected"';} echo '>femme</option>
                        <option value="homme" ';if(isset($_GET["genre"]) && !empty( $_GET['genre'] && $_GET["genre"]=='homme')){echo 'selected="selected"';} echo '>homme</option>
                    </select>
                </form>
                <form method="POST" action="" style="margin: 10px 20px">
                    <select class="form-control" name="ville" onchange="this.form.submit()">
                        <option>sélectionner votre ville</option>';
                        while($row = $statement1->fetch())
                        {
                            echo '<option value="'. $row["nom_ville"].'"';if(isset($_GET["ville"]) && !empty( $_GET['ville'] ) && $_GET["ville"]==$row["nom_ville"]){echo 'selected="selected"';} echo'>'. $row["nom_ville"].'</option>';
                        }
                    echo '</select>
                </form>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" action="">
                <input class="form-control mr-sm-2" type="search" placeholder="nom salon" name="nomSalon" pattern="^[a-zA-Z_\- \']{3,}$" minlength="3" title="Le nom de la salon contient au moins 3 caractères" required ';if(isset($_GET["nomSalon"]) && !empty( $_GET['nomSalon'] )){echo 'value="';echo $_GET['nomSalon'].'"';} echo '>
                <button class="btn btn-outline-success my-2 my-sm-0" name="chercher" type="submit">Chercher</button>
            </form>
        </div>
    </nav>';
    if(isset($_GET["nomSalon"]) && !empty( $_GET['nomSalon'] ))
    {
        $nomCoiffeur=$_GET["nomSalon"];
        $statement = $db->prepare("SELECT id_salon,image,nom_salon FROM salon WHERE date_fin>=CURRENT_DATE and nom_salon LIKE '%$nomCoiffeur%'");
    }
    elseif(isset($_GET["genre"]) && !empty( $_GET['genre'] ) && isset($_GET["ville"]) && !empty( $_GET['ville'] ))
    {
        $genre=$_GET["genre"];
        $ville=$_GET["ville"];
        $statement = $db->prepare("SELECT id_salon,image,nom_salon FROM salon WHERE date_fin>=CURRENT_DATE and genre='$genre' and ville='$ville'");
    }
    elseif(isset($_GET["genre"]) && !empty( $_GET['genre'] ))
    {
        $genre=$_GET["genre"];
        $statement = $db->prepare("SELECT id_salon,image,nom_salon FROM salon WHERE date_fin>=CURRENT_DATE and genre='$genre'");
    }
    elseif(isset($_GET["ville"]) && !empty( $_GET['ville'] ))
    {
        $ville=$_GET["ville"];
        $statement = $db->prepare("SELECT id_salon,image,nom_salon FROM salon WHERE date_fin>=CURRENT_DATE and ville='$ville'");
    }
    else
    {
        $statement = $db->prepare("SELECT id_salon,image,nom_salon FROM salon WHERE date_fin>=CURRENT_DATE");
    }
    $statement->execute();
    if($statement->rowCount() > 0)
    {
        echo '<div class="divstandard"><table class="table table-striped">
            <div class="row row-cols-1 row-cols-md-3">';
            while($row = $statement->fetch()) {
                echo '<form method="POST" action="" name="search-form">
                    <div class="col mb-4" onClick="submitdiv('.$row['id_salon'].')">
                        <div class="card standardCard">
                            <img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" class="card-img-top" style="width: 100%;height:200px;margin-bottom: 50px;">
                            <div class="card-body">
                            <h5 class="card-title">'.$row['nom_salon'].'</h5>
                            </div>
                        </div>
                    </div>
                </form>';
            }
        echo '</div></div>';
    }
    else 
    {
        echo '<div class="messageErreur"><p class="text-center font-weight-bolder">Aucune coiffeur</p></div>';
    }
    Database::disconnect();

    if(isset($_POST['chercher']))
    {
        $nomSalon=$_POST['nomSalon'];
        echo "<script>window.location.href = 'listCoiffeurs.php?nomSalon=$nomSalon';</script>";
    }
    if(isset($_POST['genre']))
    {
        $genre=$_POST['genre'];
        if(isset($_GET["ville"]) && !empty( $_GET['ville'] ))
        {
            $ville=$_GET["ville"];
            if($genre!="sélectionner genre")
            {
                echo "<script>window.location.href = 'listCoiffeurs.php?genre=$genre&ville=$ville';</script>";
            }
            else
            {
                echo "<script>window.location.href = 'listCoiffeurs.php?ville=$ville';</script>";
            }
        }
        else
        {
            if($genre!="sélectionner genre")
            {
                echo "<script>window.location.href = 'listCoiffeurs.php?genre=$genre';</script>";
            }
            else
            {
                echo "<script>window.location.href = 'listCoiffeurs.php';</script>";
            }
        }
    }
    if(isset($_POST['ville']))
    {
        $ville=$_POST['ville'];
        if(isset($_GET["genre"]) && !empty( $_GET['genre'] ))
        {
            $genre=$_GET["genre"];
            if($genre!="sélectionner genre")
            {
                echo "<script>window.location.href = 'listCoiffeurs.php?genre=$genre&ville=$ville';</script>";
            }
            else
            {
                echo "<script>window.location.href = 'listCoiffeurs.php?genre=$genre';</script>";
            }
        }
        else
        {
            if($ville!="sélectionner genre")
            {
                echo "<script>window.location.href = 'listCoiffeurs.php?ville=$ville';</script>";
            }
            else
            {
                echo "<script>window.location.href = 'listCoiffeurs.php';</script>";
            }
        }
    }

    require 'include/footer.php';
?>
<script>
    function submitdiv(params) {
        window.location.href = 'coiffeurSelectionner.php?idSalon='+params;
    }
</script>