<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $breadcrumb_title; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('admin/configlevel') ?>">Config Level</a></li>
            <li class="active">Edit Config Level</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('success_message')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong><i class="icon fa fa-check"></i>
                </strong><?php echo $this->session->flashdata('success_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('error_message')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong><i class="icon fa fa-warning"></i>
                </strong><?php echo $this->session->flashdata('error_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $section_title; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                          <form role="form" action="<?php echo base_url('admin/configlevel/update/' . $row['id']) ?>" class="" enctype="multipart/form-data" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="level">Level</label>
                                        <input type="text" name="level" class="form-control"
                                               placeholder="Enter Level Number" value="<?php echo $row['level'] ?>">
                                        <label class="text-danger"><?php echo form_error('level'); ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="reward_per">Reward Percentage</label>
                                        <input type="text" name="reward_per" class="form-control" placeholder="Enter Percentage"
                                               value="<?php echo $row['reward_per'] ?>">
                                        <label class="text-danger"><?php echo form_error('reward_per'); ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="referral_member">Referral Member</label>
                                        <input type="text" name="referral_member" class="form-control"
                                               placeholder="Rewards" value="<?php echo $row['referral_member'] ?>">
                                        <label class="text-danger"><?php echo form_error('referral_member'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo base_url('admin/configlevel') ?>" class="btn btn-primary text-right">Back</a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
