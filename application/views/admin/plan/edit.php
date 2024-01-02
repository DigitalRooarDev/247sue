<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $breadcrumb_title; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('admin/plan') ?>">Plan Manager</a></li>
      <li class="active">Edit User</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php echo validation_errors(); ?>
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
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title ">
              <?= $section_title; ?>
            </h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="<?php echo base_url('admin/plan/update/'.$row['id']) ?>" class="" enctype="multipart/form-data" method="post" >
       <div class="box-body">
            <div class="row">

              <div class="col-sm-2">
                <div class="form-group">
                  <label for="exampleInputPassword1">Plan Type</label>
                  <select class="form-control" name="plan_type">
                    <option value="">Select Plan Type</option>
                    <option value="Silver" <?php if($row['plan_type'] == 'Silver'){ echo 'selected'; } ?>>Silver</option>
                    <option value="Gold" <?php if($row['plan_type'] == 'Gold'){ echo 'selected'; } ?>>Gold</option>
                    <option value="Platinum" <?php if($row['plan_type'] == 'Platinum'){ echo 'selected'; } ?>>Platinum</option>
                  </select>
                  <label class="text-danger"><?php echo form_error('plan_type'); ?></label>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Plan Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Plan Name" value="<?php echo $row['name']; ?>">
                 <!-- <label class="text-danger"><?php echo form_error('name'); ?></label>-->
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Yearly Price(Naira)</label>
                  <input type="number" name="price" class="form-control" placeholder="Price" value="<?php echo $row['price']; ?>">
                  <!--<label class="text-danger"><?php echo form_error('price'); ?></label>-->
                </div>
              </div>
			    <?php $service = unserialize($row['service']); ?>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="exampleInputPassword1">No of Cases (Per year)</label>
                  <select class="form-control" name="service[number_of_cases]">
                    <?php for($i=0; $i<=100; $i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($service['number_of_cases'] == $i){echo 'selected'; } ?>><?php echo $i; ?></option>
                    <?php }?>
                  <option value="Unlimited" <?php if($service['number_of_cases'] == 'Unlimited'){echo 'selected'; } ?>>Unlimited</option>
				  </select>
                 
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Instant messaging</label>
                  <select class="form-control" name="service[messaging]">
                    <option value="No" <?php if($service['messaging'] != 'Yes'){echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if($service['messaging'] == 'Yes'){echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Record non-doctorable Video and Audio Evidences</label>
                  <select class="form-control" name="service[video_recording]">
                    <option value="No" <?php if($service['video_recording'] != 'Yes'){echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if($service['video_recording'] == 'Yes'){echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Evidence sharing</label>
                  <select class="form-control" name="service[evidence_sharing]">
                    <option value="No" <?php if($service['evidence_sharing'] != 'Yes'){echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if($service['evidence_sharing'] == 'Yes'){echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Discount on Legal Representation in Government Agency Meetings in(%)</label>
                  <select class="form-control" name="service[representation]">
                  <?php for($i=0; $i<=100; $i++){ ?>
                            <option value="<?php echo $i; ?>" <?php if(isset($service['representation']) && $service['representation'] == $i){echo 'selected'; }else{ echo '0';} ?>><?php echo $i; ?></option>
                          <?php }?>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Storage space (in GB)</label>
                  <select class="form-control" name="service[storage_space]">
                    <?php for($i=0; $i<=100; $i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($service['storage_space'] == $i){echo 'selected'; } ?>><?php echo $i; ?></option>
                    <?php }?>
                  <option value="Unlimited" <?php if($service['storage_space'] == 'Unlimited'){echo 'selected'; } ?>>Unlimited</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Civil Cases against Individuals</label>
                  <select class="form-control" name="service[sue_individuals]">
                     <option value="No" <?php if($service['sue_individuals'] != 'Yes'){echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if($service['sue_individuals'] == 'Yes'){echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Sue organizations</label>
                  <select class="form-control" name="service[sue_organizations]">
                     <option value="No" <?php if($service['sue_organizations'] != 'Yes'){echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if($service['sue_organizations'] == 'Yes'){echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Record Audio Evidences</label>
                  <select class="form-control" name="service[rec_audio_evidence]">
                     <option value="No" <?php if($service['rec_audio_evidence'] != 'Yes'){echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if($service['rec_audio_evidence'] == 'Yes'){echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div>
              
            </div>
            <div class="row">
              
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Lawyer assignment timing</label>
                  <select class="form-control" name="service[lawyer_assignment_timings]">
                    <?php for($i=1; $i<=30; $i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($service['lawyer_assignment_timings'] == $i){echo 'selected'; } ?>><?php echo $i; ?></option>
                    <?php }?>
                  <option value="Unlimited" <?php if($service['lawyer_assignment_timings'] == 'Unlimited'){echo 'selected'; } ?>>Unlimited</option>
                  </select>
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Petitions for Criminal Cases</label>
                  <select class="form-control" name="service[criminal_cases]">
                    <option value="No" <?php if($service['criminal_cases'] != 'Yes'){echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if($service['criminal_cases'] == 'Yes'){echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Discount on Legal Representation in Court in(%)</label>
                  <select class="form-control" name="service[court_representation]">
                  <?php for($i=0; $i<=100; $i++){ ?>
                            <option value="<?php echo $i; ?>" <?php if(isset($service['court_representation']) && $service['court_representation'] == $i){echo 'selected'; }else{ echo '0';} ?>><?php echo $i; ?></option>
                          <?php }?>
                  </select>
                </div>
              </div>
            </div>
			
			 <div class="row">
			 	<div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Lawyer Percentage in(%)</label>
                  <select class="form-control" name="service[lawyer_percentage]">
                    <?php for($i=0; $i<=100; $i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if(isset($service['lawyer_percentage']) && $service['lawyer_percentage'] == $i){echo 'selected'; }else{ echo '0';} ?>><?php echo $i; ?></option>
                    <?php }?>
				  </select>
                 <input type="hidden" name="compensation" />
                </div>
              </div>
			 </div>

       <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Civil Cases against corporations</label>
                        <select class="form-control" name="service[corporations_cases]">
                        <option value="No" <?php if($service['corporations_cases'] != 'Yes'){echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if($service['corporations_cases'] == 'Yes'){echo 'selected'; } ?>>Yes</option>
                </select>
                       
                      </div>
                    </div>



                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Civil Cases against Government Agencies</label>
                        <select class="form-control" name="service[government_agencies_cases]">
                        <option value="No" <?php if($service['government_agencies_cases'] != 'Yes'){echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if($service['government_agencies_cases'] == 'Yes'){echo 'selected'; } ?>>Yes</option>
                </select>
                       
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Discount on Administrative Bail from security and Anti-Graft Agencies in(%)</label>
                        <select class="form-control" name="service[discount_on_bail]">
                          <?php for($i=0; $i<=100; $i++){ ?>
                            <option value="<?php echo $i; ?>" <?php if(isset($service['discount_on_bail']) && $service['discount_on_bail'] == $i){echo 'selected'; }else{ echo '0';} ?>><?php echo $i; ?></option>
                          <?php }?>
                </select>
                       
                      </div>
                    </div>

            <!-- /.box-body -->
            
			 </div>




     

                

                  




            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Update</button>
              <a href="<?php echo base_url('admin/plan') ?>" class="btn btn-primary text-right">Back</a> </div>
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
