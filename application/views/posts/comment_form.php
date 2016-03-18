</div>
<!--<?php if($logged_in) { ?>
<?php echo validation_errors(); ?>
    <div id="commentWrite">
        <?php echo form_open('comments/create/'.$post_id); ?>
        <textarea name="comment" class="form-control inputSpacing" placeholder="Jūsų komentaras" rows="4" required></textarea><br />
            <input type="submit" name="submit" class="btn btn-primary" value="Komentuoti" />
            
        </form>
    </div>
<?php } else {  ?>
    <div id="commentWrite">
        Jūs turite būti prisijungęs, kad galėtumėte parašyti komentarą.
    </div>
<?php } ?>
</div>-->

<div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Komentaras</h3>
            </div>
            <div class="panel-body">
                <?php if($logged_in) { ?>
                <?php echo validation_errors(); ?>
                    <!--<div id="commentWrite">-->
                        <?php echo form_open('comments/create/'.$post_id); ?>
                        <textarea name="comment" class="form-control" placeholder="Jūsų komentaras" rows="4" required></textarea><br />
                        <input type="submit" name="submit" class="btn btn-primary" value="Komentuoti" />

                        </form>
                    <!--</div>-->
                <?php } else {  ?>
                    <!--<div id="commentWrite">-->
                        Jūs turite būti prisijungęs, kad galėtumėte parašyti komentarą.
                    <!--</div>-->
                <?php } ?>
            </div>
          </div>
</div>
    
</div>
