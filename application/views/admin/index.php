<div class="container-fluid border-bottom">
    <div class="p-3">
        <h4>Dashboard</h4>
    </div>
</div>
<div class="container">
    <div class="row text-center mt-5">

        <div class="col-sm">
            <div class="card p-4">
                <div class="card-body">
                    <h2>RM <?php

                            foreach ($budgetcost->result_array() as $output) {
                                echo $output['balance'];
                            }
                            ?></h2>
                    <h6>Restock Cost Budget</h6>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="container ml-4 pt-3">
    <h4>low stock product</h4>
    <hr>
    <table class="table">
        <tr class="text-center">
            <th>#</th>
            <th>Product SKU</th>
            <th>Product Name</th>
            <th>Product Supplier</th>
            <th>In Stock</th>
            <th>Need to restock Quantity</th>
            <th> Restock Budget</th>
        </tr>

        <?php
        $counter = '1';
        $bdgtmp = 0;
        foreach ($lowlist->result_array() as $list) : ?>
            <tr class="text-center">
                <td>
                    <?php echo $counter; ?>
                </td>
                <td>
                    <?php echo $list['prd_sku']; ?>
                </td>
                <td>
                    <?php echo $list['prd_name']; ?>
                </td>
                <td>
                    <?php echo $list['supplier_name']; ?>
                </td>
                <td>
                    <?php
                    if ($list['inv_qty'] < $list['inv_ideal_qty']) {
                        echo '<p class="text-danger">' . $list['inv_qty'] . '</p>';
                    } else {
                        echo '<p>' . $list['inv_qty'] . '</p>';
                    }
                    ?>

                </td>
                <td>
                    <?php $stckblc = ($list['inv_ideal_qty'] - $list['inv_qty']);

                    echo $stckblc;
                    ?>
                </td>
                <td>
                    <?php

                    $budget = $stckblc * ($list['prd_cost'] + ($list['prd_cost'] * $list['prd_taxes']));
                    $bdgtmp = $bdgtmp + $budget;
                    echo '<p> RM ' . number_format($budget, 2, '.', '') . '</p>';

                    ?>
                </td>
            </tr>
        <?php
            $counter++;
        endforeach; ?>
        <tr>
            <td colspan="6" class="text-right">
                <strong>TOTAL BUDGET</strong>
            </td>
            <td class="text-center">
                <?php echo '<p> RM ' . number_format($bdgtmp, 2, '.', '') . '</p>'; ?>

            </td>
        </tr>
    </table>
</div>
<div class="container ">
    <div class="row text-center">
        <div class="col">
            <h4>Store Analysis</h4>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="container" id="store-graph"></div>
    </div>
</div>
<?php

// foreach ($chart->result_array() as $test) {
//     echo '<br>' . $test['prd_sku'];
// }
?>
<script>
    Morris.Line({
        element: 'store-graph',
        data: <?= $chart; ?>,
        xkey: 'prd_name',
        ykeys: ['X', 'Y'],
        labels: ['Inventory Cost RM', 'Inventory Sell RM '],
        parseTime: false
        // hideHover: 'auto'
    });
</script>