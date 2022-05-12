<?php include_once("header.php"); ?>

<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->order_details; ?></h3>
    </div>

    <table>
        <tr>
            <th>
                <?php echo $lang->order_id; ?>
            </th>
            <th>
                <?php echo $lang->customer; ?>
            </th>
            <th>
                <?php echo $lang->image; ?>
            </th>
            <th>
                <?php echo $lang->products; ?>
            </th>
            <th>
                <?php echo $lang->size; ?>
            </th>
            <th>
                <?php echo $lang->color; ?>
            </th>
            <th>
                <?php echo $lang->price; ?>
            </th>
            <th>
                <?php echo $lang->quantity; ?>
            </th>
            <th>
                <?php echo $lang->total; ?>
            </th>
            <th>
                <?php echo $lang->created_at; ?>
            </th>
        </tr>
        <?php foreach($orders as $order): ?>
            <tr>
                <td>
                    <?php echo $order->order_id; ?>
                </td>
                <td>
                    <?php echo getIdInfo(TABLE__CUSTOMERS,
                    ["id" => $order->customer_id])->username; ?>
                </td>
                <td>
                    <?php $image =  getIdInfo(TABLE__PRODUCTS,
                    ["id" => $order->product_id])->product_image; ?>
                    <img src="<?php echo href($image);?>" height="50" alt="" />
                </td>
                <td>
                    <?php echo getIdInfo(TABLE__PRODUCTS,
                    ["id" => $order->product_id])->product_name; ?>
                </td>
                <td>
                    <?php echo $order->size; ?>
                </td>
                <td>
                    <div class="circle" style="background:<?php echo $order->color;?>;"></div>
                </td>
                <td>
                    <?php echo $order->price; ?>
                </td>
                <td>
                    <?php echo $order->quantity; ?>
                </td>
                <td>
                    <?php echo $order->total; ?>
                </td>
                <td>
                    <?php echo $order->created_at; ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>

</div>

<?php include_once("footer.php"); ?>
