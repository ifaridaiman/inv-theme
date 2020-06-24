<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Product Management > Edit Product</h4>
    </div>
</div>
<div class="container pt-5">
    <h4>Product Info</h4>
    <hr>

    <form method="POST" action="<?php echo base_url(); ?>admin/editproduct?prd_sku=<?= $_GET['prd_sku']; ?>">
        <?php foreach ($products->result_array() as $list) : ?>

            <div class="form-group">
                <label for="productname">Product Name</label>
                <input type="text" class="form-control" placeholder="Product Name" id="productname" name="productname" value="<?= $list['prd_name']; ?>">
            </div>
            <div class="form-group">
                <label for="productdesc">Product Description</label>
                <input type="text" class="form-control" placeholder="product description" id="productdesc" name="productdescription" value="<?= $list['prd_desc']; ?>">
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="productsku">Product SKU</label>
                    <input type="text" class="form-control" placeholder="SKU" id="productsku" name="productsku" value="<?= $list['prd_sku']; ?>" readonly>
                </div>
                <div class="col">
                    <label for="productname">Product Categories</label>
                    <div class="input-group">
                        <select class="custom-select mr-sm-2" id="categories" name="productcategories">
                            <option value="<?= $list['category_id']; ?>"><?= $list['category_name']; ?></option>
                            <?php foreach ($categoriesname->result_array() as $categoryname) : ?>
                                <option value="<?= $categoryname['category_id']; ?>"><?= $categoryname['category_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="supplier">Supplier</label>
                    <input type="text" class="form-control" placeholder="product description" id="productdesc" name="" value="<?= $list['supplier_name']; ?>" readonly>

                </div>

            </div>
            <div class="form-row">
                <div class="col">
                    <label for="productcost">Product Cost</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">RM</span>
                        </div>
                        <input type="number" class="form-control" id="productcost" name="productcost" step="0.01" value="<?= $list['prd_cost']; ?>">
                    </div>
                </div>
                <div class="col">
                    <label for="productsell">Product Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">RM</span>
                        </div>
                        <input type="number" class="form-control" placeholder="RM" id="productsell" name="productprice" step="0.01" value="<?= $list['prd_price']; ?>">
                    </div>
                </div>
                <div class="col">
                    <label for="producttaxes">Taxes</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="0.06" id="producttaxes" name="producttax" step="0.01" value="<?= $list['prd_taxes']; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>
            <h4>Stock Tracking</h4>
            <hr>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Ideal Inventory</span>
                        </div>
                        <input type="text" class="form-control" name="stockidealqty" value="<?= $list['inv_ideal_qty']; ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="stockwrnqty">Warning Inventory</span>
                        </div>
                        <input type="number" class="form-control" name="stockwrnqty" value="<?= $list['inv_warning_qty']; ?>">
                    </div>
                </div>
            </div>

            <div class="form-row mt-2">
                <input type="submit" value="Register New Product" class="btn-primary form-control">
            </div>
    </form>
</div>
<div class="modal fade" id="categoriesadd" tabindex="-1" role="dialog" aria-labelledby="categoriesadd" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url(); ?>admin/addnewproduct">
                    <input type="text" name="categories" class="form-control">
            </div>
            <div class="modal-footer">
                <input type="submit" value="Add new Categories">
                </form>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>