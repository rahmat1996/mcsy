<div class="row">
    <div class="col-md-6">
        <h3><?= $title ?></h3>
        <form action="<?= site_url('location/save'); ?>" method="post">
            <input type="hidden" name="is_edit" value="<?= $is_edit ?>">
            <input type="hidden" name="id" value="<?= ($is_edit == 1) ? $result[0]->id_location : '' ?>">
            <div class="form-group">
                <label class="form-label" for="location">Location : </label>
                <input class="form-control" type="text" name="location" required="required" value="<?= ($is_edit == 1) ? $result[0]->location : '' ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="ket">Keterangan : </label>
                <textarea style="height: 200px;" class="form-control" name="ket"><?= ($is_edit == 1) ? $result[0]->ket : '' ?></textarea>
            </div>
            <div class="form-group">
                <button name="commit" class="btn btn-success" type="submit" id="submit" value="<?= ($is_edit == 1) ? 'edit' : 'add' ?>"><span class="glyphicon glyphicon-ok-sign"></span> Commit</button>
                <button class="btn btn-danger" type="button" id="cancel"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#cancel').click(function () {
        window.location.replace("<?= site_url('location'); ?>");
    });
</script>