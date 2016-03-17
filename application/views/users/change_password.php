<div class="contentContainer">
    <div class="contentContainerTitle">
        Slaptažodžio keitimas
    </div>
    <div class="contentContainerContent">
        <br />
       <?php echo validation_errors(); ?>
        <?php echo form_open('users/change_password'); ?>
        <input type="password" name="oldpassword" class="form-control inputSpacing" placeholder="Dabartinis slaptažodis" required />
        <input type="password" name="password" class="form-control inputSpacing" placeholder="Naujas slaptažodis" required />
        <input type="password" name="passconf" class="form-control inputSpacing" placeholder="Naujo slaptažodžio pakartojimas" required />
        <div><input type="submit" class="btn btn-primary" value="Pakeisti" /></div>

        </form>
    </div>
</div>
<hr class="contentContainerHr">

