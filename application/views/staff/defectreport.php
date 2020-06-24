<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Defect Form</h4>
    </div>
</div>
<div class="container pt-5">
    <div class="pt-5 shadow-lg mb-5 bg-white rounded">
        <div class="container">
            <form method="POST" action="<?= base_url(); ?>staff/defectreport">
                <div class="form-row">
                    <div class="col">
                        <label for="my-input">Product SKU / Name / Current Qty</label>
                        <select class="custom-select mr-sm-2" name="invid">
                            <?php foreach ($getProduct->result_array() as $productname) : ?>

                                <option value="<?= $productname['inv_id']; ?>"><?= $productname['prd_sku']; ?> | <?= $productname['prd_name']; ?> | <?= $productname['inv_qty']; ?></option>

                            <?php endforeach; ?>
                        </select>


                    </div>
                    <div class="col">
                        <label for="my-input">Defect Item Quantity</label>
                        <input id="my-input" class="form-control" type="text" name="defectqty">
                    </div>

                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="productdesc">Defect Description</label>
                        <textarea class="form-control" placeholder="product description" id="defectdesc" name="defectdesc"></textarea>
                    </div>
                </div>
                <div class="form-row pt-2 pb-4">
                    <div class="col">
                        <input id="my-input" class="form-control btn btn-primary" type="submit" value="Generate Defect Form">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>