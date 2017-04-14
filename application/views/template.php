<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
        <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style/style.css') ?>">

        <!-- JAVASCRIPT -->
        <script src="<?= base_url('assets/js/jquery.js') ?>"></script>
        <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div id="top">
                    <?php echo $this->load->view('header', array(), TRUE); ?>
                </div>
                <div id="middle" class="col-md-12"  style="padding-bottom: 50px;">
                    <?php echo $this->load->view($main_view, array(), TRUE); ?>
                </div>
                <div id="bottom">
                    <?php echo $this->load->view('footer', array(), TRUE); ?>
                </div>
            </div>
        </div>
    </body>
</html>