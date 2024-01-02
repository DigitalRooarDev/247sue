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
            <!-- <a href="<?php //echo base_url('admin/user/add') ?>" class="btn btn-info" style="float: right;"><i class="fa fa-plus"></i> Add<a> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
             <table id="example1" class="table table-bordered table-striped" style="display:none">
              <thead>
                <tr>
                  <th>Lawyer Name </th>
                  <th>Case Name </th>
                  <!--  <th>Created Date </th> -->
                  <th>Compensation Amount </th>

                  <th>Admin    </th>
                  <th>Lawyer  </th>
                  <th>Customer  </th>
                  
                  <th>Date </th>
                  <th>Action </th>
                </tr>
              </thead>
              <tbody>
                <?php if($rows){
                    foreach ($rows as $key => $value) { //echo '<pre>'; print_r($value); echo '</pre>';   ?>
                <tr>
                  <td><a href="<?php echo base_url('admin/common/getlawyerInfo/'.$value['laywer_id']) ?>"> <?php echo $value['laywer_first_name']; ?> <?php echo $value['laywer_last_name']; ?> </a> </td>

                  <td><a href="<?php echo base_url('admin/common/caseinfo/'.$value['id']) ?>"> <?php echo $value['case_name']; ?></a> </td>
                  <td>$700</td>
                  <td>
                    <p> <b>50%</b></p>
                    <p> <b>$300</b></p>
                  </td>

                  <td>
                    <p> <b>10%</b></p>
                    <p> <b>$100</b></p>

                  </td>

                   <td>
                    <p><b>50%</b></p>
                    <p><b> $300</b></p>
                  </td>

                  <td><?php 

                    echo $newDate = date('d F, Y', strtotime($value['commission_date']));  ?>
                  </td>
                
                  <td style="display:grid; row-gap: 15px;">
                    <a href="javascript:void(0);" class="btn btn-success disabled mb-3"><i class="fa fa-money"></i> Release Admin Payment</a>
                    <a href="javascript:void(0);" class="btn btn-primary disabled mb-3"><i class="fa fa-money"></i> Release Lawyer Payment</a>
                    <a href="javascript:void(0);" class="btn btn-info disabled mb-3"><i class="fa fa-money"></i> Release Customer Payment</a>
                  </td>
                 
                </tr>
                <?php } } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Lawyer Name </th>
                  <th>Case Name </th>
                  <!--  <th>Created Date </th> -->
                  <th>Compensation amount </th>
                  <th>Date </th>
                  <th>Action </th>
                </tr>
              </tfoot>
            </table>

            <table id="example1" class="table table-bordered table-striped" >
              <thead>
                <tr>
                  <th>Lawyer Name </th>
                  <th>Case Name </th>
                  <!--  <th>Created Date </th> -->
                  <th>Compensation Amount </th>
                  <th>Admin Commision %  </th>
                  <th>Admin Commision Amount</th>
                  <th>Lawyer %</th>
                  <th>Lawyer Amount </th>
                  <th>Client Amount </th>
                  <th>Net Compensation</th>
                  <th>Date </th>
                  <th>Action </th>
                </tr>
              </thead>
              <tbody>
                <?php if($rows){
                    foreach ($rows as $key => $value) { //echo '<pre>'; print_r($value); echo '</pre>';   ?>
                <tr>
                  <td><a href="<?php echo base_url('admin/common/getlawyerInfo/'.$value['laywer_id']) ?>"> <?php echo $value['laywer_first_name']; ?> <?php echo $value['laywer_last_name']; ?> </a> </td>
                  <td><a href="<?php echo base_url('admin/common/caseinfo/'.$value['id']) ?>"> <?php echo $value['case_name']; ?></a> </td>
                  <td><?php echo currency_symbol; ?> <?php echo $value['amount']; ?> </td>
                  <td><?php echo currency_symbol; ?> <?php echo $value['commission_percentage']; ?>% </td>
                  <td><?php echo currency_symbol; ?> <?php echo $value['commission']; ?></td>
                  
                  <td> <?php echo $value['lawyer_percentage']; ?>%</td>
                  <td><?php echo currency_symbol; ?> <?php echo $value['lawyer_amount']; ?></td>
                  <td><?php echo currency_symbol; ?> <?php echo $value['client_compensasion']; ?></td>
                  <td><?php echo currency_symbol; ?> <?php echo $value['amount']-$value['commission']; ?> </td>
                  <td><?php 

                  echo $newDate = date('d F, Y', strtotime($value['commission_date']));  ?>
                  </td>
                  <td><?php if($value['com_payment_status'] == 'Yes'){ ?>
                    <a href="javascript:void(0);" class="btn btn-success disabled"><i class="fa fa-money"></i> Release Payment</a>
                    <?php }else { ?>
                    <a href="<?php echo base_url('admin/commission/paymentstatus/'.$value['id'].'/'.$value['com_payment_status']) ?>" class="btn btn-danger"><i class="fa fa-money"></i> Release Payment</a>
                    <?php }  ?>
                  </td>
                </tr>


                <?php } } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Lawyer Name </th>
                  <th>Case Name </th>
                  <!--  <th>Created Date </th> -->
                  <th>Compensation amount </th>
                  <th>Date </th>
                  <th>Action </th>
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
<div class="modal fade in" id="assign">
  <form action="<?php echo base_url('admin/request/assign') ?>" method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Assign Lawyer</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control assignid" name="id">
          <select class="form-control selectlawyer" name="lawyerid">
            <option value="">Select Lawyer</option>
            <?php

              $this->db->select('*');
              $this->db->where('role','Lawyer');
              $this->db->where('status','1');
              $this->db->from('users');
              $this->db->order_by('first_name','ASC');
              $query = $this->db->get();
              $lists =   $query->result_array(); 

                if($lists){

                  foreach ($lists as $key => $list) { ?>
            <option value="<?php echo $list['id'];  ?>"><?php echo $list['first_name'];  ?> <?php echo $list['last_name'];  ?> | <?php echo $list['email'];  ?> | <?php echo $list['mobile'];  ?></option>
            <?php }} ?>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
<div class="modal fade in" id="paycommission">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
        <h4 class="modal-title lawyername"></h4>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control requestid" name="id">
        <input type="number" class="form-control commission" name="commission" placeholder="Amount">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button class="btn btn-primary paycommission" type="submit">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
          $('#assign').modal('hide');
          $('#paycommission').modal('hide');
          $("#example1").on('click', '.assign', function () {
            $('#assign').modal('show');

            var id = $(this).data('id');
            $('.assignid').val(id);
            
        });


         $("#example1").on('click', '.paycommission_model', function () {
            
          //$('#paycommission').modal('show');
            var id = $(this).data('id');
           // $('.requestid').val(id);

            $.ajax({
                   url:"<?php echo base_url(); ?>admin/request/checkassignClient ",
                   method:"POST",
                   data:{id:id},
                   dataType: 'json',
                   success:function(data){
                   
                     //alert(data.data);
                      if(data.result == true)
                      {
                          $('#paycommission').modal('show');
                          $('.requestid').val(id);
                          $('.lawyername').text('Lawyer : '+data.data);
                      }else
                      {
                        alert('Please assign lawyer first');
                      }
                   }
                  })

            

            
            
        });

        $("#paycommission").on('click', '.paycommission', function () {
            

            var requestid = $('.requestid').val();
            var commission = $('.commission').val();


                  $.ajax({
                   url:"<?php echo base_url(); ?>admin/request/paycommission ",
                   method:"POST",
                   data:{requestid:requestid,commission:commission},
                   dataType: 'json',
                   success:function(data){
                   
                      if(data.result == true)
                      {
                         alert('The Compensation has been successfully added.');
                         location.reload();
                      }else
                      {
                        alert('Somthing Wrong!');
                        location.reload();
                      }
                   }
                  })

            
            
        });







      












});





</script>
