<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $breadcrumb_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?= $breadcrumb_menu; ?></li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('success_message')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong><i class="icon fa fa-check"></i> </strong>
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
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div style="display: flex;justify-content: space-between;align-items: center;">
                            <h3 class="box-title"><?= $section_title; ?></h3>
                            <div style="display: flex;">
                                <form action="<?php echo base_url('admin/marketer/index') ?>" method="post">
                                    <div class="form-group" style="display: flex;margin-bottom: 0;margin-right: 30px;">
                                        <?php
                                        $totalNoPlans = $this->db->select('*')->from('membership_plan')->get()->result_array();
                                        $planData = array();
                                        foreach ($totalNoPlans as $key => $totalNoPlan) {
                                            if ($totalNoPlan['plan_type']) {
                                                $planData[$totalNoPlan['plan_type'] ?? 'NoPlan'][$totalNoPlan['id']] = $totalNoPlan['name'];
                                            } else {
                                                $planData['NoPlan'][$totalNoPlan['id']] = $totalNoPlan['name'];
                                            }
                                        }
                                        ?>
                                        <select class="form-control" name="plan_id" id="plan_id"
                                                style="min-width: 260px;margin-right: 10px;">
                                            <option value="">--- Select Membership Plan ---</option>
                                            <?php foreach ($planData as $mainPlanKey => $plan) { ?>
                                                <option value="<?= $mainPlanKey ?>" <?= isset($plan_id) && $plan_id == $mainPlanKey ? 'selected' : '' ?>>
                                                    <?= $mainPlanKey == 'NoPlan' ? 'No Plan' : $mainPlanKey ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                        <select class="form-control" name="plan_period" id="plan_period"
                                                style="min-width: 260px;margin-right: 10px;">
                                            <option value="">--- Select Membership Plan Period ---</option>
                                        </select>

                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                    </div>
                                </form>
                                <!--<a href="<?php /*echo base_url('admin/marketer/add') */ ?>" class="btn btn-info">
                                    <i class="fa fa-plus"></i> Add
                                </a>-->
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Refer Code</th>
                                <th>Referred Name</th>
                                <th>Membership Plan</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($rows) {
                                foreach ($rows as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['first_name'] . ' ' . $value['last_name']; ?> </td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['mobile']; ?></td>
                                        <td><?php echo $value['refer_code']; ?></td>
                                        <td><?php echo $value['firstName'] . ' ' . $value['lastName']; ?> </td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['wallet']; ?></td>
                                        <td>
                                            <?php
                                            if ($value['status']) {
                                                echo '<a href="' . base_url("admin/marketer/status/" . $value['id'] . "/" . $value['status']) . '" class="btn  btn-success btn-xs">Active</a>';
                                            } else {
                                                echo '<a href="' . base_url("admin/marketer/status/" . $value['id'] . "/" . $value['status']) . '" class="btn  btn-danger btn-xs">Inactive</a>';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <!--<button type="button" data-id="<?php /*echo $value['id']; */ ?>"
                                                    data-url="<?php /*echo base_url('admin/marketer/view/' . $value['id']) */ ?>"
                                                    class="btn btn-info handleMemberView">
                                                <i class="fa fa-eye"></i>
                                            </button>-->

                                            <a href="<?php echo base_url('admin/marketer/viewdetails/' . $value['id']) ?>"
                                               class="btn btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="<?php echo base_url('admin/marketer/edit/' . $value['id']) ?>"
                                               class="btn btn-info">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <!--<button type="button" class="btn btn-danger remove"
                                                    data-id="<?php /*echo $value['id']; */?>"
                                                    data-url="<?php /*echo base_url('admin/marketer/delete/' . $value['id']) */?>">
                                                <i class="fa fa-trash"></i>
                                            </button>-->
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Refer Code</th>
                                <th>Referred Name</th>
                                <th>Membership Plan</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="memberViewModel"></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

    $(document).on('click', '.handleMemberView', function () {
        event.preventDefault();
        var URL = $(this).data('url');
        var id = $(this).data('id');
        $.ajax({
            url: URL,
            method: "POST",
            data: {id: id},
            dataType: "json",
            success: function (output) {
                $('#memberViewModel').html(output);
                $('#memberModal').modal('show');
            }
        });
    });


    /*$(document).on('change','#plan_id' ,function(){
      var val = $('#plan_id option:selected').val();
      if(val == 1){
        $('#plan_period').hide();
      } else {
        $('#plan_period').show();
      }
    });*/

    var plans = <?php echo json_encode($planData); ?>;
    var plan_id = "<?php echo $plan_id; ?>";
    var plan_period = "<?php echo $plan_period; ?>";

    $(function () {
        planSelected(plans, plan_id, plan_period);
    });

    $(document).on('change', "#plan_id", function () {
        var plan_id = $(this).val();
        planSelected(plans, plan_id, plan_period);
    });

    function planSelected(plans, plan_id, plan_period) {
        $('#plan_period').empty();
        if (plan_id && plan_id !== 'NoPlan') {
            $('#plan_period').css('display', '');
            $('#plan_period').append(`<option value="">--- Select Membership Plan Period ---</option>`);
            jQuery.each(plans[plan_id], function (index, item) {
                $('#plan_period').append(`<option value='${index}'>${item}</option>`);
            });
        } else if (plan_id && plan_id === 'NoPlan') {
            $('#plan_period').css('display', 'none');
        } else {
            $('#plan_period').css('display', '');
            $('#plan_period').append(`<option value="">--- Select Membership Plan Period ---</option>`);
        }

        if (plan_period) {
            $(`#plan_period option[value=${plan_period}]`).attr('selected', 'selected');
        }
    }
</script>