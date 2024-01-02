<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $title; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">
        <?= $breadcrumb_title; ?>
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
            <!-- <a href="<?php //echo base_url('admin/faq/add') ?>" class="btn btn-info" style="float: right;"><i class="fa fa-plus"></i> Add<a> </div> -->
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
                </tr>
              </thead>
              <tbody>
                <?php if($rows){
                    foreach ($rows as $key => $value) {  ?>
                <tr>
                <?php //echo "<pre>"; print_r($rows); die; ?>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['email']; ?></td>
                  <td><?php echo $value['subject']; ?></td>
                  <td><?php echo $value['message']; ?></td>
                  
                </tr>
                <?php } } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
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
<div id="memberViewModel"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).on('click', '.handleMemberView', function() {
   event.preventDefault();
   var URL = $(this).data('url');
   var id = $(this).data('id');
   $.ajax({
      url: URL,
      method: "POST",
      data:{id:id},
      dataType: "json",
       success: function(output) {
        
        $('#memberViewModel').html(output);
        $('#memberModal').modal('show'); 
        
      }
   });
});

          
</script>
