<?php 
foreach ($posts as $post)   
{ 
?>
<div class="contentContainer">
    <div class="contentContainerTitle">
        <a href="<?php echo site_url('posts/'.$post->id); ?>" class="contentContainerTitle"><?=$post->title;?></a>
    </div>
    <div class="contentContainerTime">
        <?=date("Y-m-d H:i", $post->date);?>
    </div>
    <div class="contentContainerComments">
        <a href="<?php echo site_url('posts/'.$post->id); ?>#comments" class="contentContainerComments">
        <?php
            echo $post->comments;
            echo " ";
            echo call_user_func(array("Posts", "get_comment_text"), $post->comments);
            ?>
        </a>
    </div>
    <div class="contentContainerContent">
       <?=$post->text;?>
    </div>
</div>
<hr class="contentContainerHr">
<?php 
}
?>
