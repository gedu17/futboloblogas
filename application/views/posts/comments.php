<?php 
$i = 1;
foreach($comments as $comment) { ?>
<div class="commentContainer">
    <div class="commentCommenter">
        <?=$i;?>.<?=$comment->user;?>
    </div>
    <div class="commentTime">
        <?=date("Y-m-d H:i:s", $comment->date); ?>
    </div>
    <?php
    if($user_level == 9) {
    ?>
    
    <div class="commentDelete"><a href="/admin/comments/delete/<?=$comment->id;?>">
        <button type="button" class="btn btn-xs btn-default">Ištrinti</button></a>
    </div>
    <?php
    }
    ?>
    <div class="commentText">
        <?=$comment->text;?>
    </div>
</div>
<div class="commentSpacer">&nbsp;</div>
<?php
$i++;
} ?>