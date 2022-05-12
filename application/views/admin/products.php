.<?php include_once("header.php"); ?>

<div class="page">

    <div class="page-heading">
        <h3><?php echo $lang->products; ?></h3>
        <a href="javascript:void(0);" class="btn-new" onclick="modal_open();">
            <?php echo $lang->new." ".$lang->products;?>
            <i class="fa fa-plus"></i>
        </a>
    </div>

    <div class="snack-bar">
        <button type="button"
                onclick="deleteBox('<?php echo TABLE__PRODUCTS;?>');"
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
                <?php echo $lang->product_id; ?>
            </th>
            <th>
                <?php echo $lang->title; ?>
            </th>
            <th>
                <?php echo $lang->image; ?>
            </th>
            <th>
                <?php echo $lang->category; ?>
            </th>
            <th>
                <?php echo $lang->stock; ?>
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
                <?php echo $lang->sale; ?>
            </th>
            <th>
                <?php echo $lang->status; ?>
            </th>
            <th>
                <?php echo $lang->created_at; ?>
            </th>
            <th>
                <?php echo $lang->actions; ?>
            </th>
        </tr>

        <?php foreach ($products as $product): ?>

            <tr>
                <td>
                    <input type="checkbox"
                            class="checkbox"
                            onclick="admin.checked(this);"
                            value="<?php echo $product->id;?>">
                </td>
                <td>
                    <?php echo $product->id; ?>
                </td>
                <td>
                    <?php echo $product->product_name; ?>
                </td>
                <td>
                    <img onclick="window.open(this.src, 'width=500,height=500', '_blank');"
                        style="cursor:pointer;height:50px;"
                        src="<?php echo href($product->product_image); ?>" alt="" />
                </td>
                <td>
                    <?php echo getIdInfo(TABLE__CATEGORIES,
                    ["id" => $product->category_id])->title; ?>
                </td>
                <td>
                    <?php echo $product->stock; ?>
                </td>
                <td>
                    <?php echo $product->size; ?>
                </td>
                <td>

                    <?php $colors_array = explode(",", $product->color); ?>

                    <?php if (is_array($colors_array)): ?>

                        <?php foreach ($colors_array as $color): ?>

                            <div class="circle" style="background:<?php echo $color;?>;"></div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="circle" style="background:<?php echo $product->color;?>;"></div>

                    <?php endif; ?>
                </td>
                <td>
                    <?php echo $product->price; ?>
                </td>
                <td>
                    <?php echo $product->sale; ?>
                </td>
                <?php
                    $status = $lang->inactive;
                    $color = "#c00;";
                    if(1 == $product->status) {
                        $color = "#5CB85C;";
                        $status = $lang->active;
                    }
                ?>
                <td>
                    <span class="active" style="background:<?php echo $color;?>">
                        <?php echo $status; ?>
                    </span>
                </td>
                <td>
                    <?php echo $product->created_at; ?>
                </td>
                <td>
                    <a href="javascript:void(0);" data-id="<?php echo $product->id;?>" onclick="
                        modal_open($(this).data('id'));">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
    <?php echo $pagination; ?>
</div>

<div class="modal" style="height:100%;">
    <form method="post" enctype="multipart/form-data">

        <fieldset>
            
            <label for="product_name"><?php echo $lang->product_name;?></label>
            <input type="text"
            class="field"
            id="product_name"
            name="product_name"
            value=""
            placeholder="<?php echo $lang->product_name;?>" required>
        </fieldset>

        <fieldset>
                <label for=""><?php echo $lang->product_desc;?></label>
                <textarea name="product_desc" id="editor" rows="8" cols="40"></textarea>
        </fieldset>

        <script>
          var openFile = function(event, target) {
              $(target).html("");
                var files = event.currentTarget.files;
                for (var i = 0; i < files.length; i++) { //for multiple files
                    (function(file) {
                        var name = file.name;
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            // get file content
                            var result = reader.result;
                            $(target).append("<img style='height:70px;' src="+result+">");
                        }
                        reader.readAsDataURL(file);
                    })(files[i]);
                }
          };
        </script>

        <fieldset>
            <label for="category"><?php echo $lang->category; ?></label>
            <select class="field" id="category" name="category" required>
                <option><?php echo "--".$lang->category."--";?></option>
                <?php buildCatTable(0); ?>
            </select>
        </fieldset>

        <fieldset>
            <label for="size"><?php echo $lang->size; ?></label>
            <select class="field" id="size" multiple="true" name="size[]">
                <option value="s">s</option>
                <option value="m">m</option>
                <option value="l">l</option>
                <option value="xl">xl</option>
                <option value="2xl">2xl</option>
                <option value="3xl">3xl</option>
                <option value="4xl">4xl</option>
            </select>
        </fieldset>

        <fieldset>
            <label for="color"><?php echo $lang->color; ?></label>
            <div class="colors">
                <input type="color" id="color" name="color[]">
            </div>
            <br>
            <a href="javascript:void(0);" style="font-weight:bold;padding:3px;background:#7BBB29;border-radius:3px;color:#fff;" onclick='$(".colors").append(
                $("<input>", {type: "color", id:"color", name: "color[]"}),
                $("<a>", {onclick:"$(this).prev().remove();$(this).remove();", style: "font-size:25px", color: "red", html: "&times;"}),
                )'>
                <?php echo $lang->add_new_color?>
            </a>
        </fieldset>

        <fieldset>
            <label for="price"><?php echo $lang->price; ?></label>
            <input type="number" class="field" name="price" id="price" placeholder="<?php echo $lang->price;?>" required>
            <label for="sale"><?php echo $lang->sale; ?></label>
            <input type="number" class="field" name="sale" id="sale" placeholder="<?php echo $lang->sale;?>">
        </fieldset>

        <fieldset>
            <label for="stock"><?php echo $lang->stock; ?></label>
            <input type="number" class="field" id="stock" name="stock" placeholder="<?php echo $lang->stock;?>" required>
        </fieldset>

        <fieldset>

            <label for="product_image"
                style="height:inherit;"
                id="product_image_label"
                class="upload_label">

                <?php echo $lang->default_product_image." ";?>
                <i class="fas fa-cloud-upload-alt"></i>
            </label>

            <input type="file"
                    onchange="openFile(event, '#product_image_label')"
                    id="product_image"
                    onchange="$(this).prev().append(this.value);"
                    class="hidden field"
                    name="product_image" accept="image/*">

        </fieldset>

        <fieldset>

            <label for="product_images"
                style="height:inherit;"
                id="product_images_label"
                class="upload_label">
                <?php echo $lang->product_images." ";?>
                <i class="fas fa-cloud-upload-alt"></i>
            </label>

            <input type="file"
                    onchange="openFile(event, '#product_images_label')"
                    id="product_images"
                    onchange="$(this).prev().append(this.value);"
                    class="hidden field"
                    name="product_images[]" accept="image/*" multiple="true">

        </fieldset>

        <fieldset>
            <label for=""><?php echo $lang->active; ?></label>
            <input type="checkbox" id="status"
                name="status"
                value="0"
                onclick="(0 == this.value)
                ? this.value=1
                : this.value=0;">
        </fieldset>

        <!--hidden fields start-->
        <fieldset>
            <input type="hidden" name="action" id="action" value="insert">
            <input type="hidden" name="product_id" id="product_id">
            <input type="hidden" name="product_image_default_path" id="product_image_default_path">
            <input type="hidden" name="product_images_path" id="product_images_path">
            <input type="hidden" name="table" id="table" value="<?php echo TABLE__PRODUCTS;?>">
            <button type="submit" class="btn btn-submit" name="submit">
                <?php echo $lang->submit; ?>
            </button>
        </fieldset>
        <!--hidden fields end-->

    </form>
</div>

<script type="text/javascript">
CKEDITOR.replace('editor', {
  language: 'en'
});

$('option').mousedown(function(e) {
    e.preventDefault();
    $(this).prop('selected', !$(this).prop('selected'));
    return false;
});

function modal_open(id)
{
    var id = id || 0;
    if( parseInt(id) > 0 ) {

        $('#product_id').val(id);
        $("#action").val("update");
        var id = $('#product_id').val();
        var table = $("#table").val();

        var config = {
            url: base_url+"/ajax/get_data_id?id="+id+"&table="+table,
            type: "GET",
            success: function(data) {

                var data = JSON.parse(data);

                if( data ) {

                    $(".colors").empty();
                    $("#product_name").val(data.product_name);
                    $(".cke_wysiwyg_frame").contents()
                    .find("html body")
                    .html(data.product_description);
                    $("#size").val((data.size).split(","));
                    $("#sale").val(data.sale);
                    $("#stock").val(data.stock);
                    $("#price").val(data.price);
                    $("#category").val(data.category_id);

                    if( data.color ) {
                        var colors = data.color.split(",");
                        var length = colors.length;
                        for (var i = 0; i < length; i++) {
                            $(".colors").append("<input type='color' value="+colors[i]+" id='color' name='color[]'><a href='javascript:void(0);' onclick='$(this).prev().remove();$(this).remove();'>X</a>");
                        }
                    }

                    if( data.path ) {
                        $("#product_images_label").empty();
                        $("#product_images_path").val(data.path);
                        var images = data.path.split(",");
                        var length = images.length;
                        for (var i = 0; i < length; i++) {
                            $("#product_images_label")
                            .append("<img style='height:70px;' src="+base_url+"/"+images[i]+">");

                        }
                    }

                    if ( data.product_image ) {
                        $("#product_image_label").empty();
                        $("#product_image_default_path").val(data.product_image);
                        $("#product_image_label")
                                    .append("<img style='height:70px;' src="+base_url+"/"+data.product_image+">");

                    }
                    if(1 == data.status) {
                        $("#status").val(data.status)
                        .prop("checked", 1);
                    }
                }
            }
        }
        $.ajax(config)
    } else {
        var reset_arr = [
            "product_id",
            "product_name",
            "product_images_path",
            "price",
            "sale",
            "stock",
            "size"
        ];
        var i = 0;
        var length = reset_arr.length;
        for (var i = 0; i < length; i++) {
            $("#"+reset_arr[i]).val("");
        }
        $("#action").val("insert");
        $(".colors").empty().append("<input type='color' id='color' name='color[]'>");
        $("#product_images_label").html(`<?php echo $lang->product_images;?>
                                <i class="fas fa-cloud-upload-alt"></i>`);
        $("#product_image_label").html(`<?php echo $lang->default_product_image;?>
                                <i class="fas fa-cloud-upload-alt"></i>`);

        $(".cke_wysiwyg_frame").contents()
        .find("html body").html("");
        $("#status").val(0)
        .prop("checked", false);
    }
    $('.overlay, .modal').show();
}
</script>

<?php include_once("footer.php") ?>
