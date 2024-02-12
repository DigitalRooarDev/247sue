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
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <?= $section_title; ?>
                        </h3>
                        <a href="<?php echo base_url('admin/member/add') ?>" class="btn btn-info" style="float: right;"><i
                                    class="fa fa-plus"></i> Add<a></div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Refer Code</th>
                                <th>Referred Name</th>
                                <th>Wallet Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($rows) {
                                foreach ($rows as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['first_name'] . ' ' . $value['last_name']; ?> </td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['mobile']; ?></td>
                                        <td><?php echo $value['refer_code']; ?></td>
                                        <td><?php echo $value['firstName'] . ' ' . $value['lastName']; ?> </td>
                                        <td><?php echo currency_symbol; ?><?php echo $value['wallet']; ?></td>
                                        <td><?php

                                            if ($value['status']) {
                                                ;
                                                echo '<a href="' . base_url("admin/member/status/" . $value['id'] . "/" . $value['status']) . '" class="btn  btn-success btn-xs">Active</a>';
                                            } else {
                                                echo '<a href="' . base_url("admin/member/status/" . $value['id'] . "/" . $value['status']) . '" class="btn  btn-danger btn-xs">Inactive</a>';
                                            }

                                            ?></td>
                                        <td>
                                            <button type="button" data-id="<?php echo $value['id']; ?>"
                                                    data-url="<?php echo base_url('admin/member/viewdetails/' . $value['id']) ?>"
                                                    class="btn btn-info handleMemberView"><i class="fa fa-eye"></i>
                                            </button>

                                            <a href="<?php echo base_url('admin/member/edit/' . $value['id']) ?>"
                                               class="btn btn-info "><i class="fa fa-pencil"></i></a>

                                            <button type="button" class="btn btn-danger remove"
                                                    data-id="<?php echo $value['id']; ?>"
                                                    data-url="<?php echo base_url('admin/member/delete/' . $value['id']) ?>">
                                                <i class="fa fa-trash"></i></button>
                                            <a href="<?php echo base_url('admin/transaction/usertransaction/' . $value['id']) ?>"
                                               class="btn btn-info"><i class="fa fa-exchange"></i></a></td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Refer Code</th>
                                <th>Referred Name</th>
                                <th>Wallet Amount</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
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


</script>
