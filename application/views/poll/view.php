<div id="pollResults">
<?php
$sum = array_sum($poll_results);
if($sum != 0) {
    foreach($poll_results as $poll_item => $poll_value) {
?>
    <div class="pollResultName"><?=$poll_item;?></div>
    <div class="pollResultValue" style=""><?=$poll_value;?> / <?=ceil($poll_value/$sum * 100);?>%</div>
<?php
    }
}
?>
</div>