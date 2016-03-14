<div class="contentContainer">
    <div class="contentContainerTitle">
        <a href="#" class="contentContainerTitle"><?=$post->title;?></a>
    </div>
    <div class="contentContainerTime">
        <?=date("Y-m-d H:i", $post->date);?>
    </div>

    <div class="contentContainerContent">
        <?=$post->text;?>
    </div>
</div>
<hr class="contentContainerHr">
<div id="contentComments">
    <a name="comments"><div id="contentCommentsTitle"><?php
            echo $post->comments;
            echo " ";
            echo call_user_func(array("Posts", "get_comment_text"), $post->comments);
            ?></div></a>
    <div id="contentCommentsComments">
