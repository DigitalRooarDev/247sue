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

            <li class="<?= $this->router->fetch_class() == 'dashboard' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/dashboard') ?>"> <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'user' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/user') ?>"> <i class="fa fa-users"></i>
                    <span>Users Manager</span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'member' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/member') ?>"> <i class="fa fa-user-plus "></i>
                    <span>Member Manager</span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'marketer' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/marketer') ?>"> <i class="fa fa-user-plus "></i>
                    <span>Marketer User</span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'wallethistory' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/wallethistory') ?>"> <i class="fa  fa-google-wallet "></i>
                    <span> Fund Request  </span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'plan' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/plan') ?>"> <i class="fa  fa-cc"></i>
                    <span>Membership Plan</span></a>
            </li>

            <li class="treeview <?= $this->router->fetch_class() == 'transaction' || $this->router->fetch_class() == 'commission' ? 'active' : ''; ?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Payment Manager </span>
                    <span class="pull-right-container">
		            	<span class="label pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
		            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $this->router->fetch_class() == 'transaction' ? 'active' : '' ?>">
                        <a href="<?php echo base_url('admin/transaction') ?>"><i class="fa fa-exchange"></i> Transaction
                            Manager </a>
                    </li>
                    <li class="<?= $this->router->fetch_class() == 'commission' ? 'active' : '' ?>">
                        <a href="<?php echo base_url('admin/commission') ?>"><i class="fa  fa-line-chart"></i>
                            Compensation Manager </a>
                    </li>
                </ul>
            </li>

            <li class="<?= $this->router->fetch_class() == 'request' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/request') ?>"> <i class="fa  fa-bell "></i>
                    <span> Request Manager </span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'otherservice' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/otherservice') ?>"> <i class="fa fa-wrench "></i>
                    <span> Other Service Request Manager </span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'movecourtrequest' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/request/movecourtrequest') ?>"> <i class="fa  fa-share "></i>
                    <span> Court Case Manager </span></a>
            </li>

            <li class="treeview <?= $this->router->fetch_class() == 'service' ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-key"></i>
                    <span>Masters Manager </span>
                    <span class="pull-right-container">
	              		<span class="label pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
	            	</span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $this->router->fetch_class() == 'service' ? 'active' : '' ?>">
                        <a href="<?php echo base_url('admin/service') ?>"><i class="fa fa-wrench"></i> Other Service
                            Manager </a></li>
                </ul>
            </li>

            <li class="<?= $this->router->fetch_class() == 'email' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/email') ?>"> <i class="fa fa-envelope"></i>
                    <span> Email Template Manager</span>
                </a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'Testomonial' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/Testomonial') ?>">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <span> Testimonial Manager</span>
                </a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'faq' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/faq') ?>"> <i class="fa fa-id-card-o" aria-hidden="true"></i>
                    <span> FAQ Manager</span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'team' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/team') ?>"> <i class="fa fa-pie-chart" aria-hidden="true"></i>
                    <span> Team Manager</span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'contact' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/contact') ?>"> <i class="fa fa-phone-square" aria-hidden="true"></i>
                    <span> Contact Manager</span></a>
            </li>

            <li class="<?= $this->router->fetch_class() == 'howitwork' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/howitwork') ?>"> <i class="fa fa-industry" aria-hidden="true"></i>
                    <span> How It Work Manager</span></a>
            </li>

            <li class="treeview <?= $this->router->fetch_class() == 'bonus' || $this->router->fetch_class() == 'bonusincome' ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-fw fa-gears"></i>
                    <span>Bonus</span>
                    <span class="pull-right-container">
		              	<span class="label pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
		            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $this->router->fetch_class() == 'bonus' ? 'active' : '' ?>">
                        <a href="<?php echo base_url('admin/bonus') ?>"> <i class="fa fa-building"></i>
                            <span>Bonus Reward</span>
                        </a>
                    </li>
                    <li class="<?= $this->router->fetch_class() == 'bonusincome' ? 'active' : '' ?>">
                        <a href="<?php echo base_url('admin/bonusincome') ?>"> <i class="fa fa-building"></i>
                            <span>Bonus Income</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview <?= $this->router->fetch_class() == 'setting' || $this->router->fetch_class() == 'configlevel'
            || $this->router->fetch_class() == 'websetting' ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-fw fa-gears"></i>
                    <span>Setting</span>
                    <span class="pull-right-container">
		              	<span class="label pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
		            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $this->router->fetch_class() == 'setting' ? 'active' : '' ?>">
                        <a href="<?php echo base_url('admin/setting') ?>">
                            <i class="fa fa-wrench"></i>Global Setting
                        </a>
                    </li>
                    <li class="<?= $this->router->fetch_class() == 'configlevel' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/configlevel') ?>">
                            <i class="fa fa-home"></i><span>Config Level</span>
                        </a>
                    </li>
                    <li class="<?= $this->router->fetch_class() == 'websetting' ? 'active' : '' ?>">
                        <a href="<?php echo base_url('admin/websetting') ?>">
                            <i class="fa fa-cog" aria-hidden="true"></i>WebSite Setting</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?php echo base_url('admin/login/logout') ?>">
                    <i class="fa fa-lock"></i><span>Logout</span></a>
            </li>
        </ul>
    </section>
</aside>