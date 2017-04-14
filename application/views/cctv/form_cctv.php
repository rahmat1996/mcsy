<div class="row">
    <div class="col-md-6">
        <h3><?= $title ?></h3>
        <form action="<?= site_url('cctv/save'); ?>" method="post">
            <input type="hidden" name="is_edit" value="<?= $edit ?>">
            <input type="hidden" name="id" value="<?= ($edit == 1) ? $result[0]->id_cctv : '' ?>">
            <div class="form-group">
                <label class="form-label" for="ip">IP Address : </label>
                <input class="form-control" type="text" name="ip" required="required" value="<?= ($edit == 1) ? $result[0]->ip : '' ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="model">Model : </label>
                <select class="form-control" name="model">
                    <?php
                    foreach ($data_model as $key => $value) {
                        if ($edit == 1 && $value->id_model == $result[0]->model) {
                            echo "<option value='{$value->id_model}' selected='selected'>" . $value->nm_model . "</option>";
                        } else {
                            echo "<option value='{$value->id_model}'>" . $value->nm_model . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="location">Location : </label>
                <select class="form-control" name="location">
                    <?php
                    foreach ($data_location as $key => $value) {
                        if ($edit == 1 && $value->id_location == $result[0]->location) {
                            echo "<option value='{$value->id_location}' selected='selected'>" . $value->location . "</option>";
                        } else {
                            echo "<option value='{$value->id_location}'>" . $value->location . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="type">Type : </label>
                <select class="form-control" name="type">
                    <?php
                    foreach ($data_type as $key => $value) {
                        if ($edit == 1 && $value->id_type == $result[0]->type) {
                            echo "<option value='{$value->id_type}' selected='selected'>" . $value->nm_type . "</option>";
                        } else {
                            echo "<option value='{$value->id_type}'>" . $value->nm_type . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="recorder">Recorder : </label>
                <select class="form-control" name="recorder">
                    <?php
                    foreach ($data_recorder as $key => $value) {
                        if ($edit == 1 && $value->id_recorder == $result[0]->recorder) {
                            echo "<option value={$value->id_recorder} selected='selected'>" . $value->nm_recorder . "</option>";
                        } else {
                            echo "<option value={$value->id_recorder}>" . $value->nm_recorder . "</option>";
                        }
                    }
                    ?>
                </select>
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
        window.location.replace("<?= site_url('cctv'); ?>");
    });
</script>