<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Vartotojų tvarkymas</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vartotojo vardas</th>
                        <th>El. Paštas</th>
                        <th>Lygis</th>
                        <th>Aktyvuotas</th>
                        <th>Veiksmai</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $i = 1;
                foreach($users as $item) {
                ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$item->username;?></td>
                        <td><?=$item->email;?></td>
                        <td><?=$item->level;?></td>
                        <td><?=$item->active ? "Taip" : "Ne"; ?></td>
                        <td>
                            <?php 
                            if($item->temp_id != $this->nativesession->get('user_id')) { ?>
                        <?php if($item->active == 1) { ?>
                            <a href="<?=site_url('admin/users/deactivate/'.$item->id);?>">
                                <button type="button" class="btn btn-xs btn-default">Deaktyvuoti</button></a>
                        <?php } else { ?>
                            <a href="<?=site_url('admin/users/activate/'.$item->id);?>">
                                <button type="button" class="btn btn-xs btn-default">Aktyvuoti</button></a>
                        <?php }?>


                            <a href="<?=site_url('admin/users/delete/'.$item->id);?>">
                                <button type="button" class="btn btn-xs btn-default">Ištrinti</button></a>
                        <?php } ?>
                        </td>
                    </tr>
                <?php 
                $i++;
                } 
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr class="contentContainerHr">
</div>