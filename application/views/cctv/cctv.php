<div class="row">
    <div class="col-md-2">
        <form method="post" action="<?= site_url('cctv/add') ?>">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> New Data</button>
        </form>
    </div>
    <div class="col-md-6"><?php
        if ($_SESSION) {
            echo $this->session->flashdata('msg');
        }
        ?></div>
    <div class="col-md-4">
        <form method="get" action="<?= site_url('cctv'); ?>">
            <div class="input-group">
                <input type="text" class="form-control" name="param" value="<?php echo!empty($_GET['param']) ? $_GET['param'] : ''; ?>" placeholder="Search for..." required="required">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
                </span>
            </div><!-- /input-group -->
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<?php if (count($result) == 0) { ?>
            <hr>
            <div class="label label-danger">No Data results!</div>

<?php } else { ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="25px">No</th>
                        <th width="15%">IP Address</th>
                        <th width="20%">Model</th>
                        <th>Location</th>
                        <th width="10%">Type</th>
                        <th width="10%">Recorder</th>
                        <th width="30px">Edit</th>
                        <th width="30px">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key => $value) {
                        echo "<tr>";
                        echo "<td>" . ++$start . "</td>";
                        echo "<td>" . $value->ip . "</td>";
                        echo "<td>" . $value->nm_model . "</td>";
                        echo "<td>" . $value->location . "</td>";
                        echo "<td>" . $value->nm_type . "</td>";
                        echo "<td>" . $value->nm_recorder . "</td>";
                        echo "<td><center><a href='" . site_url("cctv/edit/$value->id_cctv") . "' class='btn btn-primary btn-sm'> <span class='glyphicon glyphicon-edit'></span></a></center></td>";
                        echo "<td><center><a href='" . site_url("cctv/delete/$value->id_cctv") . "' class='btn btn-danger btn-sm' onclick='return konfirm()'> <span class='glyphicon glyphicon-trash'></span></a></center></td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
<?php } ?>
    </div>
</div>
<div class="row">
    <center><?= $pagination ?></center>
        <?php if ($search == 1) { ?>
        <center><a class="btn btn-default" href="<?= base_url('cctv') ?>">Quit Search</a></center>
<?php } ?>
</div>

<script>
    function konfirm() {
        var konfirmasi = confirm('Are you want to delete this?');
        if (konfirmasi) {
            return true;
        } else {
            return false;
        }
    }
</script>
