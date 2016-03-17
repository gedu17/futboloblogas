<div class="contentContainer">
    <div class="contentContainerTitle">
        Apklausų tvarkymas
    </div>
    <div class="contentContainerContent">
        <br />
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Pavadinimas</th>
                <th>Atsakymų skaičius</th>
                <th>Aktyvus</th>
                <th>Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            foreach($polls as $item) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><a href="<?=site_url('admin/poll/edit/'.$item->id);?>"><?=$item->name;?></a></td>
                <td><?=$item->answer_count;?></td>
                <td>
                <?php 
                if($item->active == 0) {
                ?>
                    <a href="<?=site_url('admin/poll/activate/'.$item->id);?>">
                        <button type="button" class="btn btn-xs btn-default">Aktyvuoti</button></a>
                <?php 
                } else {
                ?>
                    <button type="button" class="btn btn-xs btn-default" disabled>Aktyvus</button>
                <?php
                } 
                ?>
                </td>
                <td><a href="<?=site_url('admin/poll/edit/'.$item->id);?>">
                        <button type="button" class="btn btn-xs btn-default">Taisyti</button></a>
                    <?php if($item->active == 0) { ?>
                    <a href="<?=site_url('admin/poll/delete/'.$item->id);?>">
                        <button type="button" class="btn btn-xs btn-default">Ištrinti</button></a>
                    <?php } ?> 
                </td>
            </tr>
            
            <?php 
            $i++;
            } ?>
            </tbody>
        </table>
    </div>
</div>
<hr class="contentContainerHr">