<section class=" inner-banner" style="background-image: url('<?= base_url() ?>/assets/images/gavel-with-books-old-wooden-desk\ 1.png');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate  text-center">
          <h1 class="mb-3 bread">How It Works</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="<?= base_url('home'); ?>">Home <i
                  class="ion-ios-arrow-forward"></i></a></span> <span>How It Works </span></p>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ">
		<div class="container">
		  <div class=" text-center heading-section ftco-animate fadeInUp ftco-animated">
	
			<h2 class="mb-4">How It Works</h2>
		  </div>
		  <div class="row d-flex justify-content-center">
            <?php if($rows) { foreach($rows as $key=>$value){  ?>
			<div class="col-md-12 col-lg-6 col-12  text-center ">
			  <div class="practice-area ftco-animate fadeInUp ftco-animated">
				<div class="icon d-flex justify-content-center align-items-center">
				  <span class="<?php echo $value['icon'] ?>"></span>
				</div>
				<h3><a href="practice-single.html"><?php echo $value['title'] ?></a></h3>
				<p>
                <?php echo $value['description'] ?></p>
				<a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span
					class="ion-ios-arrow-round-forward"></span></a>
			  </div>
			</div>

            <?php }  } ?>
		
	
	
		  </div>
		</div>
	  </section>
    <section class="btn-bg ftco-section how-it-wrok-v" style="background-image: url('<?= base_url() ?>/assets/images/btn-bg.png');">
      <div class="container">
        <div class="row d-flex align-items-center">
        <div class="col-lg-6 col-6">
          <div class="btn-text">
          <h1 class="mb-0"> How It
			Works <span><i class="fa-solid fa-angles-right"></i></span></h1>
    
          </div>
        </div>
        <div class=" col-lg-6 col-6 text-center " style="position: relative;z-index: 1;">
          <div class=" ftco-animate fadeInUp ftco-animated text-center d-flex justify-content-center">
          <a href="https://vimeo.com/45830194"
            class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
            <span class="icon-play"></span>
          </a>
    
          </div>
        </div>
        </div>
      </div>
    
      </section>