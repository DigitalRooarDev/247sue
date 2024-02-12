<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $breadcrumb_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url('admin/dashboard') ?>">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li class="active">
                <?= $breadcrumb_title; ?>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div style="display: flex;justify-content: space-between;align-items: center;">
                            <h3 class="box-title"><?= $section_title; ?></h3>
                            <div style="display: flex;">
                                <form action="<?php echo base_url('admin/bonusincome/index') ?>" method="post">
                                    <div class="form-group" style="display: flex;margin-bottom: 0;margin-right: 30px;">
                                        <?php
                                        $marketers = $this->db->get_where('users', array('role' => 'Marketer'))->result();
                                        ?>
                                        <select class="form-control" name="user_id" id="user_id"
                                                style="min-width: 260px;margin-right: 10px;">
                                            <option value="">--- Select Marketer User ---</option>
                                            <?php foreach ($marketers as $marketer): ?>
                                                <option value="<?php echo $marketer->id; ?>" <?= isset($user_id) && $user_id == $marketer->id ? 'selected' : '' ?>>
                                                    <?php echo $marketer->first_name . ' ' . $marketer->last_name; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="btn btn-success" style="margin-right: 11px;">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                        <a href="<?php echo base_url('admin/bonusincome/index') ?>"
                                           class="btn btn-primary"><i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Member</th>
                                <th>Amount</th>
                                <th>Created Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($bonusIncome) {
                                foreach ($bonusIncome as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['first_name'] . ' ' . $value['last_name']; ?> </td>
                                        <td><?php echo $value['total_member']; ?> </td>
                                        <td><?php echo $value['amount']; ?> </td>
                                        <td><?php echo $value['created_at']; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>UserName</th>
                                <th>Member</th>
                                <th>Amount</th>
                                <th>Created Date</th>
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
