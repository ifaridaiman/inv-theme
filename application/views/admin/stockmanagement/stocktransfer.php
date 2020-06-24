<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Stock Management > Stock Transfer</h4>
    </div>
</div>

<div class="container-fluid pt-5">
    <?php foreach ($products->result_array() as $list) : ?>
        <form action="<?php echo base_url(); ?>admin/stocktransfer?prdsku=<?= $list['prd_sku']; ?>" method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control-plaintext" placeholder="Product Name" id="invid" name="invid" value="<?= $list['inv_id']; ?>" readonly>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="productname">Product Name</label>
                    <input type="text" class="form-control-plaintext" placeholder="Product Name" id="productname" name="productname" value="<?= $list['prd_name']; ?>" readonly>
                </div>
                <div class="col">
                    <label for="productsku">Product SKU</label>
                    <input type="text" class="form-control-plaintext" placeholder="SKU" id="productsku" name="productsku" value="<?= $list['prd_sku']; ?>" readonly>
                </div>
            </div>

            <div class="form-row">

                <div class="col">
                    <label for="transferqty">Product Quantity</label>
                    <input type="number" class="form-control" id="transferqty" name="transferqty" max="<?= $list['inv_qty'] ?>">
                </div>
                <div class="col">
                    <label for="storelist">Store to Transfer</label>
                    <select class="custom-select mr-sm-2" id="storelist" name="storelist">
                        <option selected>Store</option>
                        <?php foreach ($store->result_array() as $storelist) : ?>
                            <?php if ($_GET['strid'] != $storelist['store_id']) { ?>
                                <option value="<?= $storelist['store_id']; ?>"><?= $storelist['store_name']; ?></option>
                            <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row mt-2">
                <input type="submit" value="Generate Transfer Receipt" class="btn-primary form-control">
            </div>
        <?php endforeach; ?>
        </form>
</div>