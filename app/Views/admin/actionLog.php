<div class="table-responsive">
    <small>
<table class="table table-stripped table-bordered">
   
    <thead>

        <tr>
            <th>Action Date</th>
            <th>By User</th>
            <th>Update Data</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($list['data'] as $item){?>
            <tr>
                <td><?=$item['created_at']?></td>
                <td><?=$item['action_by_user']?></td>
                <td><?=$item['chaged_data']?></td>
            </tr>
        <?php } ?>

    <?php if(empty($list['data'])){?>
        <tr ><td colspan="3">No data avilable.</td></tr>
    <?php }?>
    </tbody>
</table>
</small>
</div>