<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Stock Management</h4>
    </div>
</div>


<div class="container-fluid pt-5">

    <div class="container-fluid">
        <table class="table">
            <tr class="text-center">
                <th>#&nbsp;&nbsp;</th>
                <th>Product SKU&nbsp;&nbsp;</th>
                <th>Product Name&nbsp;&nbsp;</th>
                <th>Supplier&nbsp;&nbsp;</th>
                <th>Stock Count&nbsp;&nbsp;</th>

                <th>Action&nbsp;&nbsp;</th>
            </tr>
            <?php
            $counter = 1;
            foreach ($products->result_array() as $list) : ?>
                <tr>
                    <td><?= $counter; ?></td>
                    <td>&nbsp;&nbsp;<?= $list['prd_sku']; ?></td>
                    <td>&nbsp;&nbsp;<?= $list['prd_name']; ?></td>
                    <td>&nbsp;&nbsp;<?= $list['supplier_name']; ?></td>
                    <td class="text-center">&nbsp;&nbsp;<?= $list['inv_qty']; ?></td>

                    <td>
                        <!-- <button type="submit" class="productInfo btn btn-outline-secondary" data-toggle="modal" data-target="#productInfo" id="<? //= $list['prd_sku']; 
                                                                                                                                                    ?>" href="stockinfo/<? //= $list['prd_sku']; 
                                                                                                                                                                                                ?>"><i class="fas fa-info-circle"></i></button> -->
                        &nbsp;<a class="btn btn-outline-success" href="<?= base_url(); ?>admin/stocktransfer?prdsku=<?= $list['prd_sku']; ?>"><i class="fas fa-dolly"></i></a> </td>
                </tr>
            <?php
                $counter++;
            endforeach;
            ?>
        </table>
    </div>
</div>
<div class="modal fade" id="productInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>