<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $breadcrumb_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('admin/configlevel') ?>">Config Level</a></li>
            <li class="active">Add Config Level</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('success_message')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong><i class="icon fa fa-check"></i>
                </strong><?php echo $this->session->flashdata('success_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <?php } ?> 
         <?php if ($this->session->flashdata('error_message')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong><i class="icon fa fa-warning"></i>
                </strong><?php echo $this->session->flashdata('error_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
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
                    <form role="form" id="frmLevel" action="<?php echo base_url('admin/configlevel/save') ?>" class=""
                          enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" id="level" name="level" value="" class="form-control " value="<?php echo isset($_SESSION['form_data']['level']) ? $_SESSION['form_data']['level'] : ''; ?>" placeholder="Enter Level Number">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label >Reward Percentage</label>
                                    <input type="text" name="reward_per"  id="reward_per" class="form-control" value="<?php echo isset($_SESSION['form_data']['reward_per']) ? $_SESSION['form_data']['reward_per'] : ''; ?>" placeholder="Enter Percentage">
                                    <label class="text-danger"></label>
                                    
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Referral Member</label>
                                    <input type="text" name="referral_member" id="referral_member" class="form-control" value="<?php echo isset($_SESSION['form_data']['referral_member']) ? $_SESSION['form_data']['referral_member'] : ''; ?>" placeholder="Enter Referral Member">
                                       <label class="text-danger"></label>
                                   
                                </div>
                            </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $("#frmLevel").validate({
        rules: {
            level: {
                required: true,
                // remote: {
                //     url: 'register/isUsernameAvailable',
                //     data: {
                //         level: function() {
                //             return $("#level").val();
                //         }
                //     }
                // }
            },
            reward_per: {
                required: true,
            },
            referral_member: {
                required: true,
            }
        },
        messages: {
            "level": {
                required: "Please Enter Level",
                remote: "This level is already taken, please choose a different one."
            },
            "reward_per": {
                required: "Please Enter Reward",
            },
            "referral_member": {
                required: "Please Enter Referral Member",
            }
        }
    });
</script> -->

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $("#frmLevel").validate({
        rules: {
            level: {
                required: true,
            },
            reward_per: {
                required: true,
            },
            referral_member: {
                required: true,
            }
        },
        messages: {
            "level": {
                required: "Please Enter Level"
            },
            "reward_per": {
                required: "Please Enter Reward",
            },
            "referral_member": {
                required: "Please Enter Referral Member",
            }
        }
    });
</script> -->

