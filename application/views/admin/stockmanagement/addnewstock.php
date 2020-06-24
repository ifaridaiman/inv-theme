<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Stock Management > Add New Product</h4>
    </div>
</div>
<div class="container pt-5">
    <h4>Product Info</h4>
    <hr>
    <form method="POST" action="<?php echo base_url(); ?>admin/addnewproduct">
        <div class="form-group">
            <label for="productname">Product Name</label>
            <input type="text" class="form-control" placeholder="Product Name" id="productname" name="productname">
        </div>
        <div class="form-group">
            <label for="productdesc">Product Description</label>
            <textarea class="form-control" placeholder="product description" id="productdesc" name="productdescription"></textarea>
        </div>
        <div class="form-row">
            <div class="col">
                <?= $this->session->flashdata('fmsg'); ?>
                <label for="productsku">Product SKU</label>
                <input type="text" class="form-control" placeholder="SKU" id="productsku" name="productsku">
            </div>
            <div class="col">
                <label for="productname">Product Categories</label>
                <div class="input-group">
                    <select class="custom-select mr-sm-2" id="categories" name="productcategories">
                        <option selected>Categories</option>
                        <?php foreach ($categoriesname->result_array() as $categoryname) : ?>
                            <option value="<?= $categoryname['category_id']; ?>"><?= $categoryname['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <a class="productInfo btn btn-outline-secondary" data-toggle="modal" data-target="#categoriesadd"><i class="fas fa-plus"></i></a>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="supplier">Supplier</label>
                <select class="custom-select mr-sm-2" id="supplier" name="supplier">
                    <option selected>Supplier</option>
                    <?php foreach ($suppliername->result_array() as $suppliername) : ?>
                        <option value="<?= $suppliername['supplier_id']; ?>"><?= $suppliername['supplier_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>
        <div class="form-row">
            <div class="col">
                <label for="productcost">Product Cost</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">RM</span>
                    </div>
                    <input type="number" class="form-control" id="productcost" name="productcost" step="0.01">
                </div>
            </div>
            <div class="col">
                <label for="productsell">Product Price</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">RM</span>
                    </div>
                    <input type="number" class="form-control" placeholder="RM" id="productsell" name="productprice" step="0.01">
                </div>
            </div>
            <div class="col">
                <label for="producttaxes">Taxes</label>
                <div class="input-group">
                    <input type="number" class="form-control" placeholder="0.06" id="producttaxes" name="producttax" step="0.01">
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
                    <input type="text" class="form-control" name="stockidealqty">
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="stockwrnqty">Warning Inventory</span>
                    </div>
                    <input type="number" class="form-control" name="stockwrnqty">
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
            </div>
        </div>
    </div>
</div>