<div class="row">
    <div class="col-md-6">
        <h3><?= $title ?></h3>
        <form action="<?= site_url('login/save'); ?>" method="post">
            <div class="form-group">
                <label for="new_pass" class="form-label">New Password (required)</label>
                <input type="password" class="form-control" name="new_pass" id="new_pass" required="required">
            </div>
            <div class="form-group">
                <label for="retype_pass" class="form-label">Re-Type Password (required)</label>
                <input type="password" class="form-control" name="retype_pass" id="retype_pass" required="required">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" onclick="return validate()" id="submit"><span class="glyphicon glyphicon-ok-sign"></span> Commit</button>
                <button class="btn btn-danger" type="button" id="cancel"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#cancel').click(function () {
        window.location.replace("<?= site_url('home'); ?>");
    });

    function validate() {
        var pass = $('#new_pass').val();
        var repass = $('#retype_pass').val();
        if (pass != repass) {
            alert('Password does not match');
            $('#retype_pass').focus();
            return false;
        } else {
            return true;
        }
    }
</script>