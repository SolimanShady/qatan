<?php include_once("header.php"); ?>

<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->customers; ?></h3>
    </div>

    <div class="snack-bar">
        <button type="button"
                onclick="deleteBox('<?php echo TABLE__CUSTOMERS;?>');"
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
                <?php echo $lang->username; ?>
            </th>
            <th>
                <?php echo $lang->image; ?>
            </th>
            <th>
                <?php echo $lang->phone; ?>
            </th>
            <th>
                <?php echo $lang->city; ?>
            </th>
            <th>
                <?php echo $lang->no_orders; ?>
            </th>
            <th>
                <?php echo $lang->verified; ?>
            </th>
            <th><?php echo $lang->created_at;?></th>
            <th>
                <?php echo $lang->actions; ?>
            </th>
        </tr>

        <?php foreach ($customers as $customer): ?>

            <tr>
                <td>
                    <input type="checkbox"
                            onclick="admin.checked(this);"
                            class="checkbox"
                            value="<?php echo $customer->id;?>">
                </td>
                <td>
                    <?php echo $customer->username; ?>
                </td>
                <td>
                    <img src="<?php echo href($customer->profile);?>" style="height:50px;" alt="" />
                </td>
                <td>
                    <?php echo $customer->phone; ?>
                </td>
                <td>
                    <?php echo $customer->city; ?>
                </td>
                <td>
                    <?php echo $customer->no_sales; ?>
                </td>
                <?php
                    $status = '<i class="fas fa-times-circle"></i>';
                    $color = "#c00;";
                    if(1 == $customer->verified) {
                        $color = "#5CB85C;";
                        $status = '<i class="fas fa-check"></i>';
                    }
                ?>
                <td>
                    <span class="active" style="background:<?php echo $color;?>">
                        <?php echo $status; ?>
                    </span>
                </td>
                <td><?php echo $customer->created_at;?></td>
                <td>
                    <a href="javascript:void(0);" data-id="<?php echo $customer->id;?>" onclick="
                        modal_open($(this).data('id'));">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>
    <?php echo $pagination; ?>

</div>

<div class="modal" style="width:50%;height:100%;">
    <form method="post">

         <fieldset style="text-align:center;">
            <p>
                <label for=""><?php echo $lang->profile;?></label>
                <img id="profile" alt="" style="width:86px;height:86px;border-radius:100%;border:1px solid #ccc;">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for=""><?php echo $lang->username;?></label>
                <input type="text" class="field" id="username" name="username" placeholder="<?php echo $lang->username;?>">
            </p>
            <p>
                <label for=""><?php echo $lang->email;?></label>
                <input type="text" class="field" id="email" name="email" placeholder="<?php echo $lang->email;?>">
            </p>
            <p>
                <label for=""><?php echo $lang->phone;?></label>
                <input type="text" class="field" id="phone" name="phone" placeholder="<?php echo $lang->phone;?>">
            </p>
            <p>
                <label for=""><?php echo $lang->country;?></label>
                <input type="text" class="field" id="country" name="country" placeholder="<?php echo $lang->country;?>">
            </p>
            <p>
                <label for=""><?php echo $lang->city;?></label>
                <input type="text" class="field" id="city" name="city" placeholder="<?php echo $lang->city;?>">
            </p>
            <p>
                <label for=""><?php echo $lang->region;?></label>
                <input type="text" class="field" id="region" name="region" placeholder="<?php echo $lang->region;?>">
            </p>
            <p>
                <label for=""><?php echo $lang->location;?></label>
                <input type="text" class="field" id="location" name="location" placeholder="<?php echo $lang->location;?>">
            </p>
        </fieldset>
            <input type="hidden" name="table" id="table" value="<?php echo TABLE__CUSTOMERS;?>">
            <input type="hidden" name="user_id" id="user_id">
        </fieldset>

    </form>
</div>

<script type="text/javascript">

function modal_open(id)
{
    var id = id || 0;
    if( parseInt(id) > 0 ) {

        $('#user_id').val(id);
        var id = $('#user_id').val();
        var table = $("#table").val();

        var config = {
            url: base_url+"/ajax/get_data_id?id="+id+"&table="+table,
            type: "GET",
            success: function(data) {

                var data = JSON.parse(data);

                if ( data ) {
                    $("#profile").attr("src", base_url+"/"+data.profile);
                    $("#username").val(data.username);
                    $("#email").val(data.email);
                    $("#phone").val(data.phone);
                    $("#country").val(data.country);
                    $("#city").val(data.city);
                    $("#region").val(data.region);
                    $("#location").val(data.location);
                }
            }
        }
        $.ajax(config)

    }

    $(".overlay,.modal").show();
}

</script>

<?php include_once("footer.php"); ?>
