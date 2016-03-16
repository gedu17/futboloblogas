<div class="contentContainer">
    <div class="contentContainerTitle">
        Naujas įrašas
    </div>
    <div class="contentContainerContent">
        <br />
        <?php echo validation_errors(); ?>
        <?=form_open('admin/posts/create');?>
        <br />
        <input type="text" name="title" class="form-control" placeholder="Pavadinimas" value="<?=$form_title;?>" required />
        <br /><br />
        <textarea name="text" cols="70" class="form-control" rows="3" placeholder="Tekstas" required><?=$form_text;?></textarea>
        <br /><br />
        <input type="submit" class="btn btn-primary" value="Sukurti" />
        </form>
    </div>
</div>
<hr class="contentContainerHr">