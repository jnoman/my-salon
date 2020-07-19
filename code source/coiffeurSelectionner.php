<?php
    require 'include/header.php';
    if(!isset($_SESSION['id']))
    {
        echo "<script>{window.location.href = 'connection.php'};</script>";
    }
    elseif($_SESSION['type'] != "client")
    {
        echo "<div class='messageErreur'><p class='text-center font-weight-bolder'>Vous n'êtes pas autorisé à accéder à cette page</p></div>";
    }
    elseif(isset($_GET["idSalon"]) && !empty( $_GET['idSalon'] ))
    {
        require 'include/database.php';
        $id=$_SESSION['id'];
        $idSalon=$_GET["idSalon"];
        $db = Database::connect();
        $statement = $db->prepare("SELECT nom_salon,adresse,ville,genre,image,date_debut_travail,date_fin_travail FROM salon WHERE id_salon=$idSalon and date_fin>=CURRENT_DATE");
        $statement->execute();
        if($item = $statement->fetch())
        {
            echo '<form method="POST" action="">
                <div class="divstandard divcard">
                    <div class="card mb-3" style="width: 100%;height:400px;">
                        <div class="row no-gutters">
                            <div class="col-md-8">
                                <img src="data:image/jpeg;base64,'.base64_encode($item['image'] ).'" class="card-img" style="width: 100%;height:400px;margin-bottom: 50px;">
                            </div>
                            <div class="col-md-4">
                                <div class="card-body" style="margin-top:100px;">
                                    <h5 class="card-title">'.$item['nom_salon'].'</h5>
                                    <p class="card-text">'.$item['adresse'].' , '.$item['ville'].'</p>
                                    <p class="card-text"><small class="text-muted">'.$item['genre'].'</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">list service</h5>';
                                    $statement1 = $db->prepare("SELECT id_service,nom_service,MINUTE(duree),prix FROM service WHERE id_salon=$idSalon");
                                    $statement1->execute();
                                    if ($statement1->rowCount() > 0) {
                                        // output data of each row
                                        echo '<table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">id service</th>
                                                <th scope="col">nom service</th>
                                                <th scope="col">durée en minute</th>
                                                <th scope="col">prix en Dh</th>
                                                <th scope="col">select</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                                        while($row = $statement1->fetch()) {
                                            echo '<tr">
                                                    <th scope="row">'. $row["id_service"].'</th>
                                                    <td>'. $row["nom_service"].'</td>
                                                    <td>'. $row["MINUTE(duree)"].'</td>
                                                    <td>'. $row["prix"].'</td>
                                                    <td><input type="checkbox" name="selectservice[]" value="'. $row["id_service"].'" onchange="calculePrixDuree()"/> select</td>
                                                </tr>';
                                        }
                                        echo "</tbody>
                                        </table>";
                                    }
                                    echo'<p class="card-text" name="prixToltal">Total prix : 0 Dh</p>
                                    <p class="card-text" name="dureeToltal">Total duree : 0 h 0 m</p>
                                    <input type="hidden" name="prixT"><input type="hidden" name="dureeT">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-body">
                                    <input name="dateReserv" type="date" min="'. date('Y-m-d').'" value="'. date('Y-m-d').'" onchange="calculePrixDuree()"/>
                                    <div id="txtHint">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>';
        }
        else {
            echo '<div class="messageErreur"><p class="text-center font-weight-bolder">id de salon n\'est pas valid</p></div>';
        }
        Database::disconnect();
        if(isset($_POST['ajouterReservation']))
        {
            try{
                $db = Database::connect();
                $prixT=$_POST['prixT'];
                $dureeT=$_POST['dureeT'];
                $timeReserv=$_POST['timeReserv'];
                $dateReserv=$_POST['dateReserv'];
                $statement = $db->prepare("SELECT employe.id_employe FROM resrvation,employe WHERE employe.id_salon=$idSalon and employe.id_employe not in(SELECT id_employe FROM resrvation WHERE date_debut>='$dateReserv $timeReserv' and date_debut<=('$dateReserv $timeReserv' + INTERVAL duree MINUTE)) order by employe.id_employe");
                $statement->execute();
                $item1 = $statement->fetch();
                echo "<script>alert('".$item1['id_employe']."');</script>";
                $statement1 = $db->prepare("INSERT INTO resrvation(id_employe,idUser,date_debut,duree,etat_reservation,prixT) VALUES(".$item1['id_employe'].",$id,'$dateReserv $timeReserv',$dureeT,'en attente',$prixT)");
                $statement1->execute();
                $last_id = $db->lastInsertId();
                echo "<script>alert('$last_id');</script>";
                foreach($_POST['selectservice'] as $selectservice) 
                {
                    $statement2 = $db->prepare("INSERT INTO lignereservation(id_service,id_reservation) VALUES($selectservice,$last_id)");
                    $statement2->execute();
                }
                echo "<script>alert(\"L'ajouter de rendez-vous est terminer avec succès\");{window.location.href = 'index.php'};</script>";
            }catch(Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
            Database::disconnect();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
    else 
    {
        echo "<div class='messageErreur'><p class='text-center font-weight-bolder'>Aucune id de salon sélectionner</p></div>";
    }
    require 'include/footer.php';
?>
<script>
    function calculePrixDuree() {
        var values = 0.00;
        var values2 = 0;
        $("input[name='selectservice[]']:checked").each(function() {
            values=values+parseFloat($(this).parent().parent().children().eq(3).text());
            values2=values2+parseInt($(this).parent().parent().children().eq(2).text());
        });
        var h=parseInt(values2/60);
        var m=values2-(60*h);
        $("p[name='prixToltal']").text("Total prix : "+values+" Dh");
        $("p[name='dureeToltal']").text("Total duree : "+h+" h "+m+" m");
        $("input[name='prixT']").val(values);
        $("input[name='dureeT']").val(values2);
        var date=$("input[name='dateReserv']").val();
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","include/selectDate.php?duree="+values2+"&id=<?php echo $idSalon ?>&date="+date,true);
        xmlhttp.send();
    };

    $('tr').click(function() {
        
        var v=$(this).find('td input[name="selectservice[]"]');
        if(v.attr('checked'))
        {
            v.attr('checked', false);
        }
        else
        {
            v.attr('checked', true);
        }
        calculePrixDuree()
    })
</script>