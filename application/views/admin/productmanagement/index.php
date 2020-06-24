<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Product Management</h4>
    </div>
</div>
<div class="container pt-5 text-right">
    <a class="btn btn-info " href="" data-toggle="modal" data-target="#checksupplier">Add New Product </a>

</div>
<?= $this->session->flashdata('message'); ?>

<div class="container-fluid pt-5">

    <div class="container-fluid">
        <table class="table">
            <tr>
                <th>#&nbsp;&nbsp;</th>
                <th>SKU&nbsp;&nbsp;</th>
                <th>Product Name&nbsp;&nbsp;</th>
                <th>Supplier&nbsp;&nbsp;</th>
                <th>Cost&nbsp;&nbsp;</th>
                <th>Sell Price&nbsp;&nbsp;</th>
                <th>Margin Ratio &nbsp;&nbsp;</th>
                <th>Action&nbsp;&nbsp;</th>
            </tr>
            <?php
            $counter = 1;
            foreach ($products->result_array() as $productlist) : ?>
                <tr>
                    <td><?= $counter; ?></td>
                    <td><?= $productlist['prd_sku']; ?></td>
                    <td><?= $productlist['prd_name']; ?></td>
                    <td><?= $productlist['supplier_name']; ?></td>
                    <td><?= $productlist['prd_cost']; ?></td>
                    <td><?= $productlist['prd_price']; ?></td>
                    <td><?= number_format((($productlist['prd_price'] - $productlist['prd_cost']) / $productlist['prd_cost']) * 100, 2, '.', ''); ?> %</td>
                    <td>
                        <div class="row">
                            <div class="col-3">
                                <a class="btn btn-outline-info" href="<?= base_url();
                                                                        ?>admin/editproduct?prd_sku=<?= $productlist['prd_sku'];
                                                                                                    ?> "><i class="fas fa-pencil-alt"></i></a>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-outline-danger" href="<?= base_url();
                                                                        ?>admin/deleteproduct?prdsku=<?= $productlist['prd_sku'];
                                                                                                        ?>"><i class="far fa-trash-alt"></i></a>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-outline-success" href="<?= base_url(); ?>admin/restock?prd_sku=<?= $productlist['prd_sku']; ?> "><i class="fas fa-cart-plus"></i></a>
                            </div>
                        </div>
                    </td>

                </tr>
            <?php
                $counter++;
            endforeach;
            ?>

        </table>
    </div>
</div>

<div class="modal fade" id="checksupplier" tabindex="-1" role="dialog" aria-labelledby="checksupplier" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checksupplier">Check Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <a class="btn btn-secondary" href="<?= base_url(); ?>admin/suppliermanagement">New Supplier</a>
                &nbsp;
                <a class="btn btn-primary" href="<?= base_url(); ?>admin/addnewproduct">Existing Supplier</a>
            </div>
        </div>
    </div>
</div>