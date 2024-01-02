<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <?php $totlaClient = $this->db->get_where('users', array('role' => 'Client'))->num_rows(); ?>
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $totlaClient; ?></h3>
                        <p>Total Clients</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="<?php echo base_url('admin/user') ?>" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <?php $totlaMember = $this->db->get_where('users', array('role' => 'lawyer'))->num_rows(); ?>
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $totlaMember; ?></h3>
                        <p>Total Members</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-plus "></i>
                    </div>
                    <a href="<?php echo base_url('admin/member') ?>" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <?php $totlaPlan = $this->db->get('membership_plan')->num_rows(); ?>
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $totlaPlan; ?></h3>
                        <p>Total Plans</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cc "></i>
                    </div>
                    <a href="<?php echo base_url('admin/plan') ?>" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <?php $request = $this->db->get('request')->num_rows(); ?>
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $request; ?></h3>
                        <p>Total Request</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bell "></i>
                    </div>
                    <a href="<?php echo base_url('admin/request') ?>" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Date Filter -->
            <div class="box-body col-lg-12">
                <div style="display: flex;justify-content: flex-end">
                    <form action="<?php echo base_url('admin/dashboard/dateFilter') ?>" method="post">
                        <div class="row">
                            <div class="col-md-4" style="width: 210px;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="create_date" class="form-control" id="reservation"
                                    value="<?= $create_date[0] ?? date('m-d-Y') ?> - <?= $create_date[1] ?? date('m-d-Y') ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-filter"></i>
                                </button>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo base_url('admin/dashboard') ?>" class="btn btn-primary">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>  
            </div>

        </div>

        <!-- plan count start -->
        <div class="row">
            <?php 
                $color = array('green-active', 'blue-active', 'gray-active', 'aqua-active');
                $count = 0;
            ?>
            <?php foreach ($planData as $planKey => $plan) { ?>
                <?php foreach ($plan as $itemKey => $item) { ?>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-<?= $color[$count] ?? "red-active" ?>">
                            <div class="inner">
                                <h3><?= $item ?></h3>
                                <p><?= $itemKey ?></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <a href="<?= base_url('admin/user/index/'.$totalNoPlansIds[$itemKey]) ?>" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            <?php $count++; } ?>
        </div>
        <!-- plan count end -->

        <!-- User List -->
        <div class="row">
            <div class="box-body">
                <h3>Users</h3>
				<table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <!-- <th>Refer Code</th> -->
                        <th>Referred Name</th>
                        <th>Referred Code</th>
                        <th>Created Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($userData) {
                        foreach ($userData as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['first_name'] . ' ' . $value['last_name']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['mobile']; ?></td>
                                <!-- <td><?php echo $value['refer_code']; ?></td> -->
                                <td><?php echo $value['firstName'] . ' ' . $value['lastName']; ?></td>
                                <td><?php echo $value['referCode']; ?></td>
                                <td><?php echo $value['create_date']; ?></td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <!-- <th>Refer Code</th> -->
                        <th>Referred Name</th>
                        <th>Referred Code</th>
                        <th>Created Date</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#reservation').daterangepicker();
    });
</script>