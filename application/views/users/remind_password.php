<div class="contentContainer">
    <div class="contentContainerTitle">
        Slaptažodžio priminimas
    </div>
    <div class="contentContainerContent">
       <?php echo validation_errors(); ?>
<br /><br />
        <?php echo form_open('users/remind_password'); ?>
        <input type="text" name="username" class="form-control" value="<?=$username;?>" placeholder="Vartotojo vardas" size="50" required />
        <br /><br />
        <input type="email" name="email" class="form-control" value="<?=$email;?>" placeholder="El. Paštas" size="50" required />
        <br /><br />
        <div><input type="submit" class="btn btn-primary" value="Priminti" /></div>

        </form>
    </div>
</div>
<hr class="contentContainerHr">

