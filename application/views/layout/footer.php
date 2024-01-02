<footer class="ftco-footer ftco-bg-dark ftco-section">
		<div class="container">
		  <div class="row mb-5">
			<div class="col-md-6 col-lg-3 col-12">
			  <div class="ftco-footer-widget mb-4">
				<a class="logo" href="<?php echo base_url('home') ?>"><img class="img-fluid" src="<?php echo base_url() ?>/assets/images/logo.png" alt=""></a>
				<p><?php echo get_settings('footer_text') ?></p>
				<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3 mb-4">
				  <li class="ftco-animate"><a href="<?php echo get_settings('twitter') ?>"><span class="icon-twitter"></span></a></li>
				  <li class="ftco-animate"><a href="<?php echo get_settings('facebook') ?>"><span class="icon-facebook"></span></a></li>
				  <li class="ftco-animate"><a href="<?php echo get_settings('instagram') ?>"><span class="icon-instagram"></span></a></li>
				</ul>
			  </div>
			</div>
			<div class="col-md-6 col-lg-3 col-12">
			  <div class="ftco-footer-widget mb-4 ml-md-5">
				<h2 class="ftco-heading-2">Quick Links</h2>
				<ul class="list-unstyled">
	
				  <li><a href="<?= base_url('about') ?>" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>About
					  US</a></li>
				  <li><a href="<?= base_url('contact') ?>" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Contact</a></li>
				  <li><a href="<?= base_url('team') ?>" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>OurTeam</a></li>
				  <li><a href="<?= base_url('membership') ?>" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Membership</a></li>
				  <li><a href="<?= base_url('howitwork') ?>" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>How It Works</a></li>
	
				  <li><a href="<?php echo base_url('faq') ?>" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>FAQ</a>
				  </li>
	
	
				</ul>
			  </div>
			</div>
			<div class="col-md-6 col-lg-3 col-12">
			  <div class="ftco-footer-widget mb-4">
				<h2 class="ftco-heading-2">Have a Questions?</h2>
				<div class="block-23 mb-3">
				  <ul>
					<li><span class="icon icon-map-marker"></span><span class="text"><?php echo get_settings('footer_address') ?></span></li>
					<li><a href="#"><span class="icon icon-phone"></span><span class="text"><?php echo get_settings('footer_contact') ?></span></a></li>
					<li><a href="#"><span class="icon icon-envelope"></span><span
						  class="text"><?php echo get_settings('footer_email') ?></span></a></li>
				  </ul>
				</div>
			  </div>
			</div>
			<div class="col-md-6 col-lg-3 col-12">
			  <div class="ftco-footer-widget mb-4">
				<h2 class="ftco-heading-2">Download App</h2>
				<div class="mb-2">
				  <a href="<?php echo get_settings('appstore_link'); ?>"> <img class="img-fluid" src="<?php echo base_url() ?>/assets/images/apple-img 1.png" alt=""></a>
				</div>
				<div><a class="mr-3" href="<?php echo get_settings('play_store_link'); ?>"> <img class="img-fluid" src="<?php echo base_url() ?>/assets/images/playstore 1.png" alt=""></a>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-md-12 text-center">
	
			  <p>
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				<?php echo get_settings('footer_copyright') ?>
	
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
			  </p>
			</div>
		  </div>
		</div>
	  </footer>



	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
				stroke="#F96D00" />
		</svg></div>


	<script src="<?php echo base_url('/assets/js/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/jquery-migrate-3.0.1.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/popper.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/jquery.easing.1.3.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/jquery.waypoints.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/jquery.stellar.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/owl.carousel.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/jquery.magnific-popup.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/aos.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/jquery.animateNumber.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/scrollax.min.js') ?>"></script>
	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="<?php echo base_url('/assets/js/google-map.js') ?>"></script>
	<script src="<?php echo base_url('/assets/js/main.js') ?>"></script>

</body>

</html>