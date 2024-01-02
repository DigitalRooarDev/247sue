

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo base_url() ?>/assets/images/header_image.jpg');"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text slider-text-version-2  js-fullheight align-items-center justify-content-start"
				data-scrollax-parent="true">
				<div class="col-md-8 ftco-animate">
					<h2 class="subheading">Welcome To 247Sue</h2>
					<h1>Attorneys Fighting For Your
						<span class="txt-rotate" data-period="2000"
							data-rotate='[ "Freedom.", "Rights.", "Case.", "Custody." ]'></span>
					</h1>
					<!-- <h1 class="mb-4">Attorneys Fighting For Your Freedom</h1> -->
					<p class="mb-4">We have helped thousands of people nation wide fight wrongful denials. Now they trust 247Sue attorneys.</p>
					<a class="mobile-spcinging-links mr-2" href="<?php echo get_settings('appstore_link'); ?>"> <img class="img-fluid" src="<?php echo base_url() ?>/assets/images/apple-img 1.png"
							alt=""></a> <a class=" mobile-spcinging-links" href="<?php echo get_settings('play_store_link'); ?>"> <img class="img-fluid"
							src="<?php echo base_url() ?>/assets/images/playstore 1.png" alt=""></a>
				</div>
			</div>
		</div>
	</div>


	<section class="ftco-section  about-us">
		<div class="container overflow">
			<div class="row d-flex overflow">
				<div class="col-lg-6 col-md-12 col-12 d-flex overflow">
					<div
						class="img  d-flex align-self-stretch align-items-center justify-content-center justify-content-md-end">
						<!-- <a href="https://vimeo.com/45830194"
							class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
							<span class="icon-play"></span>
						</a> -->
						<img class="img-fluid" src="<?php echo base_url() ?>/assets/images/about_1 1.jpg" alt="">
					</div>
				</div>
				<div class=" col-lg-6 col-md-12 col-12">
					<div class="row justify-content-start pt-3 pb-3">
						<div class="col-md-12 heading-section ftco-animate">
							<span class="subheading">Welcome to 247Sue</span>
							<h2 class="mb-4">We provide equal access to Justice for all</h2>
							<p>247Tech UG is a German company that has been proffering technical solutions for Africa
								since 2016. In 2020, 247Tech & Infrastructure Limited Nigeria was formed to innovate
								applications to improve the lives of everyday people. To make exercising rights for
								everyone easy, accessible and affordable, we have developed the mobile application
								247Sue. An application that makes it exceptionally easy and affordable for everyone to
								exercise their rights without connections to the people in power or personal
								relationship to a lawyer. With 247Sue, You can collect and share non-doctor-able
								evidences, create cases, have access to thousand of lawyers, get updates on cases and
								get compensation for won cases. You also get your selected amount on shared evidences
								paid into your wallet. All these from the 247Sue App on your mobile device.</p>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="ftco-section ftco-no-pt ftco-no-pb ">
		<div class="container">
			<div class=" text-center heading-section ftco-animate fadeInUp ftco-animated">

				<h2 class="mb-4">How It Works</h2>
			</div>
			<div class="row d-flex justify-content-center">
				<?php if($how_it_work){ foreach($how_it_work as $kay=>$value){ ?>
				<div class="col-md-12 col-lg-6 col-12  text-center ">
					<div class="practice-area ftco-animate fadeInUp ftco-animated">
						<div class="icon d-flex justify-content-center align-items-center">
							<span class="<?= $value['icon'] ?>"></span>
						</div>
						<h3><a href="practice-single.html"><?= $value['title'] ?></a></h3>
						<p>
						<?= $value['description'] ?></p>
						<a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span
								class="ion-ios-arrow-round-forward"></span></a>
					</div>
				</div>
				
				<?Php } } ?>




			</div>
		</div>
	</section>
	<section class="btn-bg ftco-section how-it-wrok-v " style="background-image: url('<?php echo base_url() ?>/assets/images/btn-bg.png');">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-lg-6 col-6">
					<div class="btn-text">
						<h1 class="mb-0"> How It Works <span><i class="fa-solid fa-angles-right"></i></span></h1>

					</div>
				</div>
				<div class=" col-lg-6 col-6 text-center " style="position: relative;z-index: 1;">
					<div class=" ftco-animate fadeInUp ftco-animated text-center d-flex justify-content-center">
						<a href="<?php echo get_settings('how_it_work_link'); ?>"
							class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
							<span class="icon-play"></span>
						</a>

					</div>
				</div>
			</div>
		</div>

	</section>




	<section class="ftco-section testimony-section">
		<div class="container">
			<div class="row justify-content-center ">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Testimonial</span>
					
					<h2 class="mb-4">Happy Clients</h2>
				</div>
			</div>


			<div class="row ftco-animate">
				<div class="col-md-12">
					<div class="carousel-testimony owl-carousel ftco-owl">
						<?php if($testomonial) { foreach($testomonial as $key=>$value) { //echo "<pre>";  print_r($value); die;?>
						<div class="item">
							<div class="testimony-wrap py-4">
								<div class="text">
									<p class="mb-4"><?= $value['description'] ?></p>
									<div class="d-flex align-items-center">
										<div class="user-img" style="background-image: url('<?php echo base_url('upload/'.$value['profile']) ?>')"></div>
										<div class="pl-3">
											<p class="name"><?= $value['name'] ?></p>
											<span class="position"><?= $value['designation'] ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } } ?>
						
					</div>
				</div>
			</div>
		</div>
	</section>
