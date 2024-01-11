<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $breadcrumb_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('admin/bonus') ?>">Bonus Rewards</a></li>
            <li class="active">Add Bonus Rewards</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('success_message')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong><i class="icon fa fa-check"></i></strong>
                <?php echo $this->session->flashdata('success_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('error_message')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong><i class="icon fa fa-warning"></i></strong>
                <?php echo $this->session->flashdata('error_message'); ?>
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
                    <form role="form" id="frmBonus" action="<?php echo base_url('admin/bonus/save') ?>" class=""
                          enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="totalJoinMember">Total Join Member </label>
                                        <input type="text" name="total_join_member" id="total_join_member"
                                               class="form-control" placeholder="Join Member">
                                        <label class="text-danger">
                                            <?php echo form_error('total_join_member'); ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reward">Rewards</label>
                                        <input type="text" name="reward" id="reward" class="form-control"
                                               placeholder="Rewards">
                                        <label class="text-danger">
                                            <?php echo form_error('reward'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!--<script type="text/javascript">
    $("#frmBonus").validate({
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
                required: "Please Enter Member"
            },
            "reward": {
                required: "Please Enter Reward",
            }
        }
    });
</script>-->

<?php
function form_value($field_name)
{
    return isset($_SESSION['form_data'][$field_name]) ? $_SESSION['form_data'][$field_name] : '';
}

// Clear form data from session after displaying the form
unset($_SESSION['form_data']);
?>
