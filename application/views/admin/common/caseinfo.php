
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
             

                 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <?php 

              $this->db->select('request.*');
              $this->db->select('c.first_name as client_first_name, c.last_name as client_last_name');
              $this->db->select('l.first_name as laywer_first_name, l.last_name as laywer_last_name,');
              $this->db->where('request.id' , $id);
              $this->db->from('request');
              $this->db->join('users as c', 'c.id = request.client_id', 'left');
              $this->db->join('users as l', 'l.id = request.laywer_id', 'left');
              $this->db->order_by('request.id','desc');
              $query = $this->db->get();

              $row = $query->row_array();


           //  print_r($row); 


              ?>
              <style type="text/css">
                .product-info
                {
                  float: right;
                }
              </style>

                 <div class="row ">
                    <div class="col-sm-6">
                      <div class="box  box-primary">
                        <div class="box-header">
                        <h3 class="box-title"><?= $section_title; ?></h3>
                        </div>

                           <div class="box-body">
                                  <ul class="products-list product-list-in-box">
                                          <li class="item">
                                          <div class="product-img">
                                              <label>Case Name</label>
                                          </div>
                                          <div class="product-info">
                                              <p> <?php echo $row['case_name']; ?> </p>
                                           
                                          </div>
                                           </li>


                                           <li class="item">
                                          <div class="product-img">
                                              <label>Lawyer Name</label>
                                          </div>
                                          <div class="product-info">
                                              <p> <?php echo $row['laywer_first_name']; ?> <?php echo $row['laywer_last_name']; ?></p>
                                          </div>
                                           </li>


                                           <li class="item">
                                          <div class="product-img">
                                              <label>Client Name</label>
                                          </div>
                                          <div class="product-info">
                                               <p> <?php echo $row['client_first_name']; ?> <?php echo $row['client_last_name']; ?></p>
                                          </div>
                                           </li>

                                            <li class="item">
                                          <div class="product-img">
                                              <label>Case Progress</label>
                                          </div>
                                          <div class="product-info">
                                               <p> <?php echo $row['progress']; ?></p>
                                          </div>
                                           </li>

                                  </ul>
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



