</div>
<?php if($logged_in) { ?>
<?php echo validation_errors(); ?>
    <div id="commentWrite">
        <?php echo form_open('comments/create');//.$id.'/create'); ?>
        <textarea name="comment" placeholder="Jūsų komentaras" rows="4" cols="50" required></textarea><br />
            <input type="hidden" name="post_id" value="<?=$post_id;?>" />
            <input type="hidden" name="user_id" value="<?=$user_id;?>" />
            <input type="hidden" name="return_to" value="<?=$return_to;?>" />
            <input type="submit" name="submit" value="Komentuoti" />
            
        </form>
    </div>
<?php } else {  ?>
    <div id="commentWrite">
        Jūs turite būti prisijungęs, kad galėtumėte parašyti komentarą.
    </div>
<?php } ?>
</div>