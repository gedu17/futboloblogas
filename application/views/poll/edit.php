<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Taisyti apklausą</h3>
        </div>
        <div class="panel-body">
            <?php echo validation_errors(); ?>
            <?=form_open('admin/poll/edit/'.$poll_id);?>
                <label for="name">Klausimas:</label>
                <input type="text" class="form-control inputSpacing" name="name" placeholder="Klausimas" value="<?=$poll_name;?>" required />

                <?php 
                $i = 1;
                foreach($poll_answers as $item) { 
                ?>
                <label for="pollAnswer_<?=$item['id'];?>">Atsakymas <?=$i;?>:</label>
                <input type="text" class="form-control inputSpacing" required id="pollAnswer_<?=$item['id'];?>"
                       name="pollAnswer_<?=$item['id'];?>" value="<?=$item['name'];?>" />
                <?php 
                    $i++;
                } 
                ?>
                <input type="submit" class="btn btn-primary" value="Taisyti" />
            </form>
        </div>
    </div>
    <hr class="contentContainerHr">
</div>