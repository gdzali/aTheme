<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title><?= bloginfo('name'); ?></title>
	<meta name="description" content="">
	<meta name="author" content="">

   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 	<!-- CSS
   ================================================== -->
   <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/maintenance-mode/css/base.css">
   <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/maintenance-mode/css/main.css">
   <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/maintenance-mode/css/vendor.css">

   <!-- script
   ================================================== -->
	<script src="<?= get_template_directory_uri(); ?>/assets/maintenance-mode/js/modernizr.js"></script>

   <!-- favicons
	================================================== -->
	<link rel="icon" type="image/png" href="favicon.png">

  <style media="screen">
    .info-coming-soon a {
      color:#fff !important;
      transition: 0.5s !important;
    }
    .info-coming-soon a:hover {
      color:#fff !important;
      text-decoration: underline !important;
      transition: 0.5s !important;
    }
  </style>

</head>

<body id="top">

	<!-- header
   ================================================== -->
   <header>

   	<div class="row">
   		<div class="logo">
	         <a href="index.html"><?= bloginfo('name'); ?></a>
	      </div>

			<!-- <div class="social-links">
			   <ul>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				   <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
				   <li><a href="#"><i class="fa fa-instagram"></i></a></li>
				   <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
				</ul>
			</div> -->
   	</div>

   </header> <!-- /header -->

   <!-- home
   ================================================== -->
   <section id="home" class="home-particles">

   	<div class="shadow-overlay"></div>

   	<div class="content-wrap-table">

		   <div class="main-content-tablecell">

		   	<div class="row">
		   		<div class="col-twelve">

		   			<!-- <div id="counter">
		   				<div class="half">
		   					<span>334 <sup>days</sup></span>
		 						<span>23 <sup>hours</sup></span>
		   				</div>
							<div class="half">
								<span>50 <sup>mins</sup></span>
		 						<span>33 <sup>secs</sup></span>
		 					</div>
		   			</div> -->

			  			<div class="bottom-text">
			  				<h1>Web sitemiz güncellenmektedir.</h1>
				  			<div class="info-coming-soon">
                <a href="mailto:<?= get_field('mail','option') ?>"><?= get_field('mail','option') ?></a></br>
                <a href="tel:<?= get_field('telefon','option') ?>"><?= get_field('telefon','option') ?></a>
              </div>
			  			</div>

			   	</div> <!-- /twelve -->


		   	</div> <!-- /row -->

		   </div> <!-- /main-content -->

		</div> <!-- /content-wrap -->

   </section> <!-- /home -->


   <!-- Java Script
   ================================================== -->
   <script src="<?= get_template_directory_uri(); ?>/assets/maintenance-mode/js/jquery-2.1.3.min.js"></script>
   <script src="<?= get_template_directory_uri(); ?>/assets/maintenance-mode/js/plugins.js"></script>
   <script src="<?= get_template_directory_uri(); ?>/assets/maintenance-mode/js/main.js"></script>

</body>

</html>
