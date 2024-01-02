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
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Lawyer Name </th>
                  <th>Client Name </th>
                  <th width="20%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($rows){
                  $i=1;  foreach ($rows as $key => $value) { 
                       // print_r($value);

                     ?>
                <tr>
                 
                 <td><?php echo $i; ?></td>
                  <td><?php echo $value['laywer_first_name']; ?> <?php echo $value['laywer_last_name']; ?> </td>
                   <td><?php echo $value['client_first_name']; ?> <?php echo $value['client_last_name']; ?> </td>
                  
                  <td>





                     <a href="<?php echo base_url('admin/chat/getallchats/'.$value['case_id'].'/'.$value['lawyer_id'].'/'.$value['client_id']) ?>" class="btn btn-info">View chat</a>


                   
                </tr>
                <?php $i++; } } ?>
              </tbody>
              <tfoot>
                <tr>
                 <th>S.NO</th>
                  <th>Lawyer Name </th>
                  <th>Client Name </th>
                  <th width="40%">Action</th>
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
<div class="modal fade in" id="evidencesmodel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
        <div class="col-sm-12">
          <h2>Evidences List</h2>
        </div>
      </div>
      <div class="modal-body" id="evidencedata"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade in" id="acceptcommission">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body" id="setamount">
        <input type="hidden" name="" class="acceptcommissionid">
        <div class="statusdefine"> </div>
      </div>
      <div class="modal-footer hiddendata">
        <button type="button" data-st="Accept" class="btn btn-success stbtn pull-left">Accept</button>
        <button class="btn btn-danger stbtn" data-st="Reject" type="submit">Reject</button>
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
          $('#evidencesmodel').modal('hide');
          $('#acceptcommission').modal('hide');



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
                         alert('The commission has been successfully added.');
                         location.reload();
                      }else
                      {
                        alert('Somthing Wrong!');
                        location.reload();
                      }
                   }
                  })

            
            
        });




                $("#example1").on('click', '.evidences', function () {


                  var id = $(this).data('id');
                

                  $.ajax({
                         url:"<?php echo base_url(); ?>admin/request/getevidence",
                         method:"POST",
                         data:{id:id},
                         dataType: 'json',
                         success:function(data){
                         
                           $('#evidencesmodel').modal('show');
                            if(data.result == true || data.result == false)
                            {
                              
                              
                                $('#evidencedata').html(data.data);
                            }else
                            {
                              alert('Somthing Wrong!');
                            }
                         }
                        })

            
            
        });







      
 $("#example1").on('click', '.acceptcommission', function () {

      var id = $(this).data('id');

            $.ajax({
                   url:"<?php echo base_url(); ?>admin/request/commissionstatus",
                   method:"POST",
                   data:{id:id},
                   dataType: 'json',
                   success:function(data){
                   
                      if(data.result == true)
                      {

                        
                       
                        
                        $('#acceptcommission').modal('show');
                           $('.acceptcommissionid').val(id);
                            $('.statusdefine').html(data.data);
                            if(data.status =='Accept' || data.status =='Reject' || data.status == 'Default')
                            {
                             $('.hiddendata').hide()
                            }
                      }else
                      {
                        alert('Somthing Wrong!');
                        location.reload();
                      }
                   }
                  })
  
            

          
          
           
        });





 $("#acceptcommission").on('click', '.stbtn', function () {

      var id = $('.acceptcommissionid').val();
      var st = $(this).data('st');

            $.ajax({
                   url:"<?php echo base_url(); ?>admin/request/commissionstatuschange",
                   method:"POST",
                   data:{id:id,st:st},
                   dataType: 'json',
                   success:function(data){
                   
                      if(data.result == true)
                      {

               
                       
                        
                        $('#acceptcommission').modal('show');
                           $('.acceptcommissionid').val(id);
                            $('.statusdefine').html(data.data);
                            if(data.status =='Accept' || data.status =='Reject' || data.status == 'Default')
                            {
                             $('.hiddendata').hide()
                            }
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
