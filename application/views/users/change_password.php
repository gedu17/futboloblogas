<div class="contentContainer">
    <div class="contentContainerTitle">
        Slaptažodžio keitimas
    </div>
    <div class="contentContainerContent">
       <?php echo validation_errors(); ?>
<br /><br />
        <?php echo form_open('users/change_password'); ?>
        <input type="password" name="oldpassword" placeholder="Dabartinis slaptažodis" size="50" required />
        <br /><br />
        <input type="password" name="password" placeholder="Naujas slaptažodis" size="50" required />
        <br /><br />
        <input type="password" name="passconf" placeholder="Naujo slaptažodžio pakartojimas" size="50" required />
        <br /><br />
        <div><input type="submit" value="Pakeisti" /></div>

        </form>
    </div>
</div>
<hr class="contentContainerHr">

