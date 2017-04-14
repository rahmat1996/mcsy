<nav class="navbar navbar-default" style="border-radius: 0px;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= site_url('home'); ?>">MCSY</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class=""><a href="<?= site_url('home'); ?>">Home <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('model'); ?>">Model</a></li>
                        <li><a href="<?= site_url('location'); ?>">Location</a></li>
                        <li><a href="<?= site_url('type'); ?>">Type</a></li>
                        <li><a href="<?= site_url('recorder'); ?>">Recorder</a></li>
                        <li><a href="<?= site_url('holiday'); ?>">Holiday</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?= site_url('cctv'); ?>">CCTV</a></li>
                    </ul>
                </li>
                <li><a href="<?= site_url('monitoring'); ?>">Daily Monitoring</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-text">Hai, <?= $this->session->userdata('name'); ?></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> Config <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('login/change') ?>">Change Password</a></li>
                        <li><a href="<?= site_url('login/logout') ?>"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>