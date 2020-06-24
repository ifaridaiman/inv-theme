<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Staff Management</h4>
    </div>
</div>

<div class="container pt-5">
    <div class="container-fluid">
        <table class="table table-striped">
            <tr class="text-center">
                <th>#</th>
                <th>SKU</th>
                <th>Product Name</th>
                <th>Supplier Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            <?php
            $counter = '1';
            foreach ($getOrderReceivable->result_array() as $receivablelist) : ?>
                <?php if ($receivablelist['status'] == '0' && $receivablelist['store_id'] == $_SESSION['storeid']) { ?>
                    <tr class="text-center">
                        <td><?= $counter; ?></td>
                        <td><?= $receivablelist['prd_sku']; ?></td>
                        <td><?= $receivablelist['prd_name']; ?></td>
                        <td><?= $receivablelist['supplier_name']; ?></td>
                        <td><?= $receivablelist['order_qty']; ?></td>

                        <td><a class="btn btn-outline-secondary" data-toggle="modal" data-target="#receivableinfo" id=""><i class="fas fa-info-circle"></i></a>&nbsp;<a class="btn btn-outline-info" href="<?= base_url(); ?>staff/receivableValidation?orderid=<?= $receivablelist['order_id']; ?>"><i class="far fa-folder-open"></i></a></td>
                    </tr>
                <?php }; ?>

            <?php
                $counter++;
            endforeach; ?>
        </table>
    </div>
</div>