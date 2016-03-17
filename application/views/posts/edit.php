<div class="contentContainer">
    <div class="contentContainerTitle">
        Taisyti įrašą
    </div>
    <div class="contentContainerContent">
        <br />
        <?php echo validation_errors(); ?>
        <?=form_open('admin/posts/edit/'.$form_id);?>
        <input type="text" class="form-control inputSpacing" name="title" placeholder="Pavadinimas" value="<?=$form_title;?>" required />
        <textarea name="text" class="form-control inputSpacing" cols="70" rows="3" placeholder="Tekstas" required><?=$form_text;?></textarea>
        <input type="submit" class="btn btn-primary" value="Taisyti" />
        </form>
    </div>
</div>
<hr class="contentContainerHr">