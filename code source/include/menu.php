<?php
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>my Salon</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/fontawesome.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="top-bar_sub container-fluid">
            <div class="top-forms text-left mt-3">
                <!--/nav-->
                <div class="header_top">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler navbar-toggler-right mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
    
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="index.php">accueil</a>
                                </li>';
                                if(!isset($_SESSION['id']) || !isset($_SESSION['type']))
                                {
                                echo '<li class="nav-item">
                                    <a class="nav-link scroll" href="listCoiffeurs.php">list coiffeurs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="connection.php">connection</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="inscription.php">inscription</a>
                                </li>';
                                }
                                else
                                {
                                    if($_SESSION['type']=="admin")
                                    {
                                        echo '<li class="nav-item">
                                            <a class="nav-link scroll" href="newCoiffeur.php">ajouter coiffeur</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link scroll" href="listCoiffeur.php">list coiffeurs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link scroll" href="deconnection.php">deconnection</a>
                                        </li>';
                                    }
                                    if($_SESSION['type']=="coiffeur")
                                    {
                                        echo '<li class="nav-item">
                                            <a class="nav-link scroll" href="listServices.php">list services</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link scroll" href="listRendez-vous.php">list rendez-vous</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link scroll" href="monSalon.php">mon salon</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link scroll" href="deconnection.php">deconnection</a>
                                        </li>';
                                    }
                                    if($_SESSION['type']=="client")
                                    {
                                        echo '<li class="nav-item">
                                            <a class="nav-link scroll" href="listCoiffeurs.php">list coiffeurs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link scroll" href="myReservation.php">mon reservation</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link scroll" href="deconnection.php">deconnection</a>
                                        </li>';
                                    }
                                }
                            echo '</ul>
                        </div>
                    </nav>
                </div>
                <!--//nav-->
            </div>
            <div class="logo text-center">
                <a class="navbar-brand" href="index.php">
                    <i class="fas fa-cut"></i> My Salon <span> Meilleur salon de coiffure</span>
                </a> 
            </div>
        </div>
        <script src="js/jquery-3.5.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
    </html>';
?>