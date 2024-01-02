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

        <?php if ($this->session->flashdata('success_message')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert"><strong><i class="icon fa fa-check"></i>
                </strong><?php echo $this->session->flashdata('success_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
        <?php } ?>

        <?php if ($this->session->flashdata('error_message')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert"><strong><i class="icon fa fa-warning"></i>
                </strong><?php echo $this->session->flashdata('error_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#global_setting" data-toggle="tab" aria-expanded="true"><b>Global
                                    Settings</b></a></li>
                        <li class=""><a href="#level_setting" data-toggle="tab" aria-expanded="false"><b>Level
                                    Settings</b></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="global_setting">
                            <form action="<?php echo base_url('admin/setting/update') ?>" class="form-horizontal"
                                  method="post">
                                <?php
                                $admin_email = $this->db->get_where('settings', array('field_key' => 'admin_email'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Admin Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="admin_email" class="form-control"
                                               placeholder="Admin Email"
                                               value="<?php echo $admin_email['field_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                $payment_email = $this->db->get_where('settings', array('field_key' => 'payment_email'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Payment Eamil</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="payment_email" class="form-control"
                                               placeholder="Payment Email"
                                               value="<?php echo $payment_email['field_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                $account_no = $this->db->get_where('settings', array('field_key' => 'account_no'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Account Number</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="account_no" class="form-control"
                                               placeholder="Account Number"
                                               value="<?php echo $account_no['field_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                $commission = $this->db->get_where('settings', array('field_key' => 'commission'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Commission %</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="commission" class="form-control"
                                               placeholder="Commission"
                                               value="<?php echo $commission['field_value']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Evidence Sharing Commission
                                        %</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="evidence_commission" class="form-control"
                                               placeholder="Evidence Sharing Commission"
                                               value="<?php echo $commission['field_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                $distance = $this->db->get_where('settings', array('field_key' => 'distance'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Distance / Km</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="distance" class="form-control" placeholder="distance"
                                               value="<?php echo $distance['field_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                $minimum_withdrawal_amount = $this->db->get_where('settings', array('field_key' => 'minimum_withdrawal_amount'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Minimum Withdrawal
                                        Amount</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="minimum_withdrawal_amount" class="form-control"
                                               placeholder="Minimum Withdrawal Amount"
                                               value="<?php echo $minimum_withdrawal_amount['field_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                $fee = $this->db->get_where('settings', array('field_key' => 'fee'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Fee</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="fee" class="form-control" placeholder="Fee"
                                               value="<?php echo $fee['field_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                $servicefee = $this->db->get_where('settings', array('field_key' => 'servicefee'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Service Fee</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="servicefee" class="form-control"
                                               placeholder="Service Fee"
                                               value="<?php echo $servicefee['field_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                $applepayfee = $this->db->get_where('settings', array('field_key' => 'applepayfee'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Apple Pay Fee</label>
                                    <div class="col-sm-10">
                                        <input disabled="disabled" type="number" name="applepayfee" class="form-control"
                                               placeholder="Apple pay Fee"
                                               value="<?php echo $applepayfee['field_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                $referralbonus = $this->db->get_where('settings', array('field_key' => 'referralbonus'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Referral Bonus %</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="referralbonus" class="form-control"
                                               placeholder="Referral Bonus"
                                               value="<?php echo $referralbonus['field_value']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button class="btn btn-info" type="submit">Update Settings</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="tab-pane" id="level_setting">
                            <form action="<?php echo base_url('admin/setting/updateLevelAmt') ?>" method="POST"
                                  class="form-horizontal">
                                <?php
                                $level_1 = $this->db->get_where('settings', array('field_key' => 'level_1'))->row_array();
                                $level_2 = $this->db->get_where('settings', array('field_key' => 'level_2'))->row_array();
                                $level_3 = $this->db->get_where('settings', array('field_key' => 'level_3'))->row_array();
                                $level_4 = $this->db->get_where('settings', array('field_key' => 'level_4'))->row_array();
                                $level_5 = $this->db->get_where('settings', array('field_key' => 'level_5'))->row_array();
                                $level_6 = $this->db->get_where('settings', array('field_key' => 'level_6'))->row_array();
                                $level_7 = $this->db->get_where('settings', array('field_key' => 'level_7'))->row_array();
                                $level_8 = $this->db->get_where('settings', array('field_key' => 'level_8'))->row_array();
                                $level_9 = $this->db->get_where('settings', array('field_key' => 'level_9'))->row_array();
                                $level_10 = $this->db->get_where('settings', array('field_key' => 'level_10'))->row_array();
                                ?>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 1</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_1" name="level_1"
                                               placeholder="Level 1"
                                               value="<?php echo $level_1['field_value'] ? $level_1['field_value'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 2</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_2" name="level_2"
                                               placeholder="Level 2"
                                               value="<?php echo $level_2['field_value'] ? $level_2['field_value'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 3</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_3" name="level_3"
                                               placeholder="Level 3"
                                               value="<?php echo $level_3['field_value'] ? $level_3['field_value'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 4</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_4" name="level_4"
                                               placeholder="Level 4"
                                               value="<?php echo $level_4['field_value'] ? $level_4['field_value'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 5</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_5" name="level_5"
                                               placeholder="Level 5"
                                               value="<?php echo $level_5['field_value'] ? $level_5['field_value'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 6</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_6" name="level_6"
                                               placeholder="Level 6"
                                               value="<?php echo $level_6['field_value'] ? $level_6['field_value'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 7</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_7" name="level_7"
                                               placeholder="Level 7"
                                               value="<?php echo $level_7['field_value'] ? $level_7['field_value'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 8</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_8" name="level_8"
                                               placeholder="Level 8"
                                               value="<?php echo $level_8['field_value'] ? $level_8['field_value'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 9</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_9" name="level_9"
                                               placeholder="Level 9"
                                               value="<?php echo $level_9['field_value'] ? $level_9['field_value'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Level 10</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control onlyDecimal" id="level_10"
                                               name="level_10"
                                               placeholder="Level 10"
                                               value="<?php echo $level_10['field_value'] ? $level_10['field_value'] : ''; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-info">Update Level</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('.onlyDecimal').keyup(function () {
            if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
                this.value = this.value.replace(/[^0-9\.]/g, '');
            }
        });
    });
</script>