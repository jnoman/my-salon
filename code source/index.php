
<!DOCTYPE html>
<html lang="fr">
<head>
<title>My SALON</title>
	
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="My salon" />
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--// Meta tag Keywords -->
	
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
	
</head>

<body>
<?php
    require 'include/header.php';
?>

<!-- About -->
<section class="about py-5" id="about">
	<div class="container py-lg-3 py-2">
		<div class="heading text-center">
			<i class="fas fa-cut"></i>
			<h3 class="heading mb-sm-5 mb-3 text-uppercase">À propos de nous</h3>
		</div>
		<div class="row about-grids">
			<div class="col-lg-4 about-grid1 mb-lg-0 mb-5">
				<h3 class="text-uppercase">Bienvenue dans notre salon de coiffure</h3>
				
				<p class="my-3">Nam sed ullamcorper elit, sit amet libero in imperdiet dolor. Maecenas non commodo libero.</p>
				<!-- <a class="bt text-capitalize" href="#" role="button"> Lire la suite
					<i class="fas fa-cut"></i>
				</a> -->
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="about-grid2 p-5">
					<h3>Expert en coiffure</h3>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="about-grid3 p-5">
					<h3>Meilleure expérience</h3>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //About -->

<!-- services -->
<section class="services py-5" id="services">
	<div class="container-fluid">
		<div class="heading text-center">
			<i class="fas fa-cut"></i>
			<h3 class="heading mb-sm-5 mb-3 text-uppercase">Ce que nous faisons</h3>
		</div>
		<div class="row service-grids">
			<div class="col-lg-2 col-sm-6 col-12 serviceimage1">
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 py-5 px-4 servicetext">
				<h4>Coupe de cheveux classique</h4>
				<p class="my-3">Nam sed ullamcorper elit, sit amet libero in imperdiet dolor. Maecenas non commodo libero.</p>
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 serviceimage2">
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 py-5 px-4 servicetext">
				<h4>Épilation à la barbe</h4>
				<p class="my-3">Nam sed ullamcorper elit, sit amet libero in imperdiet dolor. Maecenas non commodo libero.</p>
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 serviceimage3">
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 py-5 px-4 servicetext">
				<h4>Coloration de cheveux</h4>
				<p class="my-3">Nam sed ullamcorper elit, sit amet libero in imperdiet dolor. Maecenas non commodo libero.</p>
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 py-5 px-4 servicetext">
				<h4>Redressage</h4>
				<p class="my-3">Nam sed ullamcorper elit, sit amet libero in imperdiet dolor. Maecenas non commodo libero.</p>
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 serviceimage3">
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 py-5 px-4 servicetext">
				<h4>Barbe</h4>
				<p class="my-3">Nam sed ullamcorper elit, sit amet libero in imperdiet dolor. Maecenas non commodo libero.</p>
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 serviceimage1">
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 py-5 px-4 servicetext">
				<h4>Rasage propre</h4>
				<p class="my-3">Nam sed ullamcorper elit, sit amet libero in imperdiet dolor. Maecenas non commodo libero.</p>
				
			</div>
			<div class="col-lg-2 col-sm-6 col-12 serviceimage2">
				
			</div>
		</div>
	</div>
</section>
<!-- //services -->


<!-- testimonials -->
	<div class="testimonials" id="testimonials">
	   <div class="test_agile_info py-5">
		<div class="container py-lg-3">
		<div class="heading text-center">
			<i class="fas fa-cut"></i>
			<h3 class="heading mb-sm-5 mb-3 text-uppercase">Mots des clients</h3>
		</div>
			<ul id="flexiselDemo1">			
				<li>
					<div class="wthree_testimonials_grid_main">
						<div class="wthree_testimonials_grid">
							<p>Donec laoreet eu purus eu viverra. Vestibulum sed convallis massa,
								eu aliquet massa init. Suspendisse lacinia rutrum tincidunt. Integer id erat porta, 
								convallis tortor Vestibulum sedconvallis massa purus eu viverra.</p>
							<h5>Mark Henry</h5>
							<div class="wthree_testimonials_grid_pos">
								<img src="images/t1.jpg" alt=" " class="img-responsive" />
							</div>
						</div>
					
					</div>
				</li>
				<li>
					<div class="wthree_testimonials_grid_main">
						<div class="wthree_testimonials_grid">
							<p>Lorem laoreet eu purus eu viverra. Vestibulum sed convallis massa,
								eu aliquet massa init. Suspendisse lacinia rutrum tincidunt. Integer id erat porta, 
								convallis tortor Vestibulum sedconvallis massa purus eu viverra.</p>
							<h5>Linda Carl</h5>
							<div class="wthree_testimonials_grid_pos">
								<img src="images/t2.jpg" alt=" " class="img-responsive" />
							</div>
						</div>
					
					</div>
				</li>
				<li>
					<div class="wthree_testimonials_grid_main">
						<div class="wthree_testimonials_grid">
							<p>Donec laoreet eu purus eu viverra. Vestibulum sed convallis massa,
								eu aliquet massa init. Suspendisse lacinia rutrum tincidunt. Integer id erat porta, 
								convallis tortor Vestibulum sedconvallis massa purus eu viverra.</p>
							<h5>Michael Paul</h5>
							<div class="wthree_testimonials_grid_pos">
								<img src="images/t3.jpg" alt=" " class="img-responsive" />
							</div>
						</div>
						
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- //testimonials -->


<!-- contact map and address -->
<section class="contact py-5" id="contact">
	<div class="container">
		<div class="heading text-center">
			<i class="fas fa-cut"></i>
			<h3 class="heading mb-sm-5 mb-3 text-uppercase">Nous localiser</h3>
		</div>
		<div class="contact-main-grid">
			<div class="contact-map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.94722638946!2d2.277020320550042!3d48.85883773941345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis%2C+France!5e0!3m2!1sen!2sin!4v1524720355592"></iframe>
			</div>
			<div class="contact-info">
				<div class="mb-5">
					<h4 class="mb-3">Addresse</h4>
					<p><span class="fas fa-map mr-2"></span> 123 Youcode, Safi</p>
					<p>Safi, Maroc.</p>
					<p><span class="fas fa-phone mr-2"></span> +212 600 00 00 00</p>
					<p><span class="fas fa-envelope mr-2"></span> <a href="mailto:salon@mysalon.com"> salon@mysalon.com</a> </p>
				</div>
				<div class="">
					<h4 class="mb-3"> Heures d'ouverture</h4>
					<p><span class="fas fa-clock mr-2"></span> Lundi - vendredi : 9am - 6pm</p>
					<p><span class="fas fa-clock mr-2"></span> samedi et dimanche : 10am - 4pm</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- contact map and address -->


<!-- footer section -->
<section class="newsletter text-center py-5">
	<div class="container py-lg-3">
		<div class="logo mb-5 text-center">
			<a class="navbar-brand" href="index.php">
				<i class="fas fa-cut"></i> MY SALON <span> Meilleur salon de coiffure</span></a> 
		</div>
		<div class="subscribe_inner">
			<i class="fas fa-cut"></i>
			<h4 class="mb-4">Abonnez-nous</h4>
			<p class="mb-4">Abonnez-vous à notre newsletter pour recevoir les dernières offres de notre barbier. </p>
			<form action="#" method="post" class="subscribe_form">
				<input class="form-control" type="email" placeholder="Enter Your Email..." required="">
				<button type="submit" class="btn1 btn-primary submit"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
			</form>
			<div class="social mt-5">
				<ul class="d-flex mt-4 justify-content-center">
					<li class="mx-2"><a href="#"><span class="fab fa-facebook-f"></span></a></li>
					<li class="mx-2"><a href="#"><span class="fab fa-twitter"></span></a></li>
					<li class="mx-2"><a href="#"><span class="fas fa-rss"></span></a></li>
					<li class="mx-2"><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
					<li class="mx-2"><a href="#"><span class="fab fa-google-plus"></span></a></li>
				</ul>
			</div>
		</div>
		<div class="copyright mt-5">
			<p>© 2020 SALON. HOUSSNI OUCHAD - NOMAN JAMAL EDDIN </p>
		</div>
	</div>
</section>
<!-- //footer section -->

<!-- js-scripts -->		

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
	
	<!-- Calendar js for date picker-->
	<script src="js/jquery-ui.js"></script>
	<script>
		$(function () {
			$("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
		});
	</script>
	<!-- //Calendar -->

	<!-- Banner Responsiveslides -->
	<script src="js/responsiveslides.min.js"></script>
	<script>
		// You can also use "$(window).load(function() {"
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

	<!-- start-smoth-scrolling -->
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
	<!-- //here ends scrolling icon -->
	<!-- start-smoth-scrolling -->
	
<!-- //js-scripts -->

</body>
</html>