<div class="sidenav">
    <div class="about">
        <br>
        <div class="row text-white">
            <div class="col-3">
                <div class="container">
                    <img height="50px" width="50px" src="<?php echo base_url(); ?>/assets/img/computer.png">
                </div>
            </div>
            <div class="col-6">
                <div class="container pt-4">
                    <h6><?= $systemname; ?></h6>
                </div>
            </div>

        </div>
        <br>
        <hr class="border border-primary">
    </div>

    <div class="smallsidebar" id="smallsidebar">
        <a href="<?php echo base_url(); ?>admin" class="dropdown-item"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="<?php echo base_url(); ?>admin/productmanagement"><i class="fas fa-boxes"></i> Product Management</a>
        <a href="<?php echo base_url(); ?>admin/stockmanagement"><i class="fas fa-cubes"></i> Stock Management</a>
        <a href="<?php echo base_url(); ?>admin/defectmanagement"><i class="fas fa-truck"></i> Defect Management</a>
        <a href="<?php echo base_url(); ?>admin/suppliermanagement"><i class="fas fa-user-plus"></i> Supplier Management</a>
        <a href="<?php echo base_url(); ?>/user/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>


</div>
<div class="main">