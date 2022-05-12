<?php include_once("header.php"); ?>


<div class="page">

    <div class="page-heading">
        <h3><?php echo $lang->reports; ?></h3>
        <div class="report-search" style="text-align:center;">
            <form method="post">
                <input type="date" class="field" min="1997-01-01" max="<?php echo date('Y-m-d');?>" value="" style="width:auto;display:inline-block;" name="from">
                <span><?php echo "From"; ?></span>
                <input type="date" class="field" min="1997-01-01" max="<?php echo date('Y-m-d');?>" value="" style="width:auto;display:inline-block;" name="to">
                <span><?php echo "To"; ?></span>
                <input type="submit" class="btn btn-submit" style="width:auto;" name="submit" value="<?php echo $lang->submit;?>">
            </form>
        </div>
    </div>

    <div class="" style="width:100%;">
        <div id="chart"></div>
    </div>

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


<?php include_once("footer.php"); ?>
