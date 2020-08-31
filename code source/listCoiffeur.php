<?php
    require 'include/database.php';
    //include('include/menuAdmin/menu.php');
    include 'include/header.php' ;
?>
 <section class="ds ms s-pt-25 s-pb-50 c-gutter-0"> 
                        <div class="container">
                            <div class="row">
        <?php
            
            $db = Database::connect();
            $stmt=$db->prepare("SELECT * FROM users,salon WHERE users.idUser=salon.idUser");
            $stmt->execute();
                  
        
                while($row = $stmt->fetch())  
                    {  
                    echo '
                    
                                <div class="col-md-4" style="margin-bottom:20px">
                                    <img src="data:image/*;base64,'.base64_encode($row['image'] ).'" class="card-img-top" height:200px;" />  
                                    <h5 class="card-title">'.$row['nom'].' <br/> '.$row['genre'].' </h5> 
                                    <a href="UpdateDeleteCoiffeur.php?idUser='.$row["idUser"].'"><button type="button" name="idUser" class="btn btn-secondary">Détails</button></a>  
                                <div>
                            </div>
                        </div>
                    ';
                    }
        ?>
    </section>


	
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">