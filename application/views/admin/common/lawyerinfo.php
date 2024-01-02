
             <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?= $breadcrumb_title; ?>
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
     
        <li class="active"><?= $breadcrumb_menu; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('success_message')) {?>
                                            
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                         <strong><i class="icon fa fa-check"></i> </strong><?php echo $this->session->flashdata('success_message');?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                            <?php }?>

                            <?php if ($this->session->flashdata('error_message')) {?>
                                            
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                         <strong><i class="icon fa fa-warning"></i> </strong><?php echo $this->session->flashdata('error_message');?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                            <?php }?>
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box  box-primary">
            <div class="box-header">
              <h3 class="box-title"><?= $section_title; ?></h3>

                 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <?php $row = $this->db->get_where('users', array('id' => $id))->row_array();


             //print_r($row); 


              ?>

                 <div class="row">
                    <div class="col-sm-4">
                      <div class="box  box-primary">
                        <div class="box-header">
                        <h3 class="box-title">Personal Information</h3>
                        </div>

                           <div class="box-body">
                                  <ul class="products-list product-list-in-box">
                                          <li class="item">
                                          <div class="product-img">
                                              <label>Name</label>
                                          </div>
                                          <div class="product-info">
                                              <p><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></p>
                                          </div>
                                           </li>


                                           <li class="item">
                                          <div class="product-img">
                                              <label>Mobile</label>
                                          </div>
                                          <div class="product-info">
                                              <p><?php echo $row['mobile']; ?></p>
                                          </div>
                                           </li>


                                           <li class="item">
                                          <div class="product-img">
                                              <label>Email</label>
                                          </div>
                                          <div class="product-info">
                                              <p><?php echo $row['email']; ?></p>
                                          </div>
                                           </li>

                                  </ul>
                           </div>


                      </div>
                    </div>


                      <div class="col-sm-4">
                      <div class="box  box-primary">
                        <div class="box-header">
                        <h3 class="box-title">Address</h3>
                        </div>

                           <div class="box-body">
                            <b><?php echo $row['address']; ?></b>
                           </div>


                      </div>
                    </div>


                      <div class="col-sm-4">
                      <div class="box  box-primary">
                        <div class="box-header">
                        <h3 class="box-title">Certificate</h3>
                        </div>

                           <div class="box-body">

                            1. <a href="<?php echo base_url('upload/'.$row['llb_certificate']) ?>">Download LLB certificate</a><br>
                            2. <a href="<?php echo base_url('upload/'.$row['call_to_bar_certificate']) ?>">Download Call to bar certificate</a><br>
                            3. <a href="<?php echo base_url('upload/'.$row['supreme_court_number']) ?>">Download Supreme court number</a><br>
                            4. <a href="<?php echo base_url('upload/'.$row['annual_practice_fee']) ?>">Download Annual practice fee</a><br>
                           </div>


                      </div>
                    </div>
                  </div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>



