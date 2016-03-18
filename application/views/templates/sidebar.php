</div>
<div id="sideBar">
    <div id="pollBar">
        <?php
        if(!$poll_voted) { 
        echo form_open('poll/vote');
        ?>
            <div id="pollQuestion"><?=$poll_question;?></div>
            
            <div id="pollItems">
                <?php
                foreach($poll_items as $item) { 
                ?>
                <input type="radio" name="poll" value="<?=$item->id;?>" /> <label><?=$item->name;?></label> <br />
                <?php 
                } 
                ?>
            </div>
            <div id="pollVote">
                <button type="button" name="voteButton" id="voteButton" class="btn btn-primary btn-block"
                    <?php if(!$logged_in) { echo "disabled";} ?>>Balsuoti</button>
            </div>
        </form>
        <?php
        } else {
        $this->load->view('poll/view.php', array('poll_results' => $poll_results));
        }
        ?>
    </div>
    <div class="clear"></div>
    <hr class="contentContainerHr" />
    <?php 
    if(!$logged_in) {
    ?>
    <div id="loginBar">
        <?php echo form_open('users/login'); ?>
            <div class="col-xs-12">
            <input type="text" class="form-control input-sm" name="username" placeholder="Vartotojo vardas" required />
            </div>
            <div class="col-xs-12">
            <input type="password" class="form-control input-sm" name="password" placeholder="Slaptažodis" required />
            </div>
            <div class="col-xs-12" style="margin-left: -4px;">
                <input id="loginSubmit" class="btn btn-sm btn-primary btn-block" type="submit" name="login" value="Prisijungti" />
            </div>
            <a href="/users/remind_password">Slaptažodžio priminimas</a><br />
            <a href="/users/create">Užsiregistruoti </a>
        </form>
    </div>
    <hr class="contentContainerHr" />
    <?php
    } else {                
    ?>
    <div id="greetBar">
        <div id="greetBarGreet">Sveiki, <?=$username;?>!</div>
    </div>
    <div class="col-xs-12" style="margin-left: 4px;">
        <div class="sidebar-nav">
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                        <span class="sr-only">Navigacijos jungliklis</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse sidebar-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <?php if($user_level == 9) { ?>
                        <li><a href="/admin/posts/create">Sukurti įrašą</a></li>
                        <li><a href="/admin/posts/manage">Tvarkyti įrašus</a></li>
                        <li><a href="/admin/poll/create">Sukurti apklausą</a></li>
                        <li><a href="/admin/poll/manage">Tvarkyti apklausas</a></li>
                        <li><a href="/admin/users/manage">Tvarkyti vartotojus</a></li>
                        <?php } ?>
                        <li><a href="/users/change_password">Pasikeisti slaptažodį</a></li>
                        <li><a href="/users/logout">Atsijungti</a></li>
                    </ul>
                </div>
            </div>
      </div>
    </div>
<?php
}
?>
<div id="spacer">&nbsp;</div>

</div>            
</div>