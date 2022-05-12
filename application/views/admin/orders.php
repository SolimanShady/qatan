<?php include_once("header.php"); ?>

<div class="page">

    <div class="page-heading">
        <h3><?php echo $lang->orders; ?></h3>
    </div>

    <div class="snack-bar">
        <button type="button"
                onclick="deleteBox('<?php echo TABLE__ORDERS;?>');"
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
                <?php echo $lang->notes; ?>
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
                <input type="checkbox"
                        onclick="admin.checked(this);"
                        class="checkbox"
                        value="<?php echo $order->id;?>">
            </td>
            <td>
                <div style="display:inline;background:#333;color:#fff;padding:3px;border-radius:5px;">
                    <strong><?php echo $order->id; ?></strong>
                </div>
            </td>

            <td>
                <?php echo getIdInfo(TABLE__CUSTOMERS, 
                ["id" => $order->customer_id])->username; ?>
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
                    case 5:{
                        $status = $lang->completed; $color_id="completed";
                        break;
                    }
                    
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
                <?php echo $order->notes; ?>
            </td>
            <td>
                <?php echo $order->created_at; ?>
            </td>
            <td>
                <a href="<?php echo href('admin/order_details/'.$order->id.'');?>" title="<?php echo $lang->order_details;?>">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="javascript:void(0);" 
                    data-id="<?php echo $order->id;?>" 
                    onclick="modal_open($(this).data('id'));">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $pagination; ?>
</div>


<div class="modal">
    <div class="page-heading">
        <h3><?php echo $lang->order_status; ?></h3>
    </div>
    <form method="post" style="width:200px;">

        <fieldset>
            <select class="field" id="paid" name="paid" required="requried">
                <option>--<?php echo $lang->paid; ?>--</option>
                <option value="0"><?php echo $lang->unpaid; ?></option>
                <option value="1"><?php echo $lang->paid; ?></option>
            </select>
        </fieldset>

        <fieldset>
            <select class="field" id="order_status" name="order_status" required="requried">
                <option>--<?php echo $lang->order_status; ?>--</option>
                <option value="0"><?php echo $lang->pending; ?></option>
                <option value="2"><?php echo $lang->cancelled; ?></option>
                <option value="3"><?php echo $lang->shipped; ?></option>
                <option value="4"><?php echo $lang->returned; ?></option>
                <option value="5"><?php echo $lang->completed; ?></option>
            </select>
        </fieldset>

        <fieldset>
            <input type="hidden" name="action" id="action" value="insert">
            <input type="hidden" name="order_id" id="order_id">
            <input type="hidden" name="customer_id" id="customer_id">
            <input type="hidden" name="total" id="total">
            <input type="hidden" name="table" id="table" value="<?php echo TABLE__ORDERS;?>">
            <button type="submit" class="btn btn-submit" name="submit">
                <?php echo $lang->submit; ?>
            </button>
        </fieldset>
    </form>

</div>

<script type="text/javascript">
function modal_open(id)
{
    var id = id || 0;
    if( parseInt(id) > 0 ) {
        $('#order_id').val(id);
        $("#action").val("update");
        var id = $('#order_id').val();
        var table = $("#table").val();
        var config = {
            url: base_url+"/ajax/get_data_id?id="+id+"&table="+table,
            type: "GET",
            success: function(data) {
                    var data = JSON.parse(data);
                    if (data) {
                        $("#paid").val(data.paid);
                        $("#total").val(data.total);
                        $("#order_status").val(data.order_status);
                        $("#customer_id").val(data.customer_id);
                    }
                }
            }
            $.ajax(config)
    } else {
        $("#action").val("insert");
    }
    $('.overlay, .modal').show();
}

</script>

<?php include_once("footer.php"); ?>
