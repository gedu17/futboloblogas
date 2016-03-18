<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Registracija</h3>
        </div>
        <div class="panel-body">
            <?php echo validation_errors(); ?>
            <?php echo form_open('users/create'); ?>
                <input type="text" name="username" value="<?=$username;?>" class="form-control inputSpacing" placeholder="Vartotojo vardas" required />
                <input type="password" name="password" class="form-control inputSpacing" placeholder="Slaptažodis" required />
                <input type="password" name="passconf" class="form-control inputSpacing" placeholder="Slaptažodžio pakartojimas" required />
                <input type="email" name="email" class="form-control inputSpacing" value="<?=$email;?>" placeholder="El. Paštas" required />
                <input type="submit" class="btn btn-primary" value="Registruotis" />
            </form>
        </div>
    </div>
    <hr class="contentContainerHr">
</div>