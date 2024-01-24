<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/') ?>dist/img/avatar5.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['Admin']['first_name'] . ' ' . $_SESSION['Admin']['last_name']; ?></p>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <style type="text/css">
                .skin-blue .sidebar-menu > li:hover > a, .skin-blue .sidebar-menu > li.active > a, .skin-blue .sidebar-menu > li.menu-open > a {
                    color: #222d32;
                    background: #ecf0f5;
                }
            </style>

            <li class="header">All Managers</li>
            <li class="<?php if ($this->router->fetch_class() == 'dashboard') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/dashboard') ?>"> <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'user') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/user') ?>"> <i class="fa fa-users"></i>
                    <span>Users Manager</span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'member') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/member') ?>"> <i class="fa fa-user-plus "></i>
                    <span>Member Manager</span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'marketer') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/marketer') ?>"> <i class="fa fa-user-plus "></i>
                    <span>Marketer User</span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'wallethistory' && $this->router->fetch_method() == 'index') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/wallethistory') ?>"> <i class="fa  fa-google-wallet "></i> <span> Fund Request  </span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'plan') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/plan') ?>"> <i class="fa  fa-cc"></i>
                    <span>Membership Plan</span></a>
            </li>

            <li class="treeview <?php if ($this->router->fetch_class() == 'transaction' || $this->router->fetch_class() == 'commission') {
                echo 'active';
            } ?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Payment Manager </span>
                    <span class="pull-right-container">
		            	<span class="label pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
		            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('admin/transaction') ?>"><i class="fa fa-exchange"></i> Transaction
                            Manager </a></li>
                    <li><a href="<?php echo base_url('admin/commission') ?>"><i class="fa  fa-line-chart"></i>
                            Compensation Manager </a></li>
                </ul>
            </li>


            <li class="<?php if ($this->router->fetch_class() == 'request' && $this->router->fetch_method() == 'index') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/request') ?>"> <i class="fa  fa-bell "></i>
                    <span> Request Manager </span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'otherservice' && $this->router->fetch_method() == 'index') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/otherservice') ?>"> <i class="fa fa-wrench "></i> <span> Other Service Request Manager </span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'request' && $this->router->fetch_method() == 'movecourtrequest') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/request/movecourtrequest') ?>"> <i class="fa  fa-share "></i> <span> Court Case Manager </span></a>
            </li>

            <li class="treeview <?php if ($this->router->fetch_class() == 'service') {
                echo 'active';
            } ?>">
                <a href="#">
                    <i class="fa fa-key"></i>
                    <span>Masters Manager </span>
                    <span class="pull-right-container">
	              		<span class="label pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
	            	</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('admin/service') ?>"><i class="fa fa-wrench"></i> Other Service
                            Manager </a></li>
                </ul>
            </li>


            <li class="<?php if ($this->router->fetch_class() == 'email') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/email') ?>"> <i class="fa fa-envelope"></i> <span> Email Template Manager  </span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'Testomonial') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/Testomonial') ?>"> <i class="fa fa-user-circle"
                                                                          aria-hidden="true"></i><span> Testimonial Manager  </span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'faq') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/faq') ?>"> <i class="fa fa-id-card-o" aria-hidden="true"></i> <span> FAQ Manager  </span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'team') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/team') ?>"> <i class="fa fa-pie-chart" aria-hidden="true"></i>
                    <span> Team Manager  </span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'contact') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/contact') ?>"> <i class="fa fa-phone-square" aria-hidden="true"></i>
                    <span> Contact Manager  </span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'howitwork') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/howitwork') ?>"> <i class="fa fa-industry" aria-hidden="true"></i>
                    <span> How It Work Manager  </span></a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'bonus') {
                echo 'active';
            } ?>">
                <a href="<?php echo base_url('admin/bonus') ?>"> <i class="fa fa-building"></i>
                    <span>Bonus Reward</span>
                </a>
            </li>
            <li class="<?php if ($this->router->fetch_class() == 'configlevel') {
                echo 'active';
            } ?>"><a href="<?php echo base_url('admin/configlevel') ?>"> <i class="fa fa-home"></i>
                    <span>Config Level</span>
                </a>
            </li>

            <!-- <li class="<?php if ($this->router->fetch_class() == 'setting') {
                echo 'active';
            } ?>">
	        	<a href="<?php echo base_url('admin/setting') ?>"> <i class="fa fa-fw fa-gears"></i> <span> Global Setting  </span></a>
	        </li> -->


            <li class="treeview <?php if ($this->router->fetch_class() == 'service') {
                echo 'active';
            } ?>">
                <a href="#">
                    <i class="fa fa-fw fa-gears"></i>
                    <span>Setting</span>
                    <span class="pull-right-container">
		              	<span class="label pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
		            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('admin/setting') ?>"><i class="fa fa-wrench"></i>Global Setting</a>
                    </li>
                    <li><a href="<?php echo base_url('admin/websetting') ?>"><i class="fa fa-cog"
                                                                                aria-hidden="true"></i>WebSite
                            Setting</a></li>
                </ul>
            </li>

            <li><a href="<?php echo base_url('admin/login/logout') ?>"> <i class="fa fa-lock"></i>
                    <span>Logout</span></a></li>
        </ul>
    </section>
</aside>