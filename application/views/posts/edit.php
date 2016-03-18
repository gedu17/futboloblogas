<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Taisyti įrašą</h3>
        </div>
        <div class="panel-body">
            <?php echo validation_errors(); ?>
            <?=form_open('admin/posts/edit/'.$form_id);?>
                <input type="text" class="form-control inputSpacing" name="title" placeholder="Pavadinimas" value="<?=$form_title;?>" required />
                <textarea name="text" class="form-control inputSpacing" cols="70" rows="3" placeholder="Tekstas" required><?=$form_text;?></textarea>
                <input type="submit" class="btn btn-primary" value="Taisyti" />
            </form>
        </div>
    </div>
    <hr class="contentContainerHr">
</div>