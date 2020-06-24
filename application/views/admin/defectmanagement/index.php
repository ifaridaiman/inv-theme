<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Defect Management</h4>
    </div>
</div>
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col mb-2 mr-4">
        </div>
    </div>

    <div class="container-fluid">
        <table class="table table-striped">
            <tr class="text-center">
                <th>#&nbsp;&nbsp;</th>
                <th>Report Date&nbsp;&nbsp;</th>
                <th>Product&nbsp;&nbsp;</th>
                <th>Supplier&nbsp;&nbsp;</th>
                <th>Defect Count&nbsp;&nbsp;</th>
                <th>Action&nbsp;&nbsp;</th>
            </tr>
            <?php
            $counter = '1';
            foreach ($defectlist->result_array() as $list) : ?>
                <tr>
                    <td><?= $counter; ?></td>
                    <td><?= date("Y-m-d", strtotime($list['defectlog_timestamp'])); ?></td>
                    <td><?= $list['prd_name']; ?></td>
                    <td><?= $list['supplier_name']; ?></td>
                    <td class="text-center"><?= $list['defectlog_qty']; ?></td>
                    <td>&nbsp;<a class="btn btn-outline-info" href="<?= base_url(); ?>admin/defectform?dfctid=<?= $list['defectlog_id']; ?>"><i class="fas fa-print"></i></a></td>
                </tr>
            <?php
                $counter++;
            endforeach; ?>
        </table>
    </div>


</div>