<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Staff Management</h4>
    </div>
</div>
<form action="<?= base_url(); ?>staff/receivableValidation?orderid=<?= $ordid; ?>" method="POST">
    <?php foreach ($detail->result_array() as $detailreceivable) : ?>
        <input type="hidden" name="orderid" value="<?= $ordid; ?>">
        <div class="form-row">
            <div class="col">
                <label for="productsku">Product SKU</label>
                <input readonly type="text" class="form-control" placeholder="SKU" name="productsku" id="productsku" value="<?= $detailreceivable['prd_sku']; ?>">
            </div>
            <div class="col">
                <label for="productname">Product Name</label>
                <input readonly type="text" class="form-control" placeholder="Product Name" id="productname" value="<?= $detailreceivable['prd_name']; ?>">
            </div>

        </div>
        <div class="form-row">
            <div class="col">
                <label for="productsell">Product Description</label>
                <input readonly type="text" class="form-control" id="productsell" value="<?= $detailreceivable['prd_desc']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="productsell">Product Category</label>
                <input readonly type="text" class="form-control" id="productsell" value="<?= $detailreceivable['category_name']; ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="productsell">Ordered Quantity</label>
                <input readonly type="number" class="form-control" id="productsell" value="<?= $detailreceivable['order_qty']; ?>">
            </div>
            <div class="col">
                <label for="receivedqty">Received Quantity</label>
                <input type="number" class="form-control" id="receivedqty" name="receivedqty" max=<?= $detailreceivable['order_qty']; ?>>
            </div>
        </div>



        <div class="form-row mt-2">
            <input type="submit" value="Generate Reorder Form" class="btn-primary form-control">
        </div>
    <?php endforeach; ?>
</form>