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
      <li class="active">Add User</li>
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
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">
              <?= $section_title; ?>
            </h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="<?php echo base_url('admin/plan/save') ?>" class="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="box-body">
            
            <div class="row">

              <div class="col-sm-2">
                <div class="form-group">
                  <label for="exampleInputPassword1">Plan Type</label>
                  <select class="form-control" name="plan_type">
                    <option value="">Select Plan Type</option>
                    <option value="Silver">Silver</option>
                    <option value="Gold">Gold</option>
                    <option value="Platinum">Platinum</option>
                  </select>
                  <label class="text-danger"><?php echo form_error('plan_type'); ?></label>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Plan Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Plan Name" >
                 <label class="text-danger"><?php echo form_error('name'); ?></label>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Yearly Price(Naira)</label>
                  <input type="number" name="price" class="form-control" placeholder="Price" >
                  <label class="text-danger"><?php echo form_error('price'); ?></label>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label for="exampleInputPassword1">No of Cases (Per year)</label>
                  <select class="form-control" name="service[number_of_cases]">
                    <?php for($i=0; $i<=100; $i++){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php }?>
                  <option value="Unlimited">Unlimited</option>
				        </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Instant messaging</label>
                  <select class="form-control" name="service[messaging]">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Record non-doctorable Video and Audio Evidences</label>
                  <select class="form-control" name="service[video_recording]">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Evidence sharing</label>
                  <select class="form-control" name="service[evidence_sharing]">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Representation</label>
                  <select class="form-control" name="service[representation]">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Storage space (in GB)</label>
                  <select class="form-control" name="service[storage_space]">
                    <?php for($i=0; $i<=100; $i++){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php }?>
                    <option value="Unlimited">Unlimited</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Civil Cases against Individuals</label>
                  <select class="form-control" name="service[sue_individuals]">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Sue organizations</label>
                  <select class="form-control" name="service[sue_organizations]">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Record Audio Evidences</label>
                  <select class="form-control" name="service[rec_audio_evidence]">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
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
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
             
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Petitions for Criminal Cases</label>
                  <select class="form-control" name="service[criminal_cases]">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Discount on Legal Representation in Court in(%)</label>
                  <select class="form-control" name="service[court_representation]">
                  <?php for($i=0; $i<=100; $i++){ ?>
                          <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                          <?php }?>
                  </select>
                </div>
              </div>

               <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputPassword1">Compensation in(%)</label>
                  <input type="number" name="compensation" class="form-control" placeholder="Compensation" >
                 <label class="text-danger"><?php echo form_error('Compensation'); ?></label>
                </div>
              </div>

                   <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Lawyer Percentage in(%)</label>
                        <select class="form-control" name="service[lawyer_percentage]">
                          <?php for($i=0; $i<=100; $i++){ ?>
                          <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                          <?php }?>
                </select>
                       
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Civil Cases against corporations</label>
                        <select class="form-control" name="service[corporations_cases]">
                        <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
                       
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Civil Cases against Government Agencies</label>
                        <select class="form-control" name="service[government_agencies_cases]">
                        <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
                       
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Discount on Administrative Bail from security and Anti-Graft Agencies</label>
                        <select class="form-control" name="service[discount_on_bail]">
                          <?php for($i=0; $i<=100; $i++){ ?>
                          <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                          <?php }?>
                </select>
                       
                      </div>
                    </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="<?php echo base_url('admin/plan') ?>" class="btn btn-primary text-right">Back</a> </div>
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
