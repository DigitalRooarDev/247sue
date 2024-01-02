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
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">
              <?= $section_title; ?>
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url('admin/Websetting/update') ?>" class="form-horizontal" method="post">
              

            <?php //echo '<pre>'; print_r($rows); die; 
           
           //echo "<br>";
           
           ?>
           
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">AppStore Link</label>
                <div class="col-sm-10">
                  <input type="text" name="appstore_link" class="form-control" placeholder="App Store Link" value="<?php echo get_settings('appstore_link'); ?>">
                </div>
              </div>
              <?php //$payment_email = $this->db->get_where('settings', array('field_key' => 'payment_email'))->row_array();?>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">PlayStore Link</label>
                <div class="col-sm-10">
                  <input type="text" name="play_store_link" class="form-control" placeholder="App Store Link" value="<?php echo get_settings('play_store_link');  ?>">
                </div>
              </div>
              <?php //$payment_email = $this->db->get_where('settings', array('field_key' => 'payment_email'))->row_array();?>
              
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button class="btn btn-info" type="submit">Update settings</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>



    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">
              <?= $social_links; ?>
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url('admin/Websetting/update') ?>" class="form-horizontal" method="post">
              <?php 

                      //$admin_email = $this->db->get_where('settings', array('field_key' => 'admin_email'))->row_array();
                    
                  ?>

              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Facebook</label>
                <div class="col-sm-10">
                  <input type="text" name="facebook" class="form-control" placeholder="Facebook" value="<?php echo get_settings('facebook') ?>">
                </div>
              </div>
              <?php //$payment_email = $this->db->get_where('settings', array('field_key' => 'payment_email'))->row_array(); ?>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Instagram</label>
                <div class="col-sm-10">
                  <input type="text" name="instagram" class="form-control" placeholder="Instagram" value="<?php echo get_settings('instagram') ?>">
                </div>
              </div>
              <?php 

                      //$account_no = $this->db->get_where('settings', array('field_key' => 'account_no'))->row_array();
                    
                  ?>
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Twitter</label>
                <div class="col-sm-10">
                  <input type="text" name="twitter" class="form-control" placeholder="Twitter" value="<?php echo get_settings('twitter') ?>">
                </div>
              </div>
              <?php 

                      //$account_no = $this->db->get_where('settings', array('field_key' => 'account_no'))->row_array();
                    
                  ?>
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Youtube</label>
                <div class="col-sm-10">
                  <input type="text" name="youtube" class="form-control" placeholder="Youtube" value=" <?php echo get_settings('youtube') ?>">
                </div>
              </div>
              <?php 

                      //$account_no = $this->db->get_where('settings', array('field_key' => 'account_no'))->row_array();
                    
                  ?>
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">LinkedIn</label>
                <div class="col-sm-10">
                  <input type="text" name="linkedin" class="form-control" placeholder="LinkedIn" value="<?php echo get_settings('linkedin') ?>">
                </div>
              </div>
              <?php 

                      //$account_no = $this->db->get_where('settings', array('field_key' => 'account_no'))->row_array();
                    
                  ?>
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Telegram</label>
                <div class="col-sm-10">
                  <input type="text" name="telegram" class="form-control" placeholder="Telegram" value="<?php echo get_settings('telegram') ?>">
                </div>
              </div>
              <?php 

                      //$account_no = $this->db->get_where('settings', array('field_key' => 'account_no'))->row_array();
                    
                  ?>
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button class="btn btn-info" type="submit">Update settings</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>


    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">
              <?= $footer_setting; ?>
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url('admin/websetting/update') ?>" class="form-horizontal" method="post">
              
          
                   
              

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Footer Description</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="footer_text"  placeholder="Footer Description"><?php echo get_settings('footer_text') ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Footer Copyright</label>
                <div class="col-sm-10">
                  <input type="text" name="footer_copyright" class="form-control" placeholder="Footer Copyright" value="<?php echo get_settings('footer_copyright') ?>">
                </div>
              </div>
              <?php 

                      //$account_no = $this->db->get_where('settings', array('field_key' => 'account_no'))->row_array();
                    
                  ?>

                  
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button class="btn btn-info" type="submit">Update settings</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">
              <?= $footer_setting; ?>
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url('admin/websetting/update') ?>" class="form-horizontal" method="post">
              
          
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Footer Address</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="footer_address"  placeholder="Footer Address"><?php echo get_settings('footer_address') ?></textarea>
                </div>
              </div>     
              

              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Footer E-mail</label>
                <div class="col-sm-10">
                  <input type="text" name="footer_email" class="form-control" placeholder="E-mail" value="<?php echo get_settings('footer_email') ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Footer Contact No.</label>
                <div class="col-sm-10">
                  <input type="text" name="footer_contact" class="form-control" placeholder="Contact No" value="<?php echo get_settings('footer_contact') ?>">
                </div>
              </div>
             

                  
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button class="btn btn-info" type="submit">Update settings</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>



    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">
              <?= $footer_setting; ?>
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url('admin/websetting/update') ?>" class="form-horizontal" method="post">
              
          
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Map/Location</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="map"  placeholder="Location"><?php echo get_settings('map') ?></textarea>
                </div>
              </div>     
              

          
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button class="btn btn-info" type="submit">Update settings</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>



    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">
              <?= "How it Work"; ?>
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url('admin/websetting/update') ?>" class="form-horizontal" method="post">
              
          
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">HOW IT WORK</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="how_it_work_link"  placeholder="HOW IT WORK"><?php echo get_settings('how_it_work_link') ?></textarea>
                </div>
              </div>     
              

          
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button class="btn btn-info" type="submit">Update settings</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
  </section>
  <!-- /.content -->
</div>
