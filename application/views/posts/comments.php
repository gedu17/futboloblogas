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
    <div class="commentText">
        <?=$comment->text;?>
    </div>
</div>
<div class="commentSpacer">&nbsp;</div>
<?php
$i++;
} ?>