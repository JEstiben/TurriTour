<!DOCTYPE html>
<html lang="en">
<head>
<title>TurriTour</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Corporate web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web Designs" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--// Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="css/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
<link rel="stylesheet" href="css/animations.css"> <!-- Animations -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="all"/>
<link rel="shortcut icon" type="image/x-icon" href="images/icono.png"/>
<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
<!-- //web-fonts -->
</head>
<body>
<?php  
	if (isset($_POST['datos'])) {
    	echo $_POST['datos'];
	}//if
?>
<div class="main-agile">
	<!-- header -->
	<div class="header">
		<!-- Menu de navegacion -->
		<div class="w3_navigation">
			<div class="container">
				<nav class="navbar navbar-default">
					<div class="navbar-header navbar-left">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="logo">
							<h1><a class="navbar-brand" href="index.php">TurriTour</a></h1>
						</div>	
					</div>
					<!-- Opciones menu -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<nav class="menu menu--miranda">
							<ul class="nav navbar-nav menu__list">
								<li class="menu__item"><a href="index.php" class="menu__link">Inicio</a></li>
								<li class="menu__item"><a href="view/criterios.php" class="menu__link">Rutas</a></li>
								<li class="dropdown menu__item">
									<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown">Rutas<b class="caret"></b></a>
										<ul class="dropdown-menu agile_short_dropdown">
											<li><a href="view/obtenerRutaADM.php">Ver</a></li>
											<li><a href="view/CrearRuta.php">Crear</a></li>
										</ul>
								</li>
								<li class="dropdown menu__item">
									<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown">Atractivos<b class="caret"></b></a>
										<ul class="dropdown-menu agile_short_dropdown">
											<li><a href="view/obtenerAtractivoADM.php">Ver</a></li>
											<li><a href="view/crearAtractivo.php">Crear</a></li>
										</ul>
								</li>
								<li class="menu__item"><a href="view/informacion.php" class="menu__link">Información</a></li>
								<li class="menu__item"><a href="#" class="menu__link">Iniciar sesión</a></li>
							</ul>
						</nav>
					</div>
				</nav>	
				<div class="clearfix"></div>
			</div>	
		</div>
		<!-- Menu de navegacion -->
	</div>
	<!-- header -->
</div>
<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-1 col-md-10">
			<div class="col-md-offset-3 col-md-6">
				<div class="floating">
					<img style="max-width: 100%;" src="images/logo.png">
				</div>
			</div>
			<div class="col-md-12" style="text-align: center;">
				<h3>Bienvenido a TURRITOUR</h3>
			</div>
		</div>
	</div>
</div>
<!-- Contenido -->
<!-- Footer -->
<div class="footer w3ls">
	<div class="copyrights">
		<p>&copy; 2018 TurriTour.</p>
	</div>	
</div>
<!-- //Footer -->
<!-- js-scripts -->					
<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
<!-- //js -->	
<!-- Baneer-js -->
	<script src="js/responsiveslides.min.js"></script>
	<script>
		$(function () {
			$("#slider").responsiveSlides({
				auto: true,
				pager:false,
				nav: true,
				speed: 1000,
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
<!-- //Baneer-js --> 
<!-- start-smoth-scrolling -->
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
<!-- start-smoth-scrolling -->
<!-- //js-scripts -->
<!-- Owl-Carousel-JavaScript -->
	<script src="js/owl.carousel.js"></script>
	<script>
		$(document).ready(function() {
			$("#owl-demo").owlCarousel ({
				items : 4,
				lazyLoad : true,
				autoPlay : true,
				pagination : true,
			});
		});
	</script>
	<!-- //Owl-Carousel-JavaScript -->  

</body>
</html>