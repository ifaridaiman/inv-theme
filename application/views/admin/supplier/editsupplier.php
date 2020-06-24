<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Supplier Management > Edit Supplier</h4>
    </div>
</div>
<div class="container pt-5">
    <h4>Supplier Info</h4>
    <hr>

    <form action="<?= base_url(); ?>admin/editsupplier?spid=<?= $_GET['spid']; ?>" method="POST">
        <?php foreach ($supplier->result_array() as $list) : ?>

            <div class="form-group">
                <label for="suppliername">Supplier Name</label>
                <input type="text" placeholer="Supplier Name" name="suppliername" id="suppliername" class="form-control-plaintext" value="<?= $list['supplier_name']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="suppliername">Supplier Address</label>
                <input type="text" placeholer="Supplier Name" name="supplieraddress" id="supplieraddress" class="form-control" value="<?= $list['supplier_address']; ?>">
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="supplierphonenumber">Supplier Phone Number</label>
                    <input id="supplierphonenumber" class="form-control" type="text" name="supplierphonenumber" value="<?= $list['supplier_phonenum']; ?>">
                </div>
                <div class="col">
                    <label for="supplieremail">Supplier Email</label>
                    <input id="supplieremail" class="form-control" type="text" name="supplieremail" value="<?= $list['supplier_email']; ?>">
                </div>
            </div>

            <input type="submit" value="Edit Supplier" class="btn btn-primary btn-lg btn-block mt-2">
        <?php endforeach; ?>

    </form>
</div>