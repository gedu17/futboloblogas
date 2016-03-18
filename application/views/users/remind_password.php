<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Slaptažodžio priminimas</h3>
        </div>
        <div class="panel-body">
            <?php echo validation_errors(); ?>
            <?php echo form_open('users/remind_password'); ?>
                <input type="text" name="username" class="form-control inputSpacing" value="<?=$username;?>" placeholder="Vartotojo vardas" required />
                <input type="email" name="email" class="form-control inputSpacing" value="<?=$email;?>" placeholder="El. Paštas" required />
                <input type="submit" class="btn btn-primary" value="Priminti" />
            </form>
        </div>
    </div>
    <hr class="contentContainerHr">
</div>

