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
        <!-- <?php if ($this->session->flashdata('error_message')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong><i class="icon fa fa-warning"></i></strong>
                <?php echo $this->session->flashdata('error_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <?php } ?> -->

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <?= $section_title; ?>
                        </h3>
                        <a href="<?php echo base_url('admin/bonus/add') ?>" class="btn btn-info"
                           style="float: right;"><i class="fa fa-plus"></i> Add <a>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Join Member</th>
                                <th>Rewards</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($rows) {
                                foreach ($rows as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?> </td>
                                        <td><?php echo $value['total_join_member']; ?> <strong>OR Above</strong> </td>
                                        <td><?php echo $value['reward']; ?></td>
                                        <td>
                                            <?php if ($value['status']) {
                                                echo '<a href="' . base_url("admin/bonus/status/" . $value['id'] . "/" . $value['status']) . '" class="btn  btn-success btn-xs">Active</a>';
                                            } else {
                                                echo '<a href="' . base_url("admin/bonus/status/" . $value['id'] . "/" . $value['status']) . '" class="btn  btn-danger btn-xs">Inactive</a>';
                                            } ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('admin/bonus/edit/' . $value['id']) ?>"
                                               class="btn btn-info ">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger remove"
                                                    data-id="<?php echo $value['id']; ?>"
                                                    data-url="<?php echo base_url('admin/bonus/delete/' . $value['id']) ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Join Member</th>
                                <th>Rewards</th>
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

<!-- <div id="bonusViewModel"></div> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<!-- <script type="text/javascript">
    $(document).on('click', '.handleBonusView', function () {
        event.preventDefault();
        var URL = $(this).data('url');
        var id = $(this).data('id');
        $.ajax({
            url: URL,
            method: "POST",
            data: {id: id},
            dataType: "json",
            success: function (output) {
                $('#bonusViewModel').html(output);
                $('#bonusModal').modal('show');
            }
        });
    });
</script> -->
