<section class=" inner-banner"style="background-image: url('<?= base_url() ?>/assets//images/gavel-with-books-old-wooden-desk\ 1.png');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate  text-center">
					<h1 class="mb-3 bread">Our Team</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="<?= base_url('home'); ?>">Home <i
									class="ion-ios-arrow-forward"></i></a></span> <span>Our Team </span></p>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container-fluid px-md-5">
			<div class=" text-center heading-section ftco-animate fadeInUp ftco-animated">

				<h2 class="mb-4">Our Team</h2>
			</div>
			<div class="row">
                <?php if($rows){ foreach($rows as $key=>$value) {  ?>
				<div class="col-lg-4 col-12 col-md-12 col-sm-12">
					<div class="block-2 ftco-animate">
						<div class="flipper">
							<div class="front" style="background-image: url(<?php echo base_url('upload/'.$value['profile']) ?>);">
								<div class="box">
									<h2><?php echo $value['name'] ?></h2>
									<p><?php echo $value['designation'] ?></p>
								</div>
							</div>
							<div class="back">
								<!-- back content -->
								<blockquote>
									<p> <?= $value['description'] ?> 
									</p>
								</blockquote>
								<div class="author d-flex">
									<div class="image align-self-center">
										<img src="<?php echo base_url('upload/'.$value['profile']) ?>" alt="">
									</div>
									<div class="name align-self-center ml-3"><?php echo $value['name'] ?> <span class="position"><?php echo $value['designation'] ?></span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } } ?>
			
			</div>
		</div>
	</section>