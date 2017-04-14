<?php
$data_status = array(
    'H' => 'Hidup',
    'K' => 'Mati/Rusak',
    'M' => 'Mati Total'
);
$date = date('Y/m/d');
?>
<!-- Load Datepicker -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugin/datepicker/build/jquery.datetimepicker.min.css'); ?>">
<script src="<?= base_url('assets/plugin/datepicker/build/jquery.datetimepicker.full.min.js'); ?>"></script>
<!-- End Load Datepicker -->
<div class="row">
    <div class="col-md-6">
        <h3><?= $title ?></h3>
        <form method="post" action="<?= site_url('monitoring/save') ?>">
            <input type="hidden" name="is_edit" value="<?= $edit ?>">
            <input type="hidden" name="id" value="<?= ($edit == 1) ? $result[0]->id_monitoring : '' ?>">
            <div class="form-group">
                <label class="form-label">CCTV :</label>
                <select class="form-control" name="id_cctv">
                    <?php
                    foreach ($data_cctv as $key => $value) {
                        if ($edit == 1 && $result[0]->id_cctv == $value->id_cctv) {
                            echo "<option value='$value->id_cctv' selected='selected'>" . $value->ip . "</option>";
                        } else {
                            echo "<option value='$value->id_cctv'>" . $value->ip . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Date :</label>
                <input type="text" class="form-control" name="date_monitoring" id="date" required="required" value="<?= ($edit == 1) ? str_replace('-', '/', $result[0]->date_monitoring) : $date; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status :</label>
                <select class="form-control" name="status">
                    <?php
                    foreach ($data_status as $key => $value) {
                        if ($edit == 1 && $result[0]->status == $key) {
                            echo "<option value='$key' selected='selected'>" . $value . "</option>";
                        } else {
                            echo "<option value='$key'>" . $value . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Remark :</label>
                <textarea class="form-control" name="remark" style="height: 150px;"><?= ($edit == 1) ? $result[0]->remark : ''; ?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" id="submit"><span class="glyphicon glyphicon-ok-sign"></span> Commit</button>
                <button class="btn btn-danger" type="button" id="cancel"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#cancel').click(function () {
        window.location.replace("<?= site_url('monitoring'); ?>");
    });
    $('#date').datetimepicker({
        timepicker: false,
        format: 'Y/m/d',
        mask: true
    });

</script>