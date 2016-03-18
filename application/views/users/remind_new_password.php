<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Slaptažodžio atstatymas</h3>
        </div>
        <div class="panel-body">
            <?php echo validation_errors(); ?>
            <?php echo form_open('users/recover_password'); ?>
                <input type="password" name="password" class="form-control inputSpacing" placeholder="Naujas slaptažodis" required />
                <input type="password" name="passconf" class="form-control inputSpacing" placeholder="Naujo slaptažodžio pakartojimas" required />
                <input type="hidden" name="user_id" value="<?=$recover_user_id;?>" />
                <input type="submit" class="btn btn-primary" value="Pakeisti" />
            </form>
        </div>
    </div>
    <hr class="contentContainerHr">
</div>
