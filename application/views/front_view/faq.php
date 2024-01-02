<section class=" inner-banner" style="background-image: url('<?php echo base_url(); ?>/assets/images/gavel-with-books-old-wooden-desk\ 1.png');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate  text-center">
          <h1 class="mb-3 bread">FAQ</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="<?= base_url('home'); ?>">Home <i
                  class="ion-ios-arrow-forward"></i></a></span> <span>FAQ </span></p>
        </div>
      </div>
    </div>
  </section>

  <section class="section accordian ftco-section">

    <div class="container animate__  wow animate__fadeInUp animated"
      style="visibility: visible; animation-name: fadeInUp;">
      <div class=" text-center heading-section ftco-animate fadeInUp ftco-animated">

        <h2 class="mb-4">Frequently asked questions</h2>
      </div>
      <div class="faq-box">
        <div class="faq-box-contnent">
          <div class="accordion stop-accordian" id="accordionExample">

          <?php if($rows) { foreach($rows as $key=>$value) { ?>
            <div class="card">
              <div class="card-header card-header-2 collapsed" data-toggle="collapse" data-target="#test<?= $value['id'] ?>"
                aria-expanded="false">

                <div class="faq-acc-header">
                  <h6 class="title"><?= $value['title'] ?></h6>
                  <span class="accicon"><i class="fas rotate-icon fa-plus"></i></span>
                </div>
              </div>
              <div id="test<?= $value['id'] ?>" class="collapse" data-parent="#accordionExample">
                <div class="card-body"><?= $value['description'] ?>
                </div>
              </div>
            </div>
            <?php } } ?>
          </div>

        </div>


      </div>
    </div>
  </section>
