<div class="contentContainer">
    <div class="contentContainerTitle">
        Taisyti įrašą
    </div>
    <div class="contentContainerContent">
        <br />
        <?php echo validation_errors(); ?>
        <?=form_open('admin/posts/edit/'.$form_id);?>
        <br />
        <input type="text" class="form-control" name="title" placeholder="Pavadinimas" value="<?=$form_title;?>" required />
        <br /><br />
        <textarea name="text" class="form-control" cols="70" rows="3" placeholder="Tekstas" required><?=$form_text;?></textarea>
        <br /><br />
        <input type="submit" class="btn btn-primary" value="Taisyti" />
        </form>
    </div>
</div>
<hr class="contentContainerHr">