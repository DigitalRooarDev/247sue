



<section class=" inner-banner" style="background-image: url('<?php echo base_url(); ?>/assets/images/gavel-with-books-old-wooden-desk\ 1.png');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate  text-center">
          <h1 class="mb-3 bread">Contact Us</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo base_url('home') ?>">Home <i
                  class="ion-ios-arrow-forward"></i></a></span> <span>Contact </span></p>
        </div>
      </div>
    </div>


    
  </section>


  <section class="ftco-section contact-section">
    <div class="container">
      <div class="row d-flex mb-5 contact-info">
        <div class="col-md-12 mb-4">
          <h2 class="h3">Contact Information</h2>
        </div>
        <div class="w-100"></div>
        <div class="col-md-4">
          <p><span>Address:</span> <?php echo get_settings('footer_address') ?></p>
        </div>
        <div class="col-md-4">
          <p><span>Phone:</span> <a href="tel://1234567920"><?php echo get_settings('footer_contact') ?></a></p>
        </div>
        <div class="col-md-4">
          <p><span>Email:</span> <a href="mailto:info@yoursite.com">
          <?php echo get_settings('footer_email') ?></a></p>
        </div>
       
      </div>
      <div class="row block-9 no-gutters">
        <div class="col-lg-6 order-md-last d-flex">
          <form action="<?php echo base_url('contact/save') ?>" method="POST" class="bg-light p-5 contact-form">
          <?php if ($this->session->flashdata('success_message')) {?>
            <div class="alert alert-success alert-dismissible" role="alert"> <strong><i class="icon fa fa-check"></i> </strong><?php echo $this->session->flashdata('success_message');?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <?php }?>
            <?php if ($this->session->flashdata('error_message')) {?>
            <div class="alert alert-danger alert-dismissible" role="alert"> <strong><i class="icon fa fa-warning"></i> </strong><?php echo $this->session->flashdata('error_message');?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <?php }?>
          
          <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Your Name">
              <label class="text-danger"><?php echo form_error('name'); ?></label>
            </div>
            <div class="form-group">
              <input type="text" name="email" class="form-control" placeholder="Your Email">
              <label class="text-danger"><?php echo form_error('email'); ?></label>
            </div>
            <div class="form-group">
              <input type="text" name="subject" class="form-control" placeholder="Subject">
              <label class="text-danger"><?php echo form_error('subject'); ?></label>
            </div>
            <div class="form-group">
              <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              <label class="text-danger"><?php echo form_error('message'); ?></label>
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
            </div>
          </form>

        </div>

        <div class="col-lg-6 d-flex">
       
        <?php echo get_settings('map') ?>
        
        </div>
      </div>
    </div>
  </section>
