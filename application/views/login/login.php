<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
        <script src="<?= base_url('assets/js/jquery.js'); ?>"></script>
        <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    </head>
    <body>
        <div class="container" style="margin-top:100px">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title"><strong>MCSY Sign in</strong></h3>
                    </div>

                    <div class="panel-body">
                        <form role="form" action="<?= base_url('login/verified'); ?>" method="post">
                            <?php if ($_SESSION) {
                                echo $this->session->flashdata('pesan');
                            } ?>
                            <div style="margin-bottom: 12px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username" required="required">
                            </div>

                            <div style="margin-bottom: 12px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required="required">
                            </div>

                            <button type="submit" class="btn btn-success">Sign in</button>

                            <hr style="margin-top:10px;margin-bottom:10px;" >
                            <div style="float:right">Versi Aplikasi <span class="badge">1.0</span></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>