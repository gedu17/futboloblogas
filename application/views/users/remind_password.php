<div class="contentContainer">
    <div class="contentContainerTitle">
        Slaptažodžio priminimas
    </div>
    <div class="contentContainerContent">
        <br />
        <?php echo validation_errors(); ?>
        <?php echo form_open('users/remind_password'); ?>
        <input type="text" name="username" class="form-control inputSpacing" value="<?=$username;?>" placeholder="Vartotojo vardas" required />
        <input type="email" name="email" class="form-control inputSpacing" value="<?=$email;?>" placeholder="El. Paštas" required />
        <div><input type="submit" class="btn btn-primary" value="Priminti" /></div>

        </form>
    </div>
</div>
<hr class="contentContainerHr">

