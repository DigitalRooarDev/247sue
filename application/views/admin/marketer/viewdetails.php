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
                                <?php if (!empty($marketerUser['levelWiseMember'])) : ?>
                                    <h3>
                                        <?php echo 'Level : ' . $marketerUser['level'] . ' || Count : ' . $marketerUser['levelWiseMemberCount']; ?>
                                    </h3>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th class="text-center">Mobile</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Plan Name</th>
                                            <th class="text-center">Refer Code</th>
                                            <th class="text-center">Refer By</th>
                                            <th class="text-center">Created Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($marketerUser['levelWiseMember'] as $member) : ?>
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
                                                <td class="text-center"><?php echo $member['mobile']; ?></td>
                                                <td class="text-center"><?php echo $member['wallet']; ?></td>
                                                <td class="text-center"><?php echo $planName; ?></td>
                                                <td class="text-center"><?php echo $member['refer_code']; ?></td>
                                                <td class="text-center"><?php echo $referredByUser; ?></td>
                                                <td class="text-center"><?php echo $member['create_date']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="3" bgcolor="#D8BFD8" class="text-right"><b
                                                        style="font-size: 17px;"> Level Wise Total Amount </b></td>
                                            <td bgcolor="#D8BFD8" class="text-center"><b
                                                        style="font-size: 17px;"><?php echo $marketerUser['levelWiseAmountSum']; ?></b>
                                            </td>
                                            <td colspan="4" bgcolor="#D8BFD8"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Plan Name</th>
                                    <th class="text-center">Refer Code</th>
                                    <th class="text-center">Refer By</th>
                                    <th class="text-center">Created Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>No Member Found</td>
                                </tr>
                                </tbody>
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
