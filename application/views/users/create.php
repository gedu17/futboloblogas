<div class="contentContainer">
    <div class="contentContainerTitle">
        Registracija
    </div>
    <div class="contentContainerContent">
       <?php echo validation_errors(); ?>
<br /><br />
        <?php echo form_open('users/create'); ?>
        <input type="text" name="username" value="<?=$username;?>" class="form-control" placeholder="Vartotojo vardas" size="50" required />
        <br /><br />
        <input type="password" name="password" class="form-control" placeholder="Slaptažodis" size="50" required />
        <br /><br />
        <input type="password" name="passconf" class="form-control" placeholder="Slaptažodžio pakartojimas" size="50" required />
        <br /><br />
        <input type="email" name="email" class="form-control" value="<?=$email;?>" placeholder="El. Paštas" size="50" required />
        <br /><br />
        <div><input type="submit" class="btn btn-primary" value="Registruotis" /></div>

        </form>
    </div>
</div>
<hr class="contentContainerHr">

