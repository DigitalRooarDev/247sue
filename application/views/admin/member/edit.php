 



            <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $breadcrumb_title; ?>
     
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('admin/user') ?>">Users Manager</a></li>
        <li class="active">Edit User</li>
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
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title "><?= $section_title; ?></h3>
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url('admin/member/update/'.$row['id']) ?>" class="" enctype="multipart/form-data" method="post" >
              <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">First Name</label>
                           <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $row['first_name'] ?>">
                                             <label class="text-danger"><?php echo form_error('first_name'); ?></label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $row['last_name'] ?>">
                        <label class="text-danger"><?php echo form_error('last_name'); ?></label>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mobile</label>
                          <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo $row['mobile'] ?>">
                          <label class="text-danger"><?php echo form_error('mobile'); ?></label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email" readonly="" value="<?php echo $row['email'] ?>">
                        <label class="text-danger"><?php echo form_error('email'); ?></label>
                        </div>
                    </div>
                </div>



                 <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" value="">
                          <label class="text-danger"><?php echo form_error('password'); ?></label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="">
                        <label class="text-danger"><?php echo form_error('confirm_password'); ?></label>
                        </div>
                    </div>
                </div>




                 <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Address</label>
                         
                         <textarea class="form-control" name="address" placeholder="Address"><?php echo $row['address'] ?></textarea>
                        </div>
                    </div>
                   
                </div>


                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Upload  certificate </label>
                          <?php  if(!empty($row['certificate'])){ ?>
                             <br> You can see by downloading the  <a href="<?php echo base_url('upload/'.$row['certificate']) ?>" download>document</a>
                         <?php }?>
                          <input type="file" name="certificate" class="form-control">
                          
                          <div class="text-danger"> <?php if ($this->session->flashdata('certificate')) { echo $this->session->flashdata('certificate'); }?></div>
                   
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Upload Lawyers association document</label>
                         <?php  if(!empty($row['document'])){ ?>
                          <br>  You can see by downloading the  <a href="<?php echo base_url('upload/'.$row['document']) ?>" download>document</a>
                         <?php }?>
                        <input type="file" name="document" class="form-control"  value="">
                         <div class="text-danger"> <?php if ($this->session->flashdata('document')) { echo $this->session->flashdata('document'); }?></div>
                       
                        </div>
                    </div>
                </div>



                
               
               




              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo base_url('admin/member') ?>" class="btn btn-primary text-right">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->



        </div>
        <!--/.col (left) -->
     
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>