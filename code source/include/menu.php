
<!--/header-->
<header>
	<div class="top-bar_sub container-fluid">
		<div class="top-forms text-left mt-3">
			<!--/nav-->
			<div class="header_top">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<button class="navbar-toggler navbar-toggler-right mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mx-auto">
							<li class="nav-item active">
								<a class="nav-link" href="index.php">Home
									<span class="sr-only">(current)</span>
								</a>
							</li>
							
							
                            <?php 
                            
                            session_start();
                            if(!isset($_SESSION['id']) || !isset($_SESSION['type']))
                                {
                                echo '<li class="nav-item">
                                    <a class="nav-link " href="listCoiffeurs.php">list coiffeurs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="connection.php">connection</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="inscription.php">inscription</a>
                                </li>';
                                }
                                else
                                {
                                    if($_SESSION['type']=="admin")
                                    {
                                        echo '<li class="nav-item">
                                            <a class="nav-link " href="newCoiffeur.php">ajouter coiffeur</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="listCoiffeur.php">list coiffeurs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="deconnection.php">deconnection</a>
                                        </li>';
                                    }
                                    if($_SESSION['type']=="coiffeur")
                                    {
                                        echo '<li class="nav-item">
                                            <a class="nav-link " href="listServices.php">list services</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="listRendez-vous.php">list rendez-vous</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="monSalon.php">mon salon</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="deconnection.php">deconnection</a>
                                        </li>';
                                    }
                                    if($_SESSION['type']=="client")
                                    {
                                        echo '<li class="nav-item">
                                            <a class="nav-link " href="listCoiffeurs.php">list coiffeurs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="myReservation.php">mon reservation</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="deconnection.php">deconnection</a>
                                        </li>';
                                    }
                                }
                            
                            ?>

						</ul>
					</div>
					
				</nav>
			</div>
			<!--//nav-->
		</div>
		<div class="logo text-center">
			<a class="navbar-brand" href="index.php">
				<i class="fas fa-cut"></i> MY SALON <span> MEILLEUR SALON DE COIFFEURE</span></a> 
		</div>
	</div>
</header>

<!-- banner -->
<section class="banner" id="home">
	<div class="callbacks_container">
		<ul class="rslides" id="slider3">
			<li>
				<div class="slider-info bg1">
					<div class="bs-slider-overlay">
					<div class="banner-text container">
						<h5 class="tag text-left mb-3 text-uppercase">Nous sommes professionnels </h5>
						<h1 class="movetxt text-left agile-title text-uppercase">Le meilleur endroit pour </h1>
						<h2 class="movetxt text-left mb-3 agile-title text-uppercase">Salon de coiffure </h2>							
						<a class="bt mt-4 text-capitalize scroll" href="#about" role="button"> Lire la suite
							<i class="fas fa-cut"></i>
						</a> 
					</div>
					</div>
				</div>
			</li>
			<li>
				<div class="slider-info bg2">
					<div class="bs-slider-overlay">
					<div class="banner-text container">
						<h5 class="tag text-left mb-3 text-uppercase">Nous sommes uniques</h5>
						<h4 class="movetxt text-left agile-title text-uppercase">Votre beauté capillaire </h4>
						<h4 class="movetxt text-left mb-3 agile-title text-uppercase">Notre devoir</h4>
						<a class="bt mt-4 text-capitalize scroll" href="#about" role="button"> Lire la suite
							<i class="fas fa-cut"></i>
						</a>
					</div>
					</div>
				</div>
			</li>
			<li>
				<div class="slider-info bg3">
					<div class="bs-slider-overlay">
					<div class="banner-text container">
						<h5 class="tag text-left mb-3 text-uppercase">vos cheveux</h5>
						<h4 class="movetxt text-left agile-title text-uppercase">Nous rendons vos cheveux</h4>
						<h4 class="movetxt text-left mb-3 agile-title text-uppercase">parfaits</h4>
						
						<a class="bt mt-4 text-capitalize scroll" href="#about" role="button"> Lire la suite
							<i class="fas fa-cut"></i>
						</a>
					</div>
					</div>
				</div>
			</li>
			<li>
				<div class="slider-info bg4">
					<div class="bs-slider-overlay">
					<div class="banner-text container">
						<h5 class="tag text-left mb-3 text-uppercase">Nous faisons des cheveux stylés</h5>
						<h4 class="movetxt text-left mb-3 agile-title text-uppercase">Vraies barbes </h4>
						<a class="bt mt-4 text-capitalize scroll" href="#about" role="button"> Lire la suite
							<i class="fas fa-cut"></i>
						</a>
					</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
</section>
<!-- //banner -->






<!-- Date picker css file --> 
<link rel="stylesheet" href="css/jquery-ui.css" />
	<!-- //Date picker css file --> 
	
	<!-- responsive tabs --><!-- for pricing section -->
	<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
	<!-- responsive tabs -->
	
	<!-- css files -->
	<link rel="stylesheet" href="css/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="css/Acceuilstyle.css" type="text/css" media="all" /> <!-- Style-CSS --> 
	<link rel="stylesheet" href="css/fontawesome-all.css"> <!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">
	<!-- //web-fonts -->
		
        
        
        <!-- js -->
        <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
	<!-- //js -->
    	<!-- script for responsive tabs -->
	<script src="js/easy-responsive-tabs.js"></script>
	<script>
		$(document).ready(function () {
			$('#horizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion           
				width: 'auto', //auto or any width like 600px
				fit: true, // 100% fit in a container
				closed: 'accordion', // Start closed if in accordion view
				activate: function (event) { // Callback function if tab is switched
					var $tab = $(this);
					var $info = $('#tabInfo');
					var $name = $('span', $info);
					$name.text($tab.text());
					$info.show();
				}
			});
			$('#verticalTab').easyResponsiveTabs({
				type: 'vertical',
				width: 'auto',
				fit: true
			});
		});
	</script>
	<!--// script for responsive tabs -->
    <!-- Flexisel-js for-testimonials -->
	<script type="text/javascript">
		$(window).load(function() {
			$("#flexiselDemo1").flexisel({
				visibleItems:1,
				animationSpeed: 1000,
				autoPlay: false,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:480,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:640,
						visibleItems:1
					},
					tablet: { 
						changePoint:768,
						visibleItems: 1
					}
				}
			});
			
		});
	</script>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	<!-- Flexisel-js for-testimonials -->
	
<!-- Banner Responsiveslides -->
<script src="js/responsiveslides.min.js"></script>
	<script>
		$(function () {
			// Slideshow 4
			$("#slider3").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script>
	<!-- // Banner Responsiveslides -->


    <div class="space" style="margin-bottom:150px"></div>