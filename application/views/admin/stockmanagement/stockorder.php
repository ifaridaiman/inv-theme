<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Stock Management > Stock Order</h4>
    </div>
</div>
<!-- choose product => quantity=> => for whhat store email -->
<div class="container">
    <?php $prdsku = $_GET['prd_sku']; ?>
    <form method="POST" action="<?php echo base_url(); ?>admin/restock?prd_sku=<?= $prdsku; ?>">
        <label for="inv-id">Product SKU | Supplier</label>
        <input class="form-control-plaintext" type="text" name="prdsku" value="<?= $prdsku; ?>" readonly>

        <label for="orderqty"> Quantity of Product</label>
        <input type="number" name="orderqty" class="form-control" id="orderqty">

        <label for="store-id">Store</label>
        <select class="custom-select mr-sm-2" name="storeid" id="store-id">
            <?php foreach ($getStore->result_array() as $storeName) : ?>
                <option value="<?= $storeName['store_id']; ?>"><?= $storeName['store_name']; ?> </option>
            <?php endforeach; ?>
        </select>
        <div class="pt-3">
            <input class="form-control btn btn-primary" type="submit" value="Generate Order Form">
        </div>
    </form>
</div>