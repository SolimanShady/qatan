<?php
include_once("header.php");
?>

<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->coupons; ?></h3>
        <!--
        <a href="javascript:void(0);" class="btn-new" onclick="modal_open();">
            <?php echo $lang->new." ".$lang->coupons;?>
            <i class="fa fa-plus"></i>
        </a>
    -->
    </div>
    <?php if (!empty($msg)): ?>
        <div class="info">
            <strong><?php echo $msg; ?></strong>
        </div>
    <?php endif; ?>

    <div class="snack-bar">
        <button type="button"
                onclick="deleteBox('<?php echo TABLE_COUPONS;?>');"
                name="button">
                <?php echo $lang->delete;?>
        </button>
    </div>


    <table class="data-table">
        <thead>
            <tr>
                <th>
                    <input type="checkbox"
                            onclick="(this.checked)
                            ? admin.check()
                            : admin.uncheck();">
                </th>
                <th>
                    <?php echo $lang->product_name; ?>
                </th>
                <th>
                    <?php echo $lang->code; ?>
                </th>
                <th>
                    <?php echo $lang->discount; ?>
                </th>
                <th>
                    <?php echo $lang->valid_from; ?>
                </th>
                <th>
                    <?php echo $lang->valid_to; ?>
                </th>
                <th>
                    <?php echo $lang->limit; ?>
                </th>
                <th>
                    <?php echo $lang->used; ?>
                </th>
                <th>
                    <?php echo $lang->created_at; ?>
                </th>
                <th>
                    <?php echo $lang->updated_at; ?>
                </th>
                <th>
                    <?php echo $lang->actions; ?>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($coupons as $coupon): ?>
                <tr>
                    <td>
                        <input type="checkbox"
                                onclick="admin.checked(this);"
                                class="checkbox"
                                value="<?php echo $coupon->id;?>">
                    </td>
                    <td>
                        <?php echo $coupon->product_name; ?>
                    </td>
                    <td>
                        <?php echo $coupon->code; ?>
                    </td>
                    <td>
                        <?php echo $coupon->discount; ?>
                    </td>
                    <td>
                        <?php echo $coupon->valid_from; ?>
                    </td>
                    <td>
                        <?php echo $coupon->valid_to; ?>
                    </td>
                    <td>
                        <?php echo $coupon->limited; ?>
                    </td>
                    <td>
                        <?php echo $coupon->used; ?>
                    </td>
                    <td>
                        <?php echo $coupon->created_at; ?>
                    </td>
                    <td>
                        <?php echo $coupon->updated_at; ?>
                    </td>
                    <td>
                        <a href="javascript:void(0);" data-id="<?php echo $coupon->id;?>" onclick="modal_open($(this).data('id'));">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <?php echo $pagination; ?>

    <!-- Popup start -->
    <div class="modal">
        <form method="post">
            <fieldset>
                <input type="text" class="field" id="coupon_code" name="coupon_code" disabled>
            </fieldset>
            <fieldset>
                <label for="discount"><?php echo $lang->discount; ?></label>
                    <input type="text"
                    class="field"
                    id="discount"
                    name="discount"
                    placeholder="<?php echo $lang->discount;?>">
            </fieldset>

            <fieldset>

                <label for=""><?php echo $lang->valid_from;?></label>
                <input type="date"
                class="field"
                id="valid_from"
                name="valid_from"
                required>

                <label for=""><?php echo $lang->valid_to;?></label>
                <input type="date"
                class="field"
                id="valid_to"
                name="valid_to"
                placeholder="<?php echo $lang->valid_to;?>"
                required>

            </fieldset>

            <fieldset>
                <label for="limited"><?php echo $lang->limit; ?></label>
                <input type="number"
                class="field"
                min="1"
                max="100"
                id="limited"
                name="limited"
                placeholder="<?php echo $lang->limit;?>">

            </fieldset>

            <fieldset>


                    <input type="hidden" name="voucher_id" value="<?php echo $_SESSION["id"];?>">
                    <input type="hidden" name="action" id="action" value="insert">
                    <input type="hidden" name="coupon_id" id="coupon_id">
                    <input type="hidden" name="table" id="table" value="<?php echo TABLE_COUPONS;?>">

                    <button type="submit" class="btn btn-submit" name="submit">
                        <?php echo $lang->submit; ?>
                    </button>

            </fieldset>
        </form>
    </div>
    <!-- End popup -->
</div>
<script type="text/javascript">
function replace_space(input)
{
    input.value = input.value.replace(/\s/g, '-');
}
function modal_open(id)
{
    var id = id || 0;
    if( parseInt(id) > 0 ) {
        $('#coupon_id').val(id);
        $("#action").val("update");
        var id = $('#coupon_id').val();
        var table = $("#table").val();
        var config = {
            url: base_url+"/ajax/get_data_id?id="+id+"&table="+table,
            type: "GET",
            success: function(data) {

                var data = JSON.parse(data);
                $("#product_name").val(data.product_name);
                $("#editor").html(data.product_desc);
                $("#coupon_code").val(data.code);
                $("#discount").val(data.discount);
                $("#limited").val(data.limited);
                $("#valid_from").val(data.valid_from);
                $("#valid_to").val(data.valid_to);
                $(".cke_wysiwyg_frame").contents()
                .find("html body")
                .html(data.product_desc);

                if(1 == data.status) {
                    $("#active").val(data.status)
                    .prop("checked", 1);
                }
            }
        }
        $.ajax(config)
    } else {
        $("#action").val("insert");
        $("#coupon_code").val("");
        $("#discount").val("");
        $("#limited").val("");
        $("#valid_from").val(data.valid_from);
        $("#valid_to").val(data.valid_to);
        $(".cke_wysiwyg_frame").contents()
        .find("html body").html("");
        $("#active").val(0)
        .prop("checked", false);
    }
    $('.overlay, .popup').show();
}
</script>

<?php include_once("footer.php"); ?>
