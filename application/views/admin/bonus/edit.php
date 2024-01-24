<style type="text/css">
.error {color:red;}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= $breadcrumb_title; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('admin/bonus') ?>">Bonus Rewards</a></li>
            <li class="active">Edit Bonus Rewards</li>
        </ol>
    </section>

    <section class="content">
       <!--  <?php if ($this->session->flashdata('success_message')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong><i class="icon fa fa-check"></i></strong>
                <?php echo $this->session->flashdata('success_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <?php } ?> -->

     <!--    <?php if ($this->session->flashdata('error_message')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong><i class="icon fa fa-warning"></i></strong>
                <?php echo $this->session->flashdata('error_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <?php } ?>
 -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $section_title; ?></h3>
                    </div>
                    <form role="form" id="frmBonusedit" action="<?php echo base_url('admin/bonus/update/' . $row['id']) ?>" class=""
                          enctype="multipart/form-data" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="totalJoinMember">Total Join Member</label>
                                        <input type="text" name="total_join_member" class="form-control" placeholder="Join Member" value="<?php echo $row['total_join_member'] ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="rewards">Rewards</label>
                                        <input type="text" name="reward" class="form-control" placeholder="Rewards" value="<?php echo $row['reward'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo base_url('admin/bonus') ?>" class="btn btn-primary text-right">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $("#frmBonusedit").validate({
        rules: {
            total_join_member: {
                required: true,
            },
            reward: {
                required: true,
            }
        },
        messages: {
            "total_join_member": {
                required: "Please Enter total Join Member"
            },
            "reward": {
                required: "Please Enter Reward",
            },
        }
    });
</script> 