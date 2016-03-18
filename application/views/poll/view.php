<div id="pollResults">
<?php
$sum = array_sum($poll_results);
if($sum != 0) {
    foreach($poll_results as $poll_item => $poll_value) {
        $percentage = round($poll_value/$sum * 100, 1, PHP_ROUND_HALF_UP);
?>
    <div><?=$poll_item;?> <span class="pull-right"><?=$poll_value;?> / <?=$percentage;?>%</span></div>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percentage;?>%"><span class="sr-only"><?=$percentage;?>%</span></div>
    </div>
<?php
    }
}
?>
</div>