<div class="sidenav">
    <div class="about d-none">
        <div class="row text-white">
            <div class="col-3">
                <div class="container">
                    <img height="50px" width="50px" src="<?php echo base_url(); ?>/assets/img/computer.png">
                </div>
            </div>
            <div class="col-6">
                <div class="container pt-4">
                    <h6><?= $primaryname; ?></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="smallsidebar" id="smallsidebar">
        <a href="<?php echo base_url(); ?>staff" class="dropdown-item"><i class="fas fa-clipboard-list"></i> Home</a>
        <a href="<?php echo base_url(); ?>staff/defectreport"><i class="far fa-edit"></i> Defect Report</a>
        <a href="<?php echo base_url(); ?>/user/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>


</div>
<div class="main">