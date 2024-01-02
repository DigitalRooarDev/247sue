<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $breadcrumb_title; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">
        <?= $breadcrumb_menu; ?>
      </li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
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
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <?= $section_title; ?>
            </h3>
            <a href="<?php echo base_url('admin/plan/add'); ?>" class="btn btn-info" style="float: right;"> <i class="fa fa-plus"></i> Add<a> </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($rows){
                    foreach ($rows as $key => $value) {  
					if($value['id']!=DEFAULT_PLAN_ID){
					?>
                <tr>
                  <td><?php echo $value['name']; ?> </td>
                  <td><?php echo currency_symbol; ?> <?php echo $value['price']; ?> Yealy (<?php echo currency_symbol; ?> <?php echo round($value['price']/12,0); ?> per Month)  </td>
                  <td>Active</td>
                  <td><a href="<?php echo base_url('admin/plan/edit/'.$value['id']) ?>" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                    <!--<button type="button" class="btn btn-danger remove" data-id="<?php echo $value['id']; ?>" data-url="<?php echo base_url('admin/plan/delete/'.$value['id']) ?>"><i class="fa fa-trash"></i></button>-->
                  </td>
                </tr>
                <?php 
				}
				} 
				} ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
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
