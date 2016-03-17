<div class="contentContainer">
    <div class="contentContainerTitle">
        Naujas įrašas
    </div>
    <div class="contentContainerContent">
        <br />
        <?php echo validation_errors(); ?>
        <?=form_open('admin/posts/create');?>
        <input type="text" name="title" class="form-control inputSpacing" placeholder="Pavadinimas" required />
        <textarea name="text" cols="70" class="form-control inputSpacing" rows="3" placeholder="Tekstas" required></textarea>
        <input type="submit" class="btn btn-primary" value="Sukurti" />
        </form>
    </div>
</div>
<hr class="contentContainerHr">