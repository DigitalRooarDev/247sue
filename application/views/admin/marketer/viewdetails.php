<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <?= $breadcrumb_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('admin/marketer') ?>">Marketer User</a></li>
            <li class="active">Member User</li>
        </ol>
    </section>

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
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title" style="font-size: x-large;">
                            <?= $section_title; ?>
                        </h2>
                    </div>

                    <div class="box-body" id="">
                        <?php if (!empty($marketerData)) : ?>
                            <?php foreach ($marketerData as $marketerUser) : ?>
                                <?php if (!empty($marketerUser['members'])) : ?>
                                    <h3><?php echo 'Level ' . $marketerUser['level']; ?></h3>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Amount</th>
                                            <th>Plan Name</th>
                                            <th>Refer Code</th>
                                            <th>Refer By</th>
                                            <th>Created Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($marketerUser['members'] as $member) : ?>
                                        <?php
                                            $userReferBy = $this->db->select('*')->from('users')->where('id', $member['refer_by'])->get()->row_array();
                                            $referredByUser = '';
                                            if ($userReferBy) {
                                                $referredByUser = $userReferBy['first_name'] . ' ' . $userReferBy['last_name'];
                                            }

                                            $planName = '';
                                            $membershipPlanData = $this->db->select('*')->from('membership_plan')->where('id', $member['plan_id'])->get()->row_array();
                                            if ($membershipPlanData) {
                                                $planName = $membershipPlanData['name'];
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $member['first_name'] . ' ' . $member['last_name']; ?></td>
                                                <td><?php echo $member['email']; ?></td>
                                                <td><?php echo $member['mobile']; ?></td>
                                                <td><?php echo $member['wallet']; ?></td>
                                                <td><?php echo $planName; ?></td>
                                                <td><?php echo $member['refer_code']; ?></td>
                                                <td><?php echo $referredByUser; ?></td>
                                                <td><?php echo $member['create_date']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Amount</th>
                                            <th>Plan Name</th>
                                            <th>Refer Code</th>
                                            <th>Refer By</th>
                                            <th>Created Date</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Amount</th>
                                    <th>Plan Name</th>
                                    <th>Refer Code</th>
                                    <th>Refer By</th>
                                    <th>Created Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>No Member</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Amount</th>
                                    <th>Plan Name</th>
                                    <th>Refer Code</th>
                                    <th>Refer By</th>
                                    <th>Created Date</th>
                                </tr>
                                </tfoot>
                            </table>
                        <?php endif; ?>
                    </div>

                    <div class="box-footer">
                        <a href="<?php echo base_url('admin/marketer') ?>" class="btn btn-primary text-right">Back</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
