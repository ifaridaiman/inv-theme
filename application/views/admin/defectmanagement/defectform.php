<a onclick="window.print()">
    <?php
    $counter = 1;
    $tmp = 0;
    foreach ($defectinfo->result_array() as $info) : ?>
        <div class="container p-5">
            <div class="row ">
                <div class="col pb-4">
                    <h3>Return Form For <?= $info['supplier_name']; ?></h3>
                </div>
                <hr>
            </div>

            <div class="row pb-5">
                <div class="col-3">
                    <!-- supplier address  -->
                    <?= $info['supplier_address']; ?>
                </div>
                <div class="col text-right">
                    <!-- date-timestamp -->
                    <?php echo date("l , Y-m-d"); ?>
                </div>
            </div>
            <div class="row pb-5">
                <div class="col ">
                    We're returning the item we received on <?= $info['receivabletime']; ?>. The product are/is as listed down below:
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- table -->
                    <table class="table">
                        <!-- table header -->
                        <tr class="text-center">
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Product Quantity</th>
                            <th>Product Price</th> <!-- take cost price -->
                            <th>Total per net</th>
                        </tr>
                        <!-- table content -->
                        <tr class="text-center">
                            <td><?= $counter; ?></td>
                            <td><?= $info['prd_name']; ?></td>
                            <td><?= $info['defectlog_qty']; ?></td>
                            <td><?= $info['prd_cost']; ?></td>
                            <?php $tpn = $info['prd_cost'] * $info['defectlog_qty']; ?>
                            <td>RM <?= $tpn; ?></td>
                            <?php $tmp = $tmp + $tpn; ?>
                        </tr>
                        <!-- end table content -->
                        <!-- total product return -->
                        <tr>
                            <td colspan="4" class="text-right">
                                <h5>Total</h5>
                            </td>
                            <td class="text-center">
                                <p>RM <?= $tmp; ?> </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <!-- store detail -->
                <div class="col">
                    <!-- store name -->
                </div>
                <div class="col">
                    <!-- store signature -->
                </div>
                <div class="col">
                    <!-- date printing the form -->
                </div>
            </div>
        <?php endforeach; ?>
        </div>
</a>