</div>
        <div id="sideBar">
            <div id="pollBar">
                <?php echo form_open('poll/vote'); ?>
                    <div id="pollQuestion"><?=$poll_question;?></div>
                    <?php
                    if(!$poll_voted) { ?>
                    <div id="pollItems">
                       
                        <?php  foreach($poll_items as $item) { ?>
                        <input type="radio" name="poll" value="<?=$item->id;?>" /> <label><?=$item->name;?></label> <br />
                        <?php } ?>
                        
                        <!--<input type="radio" name="poll" value="2" /> <label>Barcelona</label> <br />
                        <input type="radio" name="poll" value="3" /> <label>Arsenal</label> <br />
                        <input type="radio" name="poll" value="4" /> <label>Manchester United</label> <br />
                        <input type="radio" name="poll" value="5" /> <label>Juventus</label> <br />
                        <input type="radio" name="poll" value="6" /> <label>Bayern</label> <br />-->
                    </div>
                    <div id="pollVote">
                        <input type="submit" name="vote" value="Balsuoti" <?php if(!$logged_in) { echo "disabled"; } ?> />
                    </div>
                </form>
                    <?php
                        }
                        else 
                        { 
                        ?>
                    <div id="pollResults">
                        <?php
                            $sum = array_sum($poll_results);
                            foreach($poll_results as $poll_item => $poll_value)
                            { ?>
                        <div class="pollResultName"><?=$poll_item;?></div>
                        <div class="pollResultValue"><?=$poll_value;?> / <?=ceil($poll_value/$sum * 100);?>%</div> 
                        <?php } 
                        
                        } ?>
                    </div>
                <div class="clear"></div>
            </div>
            <hr class="contentContainerHr" />
            <?php if(!$logged_in) { ?>
            <div id="loginBar">
                    <?php echo form_open('users/login'); ?>
                    <input type="text" name="username" placeholder="Vartotojo vardas" required /> <br />
                    <input type="password" name="password" placeholder="Slaptažodis" required /> <br />
                    <input id="loginSubmit" type="submit" name="login" value="Prisijungti" /> <br />
                    <a href="/users/remind_password">Slaptažodžio priminimas</a><br />
                    <a href="/users/create"> Užsiregistruoti </a>
                </form>
            </div>
            <hr class="contentContainerHr" />
            <?php } else { ?>
            <div id="greetBar">
                <div id="greetBarGreet">Sveiki, <?=$username;?>!</div>
                <?php if($user_level == 9) { ?>
                <a href="/posts/create">Sukurti įrašą</a><br />
                <a href="/posts/manage">Tvarkyti įrašus</a><br />
                <a href="/poll/create">Sukurti apklausą</a><br />
                <a href="/poll/manage">Tvarkyti apklausas</a><br />
                <a href="/users/manage">Tvarkyti vartotojus</a><br />
                <?php } ?>
                <a href="/users/change_password">Pasikeisti slaptažodį</a><br />
                <a href="/users/logout">Atsijungti</a><br />
            </div>
            <hr class="contentContainerHr" />
            <?php } ?>
        </div>
        <div id="spacer">&nbsp;</div>
    </div>            
</div>