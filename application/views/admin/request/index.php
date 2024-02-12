<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  .evelist
  {
    list-style-type: none;
    padding: 0px;
    margin: 0px;
  }
  .evelist li 
  {
    margin-bottom: 15px;
    background: #f1f1f1;
    padding: 5px 10px;
    display: flex;
    column-gap: 15px;
    align-items: center;
    border-radius: 10px;
  }
  .evelist li span
  {
   width: 70%;
  }

  .evelist li label
  {
   width: 30%;
   text-align: right;
  }

  .evelist li  a
  {
    display: inline-block;
    color: black;
    border-radius: 5px;
    color: white;
    padding: 10px 15px;
    background: black;
  }

  .modal-content
  {
    position: relative;
  }

  .modal-content
  {
    position: relative;
  }
  .modal-content .customclose
  {
    position: absolute;
    right: 0;
    top: 0;
    background: black;
    opacity: 1;
    color: white;
    width: 40px;
    height: 40px;
    line-height: 40px;
    z-index: 1;
  }
   .modal-content .customclose span
   {
    display: block;
    width: 100%;
    height: 100%;
   }
</style>
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

            <?php
            	$totalNoPlans = $this->db->select('*')->from('membership_plan')->get()->result_array();
              	$planData = array();
              	foreach ($totalNoPlans as $key => $totalNoPlan) {
                	if($totalNoPlan['plan_type']){
                  		$planData[$totalNoPlan['plan_type'] ?? 'No Plan'][$totalNoPlan['id']] = $totalNoPlan['name'];
                	}
              	}
            ?>
            
            <div style="float: right;">
              <form action="<?php echo base_url('admin/request/movecourtrequest') ?>" method="post">
                <div class="form-group" style="display: flex;">

					<select class="form-control" name="plan_id" style="margin-right: 10px;">
                      	<option value="">--- Select Membership Plan ---</option>
                      	<?php foreach ($planData as $mainPlanKey => $plans) { ?>
                        <hr>
                        <?php foreach ($plans as $planKey => $plan) { ?>
                          <option value="<?= $planKey ?>" <?= isset($plan_id) && $plan_id == $planKey ? 'selected' : '' ?>><?= $plan ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                        
                    <select class="form-control" name="client_id" style="margin-right: 10px;">
                    	<option value="">--- Select Client Name ---</option>
                      	<?php foreach ($clientList as $getClinet) { ?>
                        <option value="<?= $getClinet['id'] ?>" <?= isset($client_id) && $client_id == $getClinet['id'] ? 'selected' : '' ?>> <?= $getClinet['first_name'].' '.$getClinet['last_name']; ?> </option>
                      	<?php } ?>
                    </select>

                    <select class="form-control" name="laywer_id" style="margin-right: 10px;">
                    	<option value="">--- Select Lawyer Name ---</option>
                      	<?php foreach ($lawyerList as $getLawyer) { ?>
                        <option value="<?= $getLawyer['id'] ?>" <?= isset($laywer_id) && $laywer_id == $getLawyer['id'] ? 'selected' : '' ?>> <?= $getLawyer['first_name'].' '.$getLawyer['last_name']; ?> </option>
                      	<?php } ?>
                    </select>
                    
                    <button type="submit" class="btn btn-success" style="margin-right: 11px;">
                        <i class="fa fa-filter"></i>
                    </button>

                    <a href="<?php echo base_url('admin/request/movecourtrequest') ?>" class="btn btn-primary">
                        <i class="fa fa-refresh"></i>
                    </a>
                </div>
              </form>
            </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Client Name</th>
                  <th>Lawyer Name </th>
                  <th>Case Name </th>
				          <th>Case Fees </th>
                  <th>Created Date </th>
                  <th>Case Progress </th>
                  <th>Status </th>
				          <th>Compensasion Status </th>
                  <th width="40%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($rows){
                    foreach ($rows as $key => $value) { 
                       // print_r($value);

                     ?>
                <tr>
                  <td><?php echo $value['id']; ?>  </td>
                  <td><?php echo $value['client_first_name']; ?> <?php echo $value['client_last_name']; ?> </td>
                  <td><?php echo $value['laywer_first_name']; ?> <?php echo $value['laywer_last_name']; ?> </td>
                  <td><?php echo $value['case_name']; ?> </td>
				          <td><?php echo $value['amount']; ?> </td>
                  <td><?php 

                  echo   $newDate = date('d F, Y', strtotime($value['created_date']));  ?>
                  </td>
                  <td><?php if($value['progress'] == 'Completed')
                    {
                      echo '<small class="label label-success"> Completed</small>';
                      echo '<br><a target="_blank" href="'.base_url("upload/".$value['agreement']).'">Agreement</a>';
                    }elseif($value['progress'] == 'Inprogress')
                    {
                       echo '<small class="label label-info"> Inprogress</small>';
                    }else
                    {
                       echo '<small class="label label-danger">Pending</small>';
                    }





                     ?>
                  </td>
                  <td><?php 

                if($value['status'])
                {;
                  echo '<a href="'.base_url("admin/request/status/".$value['id']."/".$value['status']).'" class="btn  btn-success btn-xs">Active</a>';
                }else
                {
                  echo '<a href="'.base_url("admin/request/status/".$value['id']."/".$value['status']).'" class="btn  btn-danger btn-xs">Inactive</a>';
                }

                 ?>
                  </td>
				  
				   <td><?php if($value['co_status'] == 'Request'){
						 echo '<small class="label label-danger">Pending Accept by Admin</small>';	
					}elseif($value['co_status'] == 'Accept'){
						 echo '<small class="label label-success">Accepted by Admin</small>';
					}else{
						echo '<small class="label label-info">Pending from Lawyer</small>';
					} 
                     ?>
                  </td>
				  
                  <td 
                    style="    display: flex;
                              column-gap: 3px;
                              flex-wrap: nowrap;"     

                  ><?php if($value['request_status'] =='Default') { ?>
                    <a href="<?php echo base_url('admin/request/movecourt/'.$value['id']) ?>" data-toggle="tooltip" title="Move to court case" class="btn btn-info mb-2"><i class="fa  fa-share"></i> </a>
                    <?php } ?>
                    <button type="button" class="btn btn-info  mb-2 assign"  data-toggle="tooltip" title="Assign lawyer" data-id="<?php echo $value['id'] ?>"><i class="fa fa-user-plus"></i> </button>
                    <!--   <button class="btn btn-info paycommission_model" data-toggle="tooltip" title=" Pay Commission"  data-id="<?php echo $value['id'] ?>"><i class="fa  fa-line-chart"></i></button> -->
                    <button class="btn btn-info  mb-2 acceptcommission" data-toggle="tooltip" title="Approve Fees"  data-id="<?php echo $value['id'] ?>"><i class=" fa  fa-money"></i></button>
                    <a href="<?php echo base_url('admin/request/viewinfo/'.$value['id']) ?>" data-toggle="tooltip" title="View Details"  class="btn btn-info  mb-2"><i class="fa  fa-eye"></i> </a>
                    <button type="button" class="btn btn-info  mb-2 evidences" data-toggle="tooltip" title="Evidences Video/Audio" data-id="<?php echo $value['id'] ?>"><i class="fa  fa-camera"></i> </button>


                     <a href="<?php echo base_url('admin/chat/getallchatmember/'.$value['id']) ?>" class="btn btn-info  mb-2" data-toggle="tooltip" title="Discussion"> <i class="fa  fa-comments"></i></a>


                       <button type="button" class="btn btn-info  mb-2 assign__lawyer" data-toggle="tooltip" title="Assigned Lawyer" data-case_id="<?php echo $value['id'] ?>" ><i class="fa  fa-user"> </i></button>



                    <!--  <a href="<?php echo base_url('admin/user/edit/'.$value['id']) ?>" class="btn btn-info"><i class="fa fa-pencil"></i></a>



                    <button type="button" class="btn btn-danger remove" data-id="<?php echo $value['id']; ?>" data-url="<?php echo base_url('admin/user/delete/'.$value['id']) ?>"><i class="fa fa-trash"></i></button> -->
                  </td>
                </tr>
                <?php } } ?>
              </tbody>
              <tfoot>
                <tr>
                 <th>ID</th>
                  <th>Client Name</th>
                  <th>Lawyer Name </th>
                  <th>Case Name </th>
                  <th>Case Fees </th>
                  <th>Created Date </th>
                  <th>Case Progress </th>
                  <th>Status </th>
                  <th>Compensasion Status </th>
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
          <button type="button" class="close customclose" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
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
        <button type="button" class="close customclose" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
        <div class="col-sm-12">
          <h4>Evidences List</h4>
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
        <button type="button" class="close customclose" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
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






<style type="text/css">
  .list__row
  {
    display: flex;
    padding: 10px 5px;
    background: #3c8dbc;
    color: white;
    margin-bottom: 10px;
}
  
  .col__1
  {
      margin-right: 10px;
  }

  .col__0
  {
    padding: 0px 10px;
    border-right: 1px solid white
  }
</style>

<div class="modal fade in" id="assign__lawyer">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           <div id="alerts__msg">
            
           </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Lawyer List</h4>
        </div>
        <div class="modal-body" id="lawyer__list">


         

        </div>
        <div class="modal-footer assign__lawyer__footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="assign__lawyer__id">Assign Lawyer</button>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  
</div>





<script type="text/javascript">
  
    $(document).ready(function(){
          $('#assign__lawyer').modal('hide');
   $("#example1").on('click', '.assign__lawyer', function () {


            var case_id = $(this).data('case_id');

   
           

              $.ajax({
                   url:"<?php echo base_url(); ?>admin/request/getAllLawyerBynearlocationBycaseID",
                   method:"POST",
                   data:{case_id:case_id},
                   dataType: 'json',
                   success:function(data){
                   
                      if(data.result == true)
                      {

                         

                          $('#assign__lawyer').modal('show');
                            $('#alerts__msg .alert').remove();
                          
                            $('#lawyer__list').html(data.data);
                            
                      }else
                      {
                        alert('Somthing Wrong!');
                        //location.reload();
                      }
                   }
                  })

           
            
        });



   $("#assign__lawyer").on('click', '#assign__lawyer__id', function () {

        var id  = $(".lawyer__id__insert").val();
        var case_id  = $(".case__id").val();

        
         

        if(id > '0')
        {


           $.ajax({
                   url:"<?php echo base_url(); ?>admin/request/assign__lawyer",
                   method:"POST",
                   data:{id:id, case_id:case_id},
                   dataType: 'json',
                   success:function(data){
                   
                      if(data.result == true)
                      {

                          $('#alerts__msg .alert').remove();
                         $('#alerts__msg').html(data.data);
                          
                           
                            
                      }
                      else
                      {
                        alert('Somthing Wrong!');
                        //location.reload();
                      }
                   }
                  })



        }else{
          alert('Please select lawyer');
        }

    



    });

     $("#assign__lawyer").on('click', '.lawyer_ids', function () {

      var id = $(this).val();
      $('.lawyer__id__insert').val(id);
    



    });


   
     });

</script>