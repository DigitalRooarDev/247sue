 



            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $breadcrumb_title; ?>
     
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('admin/testomonial') ?>">Testomonial Manager</a></li>
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
            <form role="form" action="<?php echo base_url('admin/testomonial/new') ?>" class="" enctype="multipart/form-data" method="post" >
              <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Name</label>
                           <input type="text" name="name" class="form-control" placeholder="Name" >
                            <label class="text-danger"><?php echo form_error('name'); ?></label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Designation</label>
                        <input type="text" name="designation" class="form-control" placeholder="Designation" >
                        <label class="text-danger"><?php echo form_error('designation'); ?></label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Order</label>
                        <input type="number" name="order" value="" class="form-control" placeholder="Order" >
                        <label class="text-danger"><?php //echo form_error('designation'); ?></label>
                        </div>
                    </div>
                </div>




            <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Description</label>
                          
                         <textarea class="form-control" name="description" placeholder="Description"></textarea>
                        </div>
                        <label class="text-danger"><?php echo form_error('description'); ?></label>
                    </div>
                </div>

                


                
                    <div class="col-sm-12">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Upload  Picture</label>
                          
                          <input type="file" name="profile" class="form-control">
                          
                          <div class="text-danger"> <?php if ($this->session->flashdata('profile')) { echo $this->session->flashdata('profile'); }?></div>
                   
                        </div>
                    </div>
            </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo base_url('admin/testomonial') ?>" class="btn btn-primary text-right">Back</a>
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