<div class="contentContainer">
    <div class="contentContainerTitle">
        Registracija
    </div>
    <div class="contentContainerContent">
       <?php echo validation_errors(); ?>
<br /><br />
        <?php echo form_open('users/create', 'id="registerForm"'); ?>
        <input type="text" name="username" value="<?=$username;?>" placeholder="Vartotojo vardas" size="50" required />
        <br /><br />
        <input type="password" name="password" placeholder="Slaptažodis" size="50" required />
        <br /><br />
        <input type="password" name="passconf" placeholder="Slaptažodžio pakartojimas" size="50" required />
        <br /><br />
        <input type="email" name="email" value="<?=$email;?>" placeholder="El. Paštas" size="50" required />
        <br /><br />
        <div><input type="submit" value="Registruotis" /></div>

        </form>
    </div>
</div>
<hr class="contentContainerHr">

