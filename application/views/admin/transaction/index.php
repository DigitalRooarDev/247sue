
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
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= $section_title; ?></h3>

               <!-- <a href="<?php //echo base_url('admin/member/add') ?>" class="btn btn-info" style="float: right;"><i class="fa fa-plus"></i> Add<a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Transaction NO</th>
                  <th>User Name</th>
                  <th>Transaction Description</th>
                  <th>Amount</th>
                  <th>Date</th>
                   </tr>
                </thead>
                <tbody>
                <?php if($rows){
                  $i=1;  foreach ($rows as $key => $value) {  ?>
                      
               
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $value['txn_no']; ?></td>
                <td><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></td>
                <td><?php echo $value['txn_desc']; ?></td>
                <td><?php echo currency_symbol; ?>  <?php echo $value['amount']; ?></td>
              
               
                <td> <?php 

                  echo   $newDate = date('d F, Y', strtotime($value['create_at']));  ?></td>
          
       
                
            </tr>

             <?php $i++; } } ?>

                
                </tbody>
                <tfoot>
                <tr>
                 <th>S.NO</th>
                  <th>Transaction NO</th>
                   <th>User Name</th>
                  <th>Amount</th>
                  <th>Date</th>
                </tr>
                </tfoot>
              </table>
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
 