<?php include_once("header.php"); ?>

<div class="page">

    <div class="page-heading">
        <h3><?php echo $lang->payments; ?></h3>
    </div>

    <div class="snack-bar">
        <button type="button"
                onclick="deleteBox('<?php echo TABLE__PAYMENTS;?>');"
                name="button">
                <?php echo $lang->delete;?>
        </button>
    </div>

    <table>

        <tr>
            <th>
                <input type="checkbox"
                        onclick="(this.checked)
                        ? admin.check()
                        : admin.uncheck();">
            </th>
            <th>
                <?php echo $lang->order_number; ?>
            </th>
            <th>
                <?php echo $lang->customer; ?>
            </th>
            <th>
                <?php echo $lang->transaction_id; ?>
            </th>
            <th>
                <?php echo $lang->card_type; ?>
            </th>
            <th>
                <?php echo $lang->payment_status; ?>
            </th>
            <th>
                <?php echo $lang->total; ?>
            </th>
            <th>
                <?php echo $lang->created_at; ?>
            </th>
            <!--
            <th>
                <?php echo $lang->actions; ?>
            </th>
            -->
        </tr>

        <?php foreach ($payments as $payment): ?>

        <tr>
            <td>
                <input type="checkbox"
                        onclick="admin.checked(this);"
                        class="checkbox"
                        value="<?php echo $payment->id;?>">
            </td>
            <td>
                <?php echo $payment->order_id; ?>
            </td>
            <td>
                <?php echo getIdInfo(TABLE__CUSTOMERS, ["id" => $payment->customer_id])->username; ?>
            </td>
            <td>
                <?php echo $payment->transaction_id; ?>
            </td>
            <td>
                <?php if("N/A" == $payment->card_type):?>
                    <?php echo $lang->cash;?>
                <?php else:?>
                    <img src="<?php echo href('images/cards/'.$payment->card_type.'.png');?>" alt="">
                <?php endif; ?>
            </td>
            <?php
                $status = '<i class="fas fa-times-circle"></i>';
                $color = "#c00;";
                if('succeeded' == $payment->payment_status) {
                    $color = "#5CB85C;";
                    $status = '<i class="fas fa-check"></i>';
                }
            ?>
            <td>
                <span class="active" style="background:<?php echo $color;?>">
                    <?php echo $status; ?>
                </span>
            </td>
            <td>
                <?php echo $payment->total; ?>
            </td>
            <td>
                <?php echo $payment->created_at; ?>
            </td>
            <!--
            <td>
                <a href="">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="javascript:void(0);" data-id="<?php echo $category->id;?>" onclick="
                    modal_open($(this).data('id'));">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
            -->
        </tr>

        <?php endforeach; ?>
    </table>
    <?php echo $pagination; ?>
</div>

<?php include_once("footer.php"); ?>
