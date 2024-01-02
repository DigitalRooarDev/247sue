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
    <?php } 

    $this->session->unset_userdata('success_message');
    $this->session->unset_userdata('error_message');
    ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              <?= $section_title; ?>
            </h3>
            <a href="<?php echo base_url('admin/member/add') ?>" class="btn btn-info" style="float: right;"><i class="fa fa-plus"></i> Add<a> </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>S.NO.</th>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Request  Amount</th>
                  <th>Request  Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($rows){ 
                   $i=1;  foreach ($rows as $key => $value) {  ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $value['user_id']; ?></td>
                  <td><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?> </td>
                  <td><?php echo currency_symbol; ?> <?php echo $value['amount']; ?></td>
                  <td><?php  echo   $newDate = date('d F, Y', strtotime($value['created_date']));  ?></td>
                  <td><?php 

                if($value['status'] == 'Accepted')
                {
                    echo '<small class="label label-success"> Accepted</small>';
                }

                if($value['status'] == 'Pending')
                {
                    echo '<small class="label label-warning"> Pending</small>';
                }

                if($value['status'] == 'Rejected')
                {
                    echo '<small class="label label-danger"> Rejected</small>';
                }

                

                 ?></td>
                  <td>

                    <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $value['status']; ?>
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url('admin/wallethistory/status?id='.$value['id'].'&st=Accepted') ?>">Accepted</a></li>
                      <li><a href="<?php echo base_url('admin/wallethistory/status?id='.$value['id'].'&st=Rejected') ?>"> Rejected</a></li>
                      <li><a href="<?php echo base_url('admin/wallethistory/status?id='.$value['id'].'&st=Pending') ?>">Pending</a></li>
                    </ul>
                  </div>

                    </td>
                </tr>


                <?php $i++;  } } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Wallet Amount</th>
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
