<?php include("header.php"); ?>

<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->dashboard;?></h3>
    </div>

    <ul class="statics" style="padding:10px;">

        <!-- Start vendors total -->
        <li style="background:#368ee0;">
            <h1>
                <i class="fa fa-users"></i>
            </h1>
            <b><?php echo $total_customers;?></b>
            <h4>
                <a href="<?php echo href("admin/customers");?>"><?php echo $lang->customers; ?></a>
            </h4>
        </li>

        <!-- End vendors total-->

        <!--
        <li style="background:#94bfac;">
            <h1>
                <i class="fa fa-list"></i>
            </h1>
            <b>6</b>
            <h4>
                <a href="<?php echo href("admmin/categories");?>">
                    <?php echo $lang->categories; ?>
                </a>
            </h4>
        </li>
        -->

        <li style="background: orange">
            <h1>
                <i class="fas fa-tshirt"></i>
            </h1>
            <b><?php echo $total_products;?></b>
            <h4>
                <a href="<?php echo href("admin/products");?>">
                    <?php echo $lang->products; ?>
                </a>
            </h4>
        </li>

        <li style="background:#553D7B;color:#fff;">
            <h1>
                <i class="fa fa-shopping-cart"></i>
            </h1>
            <b><?php echo $total_orders;?></b>
            <h4>
                <a href="<?php echo href("admin/orders");?>">
                    <?php echo $lang->orders; ?>
                </a>
            </h4>
        </li>

        <li style="background:#94bfac;">
            <h1>
                <i class="fas fa-money-bill-alt"></i>
            </h1>
            <b><?php echo $total_sales; ?></b>
            <h4>
                <a href="javascript:void(0)">
                    <?php echo $lang->sales; ?>
                </a>
            </h4>
        </li>

    </ul>

    <div class="page-heading">
        <h3><?php echo $lang->statics; ?></h3>
    </div>
    <div class="" style="width:100%;">
        <div id="chart"></div>
    </div>

    <div class="page-heading">
        <h3><?php echo $lang->last_orders; ?></h3>
    </div>
    <table>
        <tr>
            <th>
                <?php echo $lang->order_number; ?>
            </th>
            <th>
                <?php echo $lang->customer; ?>
            </th>
            <th>
                <?php echo $lang->order_status; ?>
            </th>
            <th>
                <?php echo $lang->payment_method; ?>
            </th>
            <th>
                <?php echo $lang->paid; ?>
            </th>
            <th>
                <?php echo $lang->total; ?>
            </th>
            <th>
                <?php echo $lang->created_at; ?>
            </th>
            <th>
                <?php echo $lang->actions; ?>
            </th>
        </tr>

        <?php foreach ($orders as $order): ?>

        <tr>
            <td>
                <div style="display:inline;background:#333;color:#fff;padding:3px;border-radius:5px;">
                    <strong><?php echo $order->id; ?></strong>
                </div>
            </td>

            <td>
                <?php echo getIdInfo(TABLE__CUSTOMERS, ["id" => $order->customer_id])->username; ?>
            </td>

            <td>

                <?php
                $status = $lang->pending;
                $color_id = "";
                switch ($order->order_status) {
                    case 0:{ $status = $lang->pending; $color_id="pending"; break;}
                    case 1:{ $status = $lang->waiting; $color_id="waiting"; break;}
                    case 2:{ $status = $lang->cancelled; $color_id="cancelled"; break;}
                    case 3:{ $status = $lang->shipped; $color_id="shipped"; break;}
                    case 4:{ $status = $lang->returned; $color_id="returned"; break;}
                    case 5:{ $status = $lang->completed; $color_id="completed"; break;}
                    default:{$status = $lang->pending; $color_id="pending"; break;}
                }
                ?>

                <span class="order-status" id="<?php echo $color_id;?>">
                    <?php echo $status; ?>
                </span>

            </td>

            <td>
                <?php echo $order->payment_method; ?>
            </td>
            <td>
                <?php if ( 1 == $order->paid ): ?>
                    <span class="active"><?php echo $lang->paid; ?></span>
                <?php else: ?>
                    <span class="active" style="background:#c00;"><?php echo $lang->unpaid; ?></span>
                <?php endif; ?>
            </td>
            <td>
                <?php echo $order->total; ?>
            </td>
            <td>
                <?php echo $order->created_at; ?>
            </td>
            <td>
                <a href="<?php echo href('admin/order_details/'.$order->id.'');?>" title="<?php echo $lang->order_details;?>">
                    <i class="fas fa-eye"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php
$days = array();
$total = array();
foreach ($sales as $sale) {
    $days[] = $sale->date;
    $total[] = $sale->total;
}
?>
<script>
    var days = ('<?php echo json_encode(["days" => $days]);?>')
    days = JSON.parse(days).days;
    var data = [{
        "name": "sales",
        "data": [<?php echo implode(",", $total);?>]
    }]
    createChart();
    // Create the chart.
    function createChart() {

        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },

            xAxis: {
                categories: days
            },

            title: {
                text: "<?php echo $lang->sales_chart;?>"
            },

            series: data,

            colors: ['#28CB98', '#008CEB', '#c00', '#28CB98'],

            tooltip: {
                animation: true,
            }
        });
    }

</script>
<?php include("footer.php"); ?>
