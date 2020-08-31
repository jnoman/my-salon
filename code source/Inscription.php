
<?php 
 require 'include/database.php';
              if(!empty($_POST)){
                $alert = [];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $db = Database::connect();
                
                  if(empty($nom)){
                      $alert = 'ecrire votre nom ';
                    }
                    elseif(empty($prenom)){
                      $alert = 'ecrire votre prenom ';
                    }
                    elseif(empty($email)){
                      $alert = 'ecrire votre email ';
                    }
                    elseif(empty($password)){
                      $alert = 'ecrire votre password ';
                    }
                  else{
                    
                    $stm=$db->query("INSERT INTO users VALUES ('','$nom','$prenom','$email','$password','client')");
                    header("Location: connection.php");
                    }
                  }
            ?>
              <?php  
              if(!empty($alert)){
                echo '<div class="alert alert-danger">'.$alert.'</div>';
              }
              
              // if($result==true){
              //   echo '<div class="alert alert-success">votre compte est bien enregiste</div>';
              // }else{
              //   echo '<div class="alert alert-danger">votre compte n\'est pas enregistre</div>';
              // }
              ?>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Event Registration Form</h2>
                </div>
                <div class="card-body">
                    <form action="Inscription.php" method="POST">
                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="nom"  minlength="4" pattern="[A-Z][a-zA-Z]*$" >
                                            <label class="label--desc">first name</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="prenom"  minlength="4" pattern="[A-Z][a-zA-Z]*$" >
                                            <label class="label--desc">last name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="email"  pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,3})$"  >
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="password"   pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" >
                                </div>
                            </div>
                        </div>
                        <div>
                            <button  class="btn btn--radius-2 btn--red" name="send" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




	
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
