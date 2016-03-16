<div class="contentContainer">
    <div class="contentContainerTitle">
        Slaptažodžio keitimas
    </div>
    <div class="contentContainerContent">
       <?php echo validation_errors(); ?>
<br /><br />
        <?php echo form_open('users/change_password'); ?>
        <input type="password" name="oldpassword" class="form-control" placeholder="Dabartinis slaptažodis" size="50" required />
        <br /><br />
        <input type="password" name="password" class="form-control" placeholder="Naujas slaptažodis" size="50" required />
        <br /><br />
        <input type="password" name="passconf" class="form-control" placeholder="Naujo slaptažodžio pakartojimas" size="50" required />
        <br /><br />
        <div><input type="submit" class="btn btn-primary" value="Pakeisti" /></div>

        </form>
    </div>
</div>
<hr class="contentContainerHr">

