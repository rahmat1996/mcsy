<!-- Load Datepicker -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugin/datepicker/build/jquery.datetimepicker.min.css'); ?>">
<script src="<?= base_url('assets/plugin/datepicker/build/jquery.datetimepicker.full.min.js'); ?>"></script>
<!-- End Load Datepicker -->
<div class="row">
    <div class="col-md-6">
        <h3><?= $title ?></h3>
        <form action="<?= site_url('holiday/save'); ?>" method="post">
            <input type="hidden" name="is_edit" value="<?= $edit ?>">
            <input type="hidden" name="id" value="<?= ($edit == 1) ? $result[0]->id_holiday : '' ?>">
            <div class="form-group">
                <label class="form-label" for="nm_holiday">Holiday Name : </label>
                <input class="form-control" type="text" name="nm_holiday" required="required" value="<?= ($edit == 1) ? $result[0]->nm_holiday : '' ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="model">Holiday Date : </label>
                <input class="form-control" type="text" id="date" name="date_holiday" required="required" value="<?= ($edit == 1) ? str_replace('-', '/', $result[0]->date_holiday) : date('Y/m/d') ?>">
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
        window.location.replace("<?= site_url('holiday'); ?>");
    });
    $('#date').datetimepicker({
        timepicker: false,
        format: 'Y/m/d',
        mask: true
    });

</script>