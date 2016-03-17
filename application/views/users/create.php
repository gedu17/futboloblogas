<div class="contentContainer">
    <div class="contentContainerTitle">
        Registracija
    </div>
    <div class="contentContainerContent">
       <?php echo validation_errors(); ?>
        <br />
        <?php echo form_open('users/create'); ?>
        <input type="text" name="username" value="<?=$username;?>" class="form-control inputSpacing" placeholder="Vartotojo vardas" required />
        <input type="password" name="password" class="form-control inputSpacing" placeholder="Slaptažodis" required />
        <input type="password" name="passconf" class="form-control inputSpacing" placeholder="Slaptažodžio pakartojimas" required />
        <input type="email" name="email" class="form-control inputSpacing" value="<?=$email;?>" placeholder="El. Paštas" required />
        <div><input type="submit" class="btn btn-primary" value="Registruotis" /></div>

        </form>
    </div>
</div>
<hr class="contentContainerHr">

