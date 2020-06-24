<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Supplier Management</h4>
    </div>
</div>
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col mb-2 mr-4">
            <a class="btn btn-info float-right" href="" data-toggle="modal" data-target="#addSupplier">Add New Supplier </a>
        </div>
    </div>

    <div class="container-fluid">
        <table class="table table-striped">
            <tr>
                <th>#&nbsp;&nbsp;</th>
                <th>Supplier Name&nbsp;&nbsp;</th>
                <th>Supplier Email&nbsp;&nbsp;</th>
                <th>Supplier Phone Number&nbsp;&nbsp;</th>
                <th style="width: 150px;">Action&nbsp;&nbsp;</th>
            </tr>
            <?php
            $counter = 1;
            foreach ($supplier->result_array() as $list) : ?>
                <tr>
                    <td><?= $counter; ?></td>
                    <td>&nbsp;&nbsp;<?= $list['supplier_name']; ?></td>
                    <td>&nbsp;&nbsp;<?= $list['supplier_email']; ?></td>
                    <td>&nbsp;&nbsp;<?= $list['supplier_phonenum']; ?></td>
                    <td><a class="btn btn-outline-info" href="<?= base_url(); ?>admin/editsupplier?spid=<?= $list['supplier_id']; ?>"><i class="fas fa-user-edit"></i></a></td>
                </tr>
            <?php
                $counter++;
            endforeach;
            ?>
        </table>
    </div>

    <div class="modal fade" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form action="<?= base_url(); ?>admin/suppliermanagement" method="POST">
                        <div class="form-group">
                            <label for="suppliername">Supplier Name</label>
                            <input type="text" placeholer="Supplier Name" name="suppliername" id="suppliername" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="suppliername">Supplier Address</label>
                            <input type="text" placeholer="Supplier Name" name="supplieraddress" id="supplieraddress" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="supplierphonenumber">Supplier Phone Number</label>
                                <input id="supplierphonenumber" class="form-control" type="text" name="supplierphonenumber">
                            </div>
                            <div class="col">
                                <label for="supplieremail">Supplier Email</label>
                                <input id="supplieremail" class="form-control" type="text" name="supplieremail">
                            </div>
                        </div>

                        <input type="submit" value="Register Supplier" class="btn btn-primary btn-lg btn-block mt-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>