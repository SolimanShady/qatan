<?php include_once("header.php"); ?>

<div class="page">

    <div class="page-heading">
        <h3><?php echo $lang->categories; ?></h3>
        <a href="javascript:void(0);" class="btn-new" onclick="modal_open();">
            <?php echo $lang->new." ".$lang->category;?>
            <i class="fa fa-plus"></i>
        </a>
    </div>

    <?php if (!empty($msg)): ?>
        <div class="info">
            <strong><?php echo $msg; ?></strong>
        </div>
    <?php endif; ?>

    <div class="snack-bar">
        <button type="button"
                onclick="deleteBox('<?php echo TABLE__CATEGORIES;?>');"
                name="button">
                <?php echo $lang->delete;?>
        </button>
    </div>

    <table>

        <tr>
            <th>
                <input type="checkbox"
                        class="checkbox"
                        onclick="(this.checked)
                        ? admin.check()
                        : admin.uncheck();">
            </th>
            <th>
                <?php echo $lang->name; ?>
            </th>
            <th>
                <?php echo $lang->image; ?>
            </th>
            <th>
                <?php echo $lang->cat_parent; ?>
            </th>
            <th>
                <?php echo $lang->no_products; ?>
            </th>
            <th>
                <?php echo $lang->status; ?>
            </th>
            <th>
                <?php echo $lang->actions; ?>
            </th>
        </tr>

        <?php foreach ($categories as $category): ?>

        <tr>
            <td>
                <input type="checkbox"
                        onclick="admin.checked(this);"
                        class="checkbox"
                        value="<?php echo $category->id;?>">
            </td>
            <td>
                <?php echo $category->title; ?>
            </td>
            <td>
                <img src="<?php echo href($category->image); ?>" style="height:50px;" alt="" />
            </td>
            <td>
                <?php echo getIdInfo(TABLE__CATEGORIES, ["id" => $category->parent_id])->title; ?>
            </td>
            <td>
                <?php echo $category->no_products; ?>
            </td>
            <?php
                $status = $lang->inactive;
                $color = "#c00;";
                if(1 == $category->status) {
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
                <a href="javascript:void(0);" data-id="<?php echo $category->id;?>" onclick="
                    modal_open($(this).data('id'));">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php echo $pagination; ?>
</div>

<div class="modal">
    <form method="post" enctype="multipart/form-data">
        <fieldset>
                <input type="text"
                class="field"
                id="category_name"
                name="category_name"
                placeholder="<?php echo $lang->title;?>" required>

        </fieldset>

        <fieldset>
            <label for=""><?php echo $lang->cat_parent; ?></label>
            <select id="sub_category" class="field" name="sub_category">
                <option>--<?php echo $lang->cat_parent;?>--</option>
                <?php buildCatTable(0); ?>
            </select>
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

        <label for="category_image"
            style="height:inherit;"
            id="category_image_label"
            class="upload_label">

            <?php echo $lang->upload." ";?>
            <i class="fas fa-cloud-upload-alt"></i>
        </label>

        <input type="file"
                onchange="openFile(event, '#category_image_label')"
                id="category_image"
                class="hidden field"
                name="image" accept="image/*">

        <fieldset>
                <label for=""><?php echo $lang->status; ?></label>
                <input type="checkbox" id="status"
                    name="status"
                    value="0"
                    onclick="(0 == this.value)
                    ? this.value=1
                    : this.value=0;">
        </fieldset>

        <fieldset>

                <input type="hidden" name="action" id="action" value="insert">
                <input type="hidden" name="category_id" id="category_id">
                <input type="hidden" name="category_image_path" id="category_image_path">
                <input type="hidden" name="table" id="table" value="<?php echo TABLE__CATEGORIES;?>">

                <button type="submit" class="btn btn-submit" name="submit">
                    <?php echo $lang->submit; ?>
                </button>

        </fieldset>
    </form>
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
        $('#category_id').val(id);
        $("#action").val("update");
        var id = $('#category_id').val();
        var table = $("#table").val();
        var config = {
            url: base_url+"/ajax/get_data_id?id="+id+"&table="+table,
            type: "GET",
            success: function(data) {

                var data = JSON.parse(data);

                if ( data ) {
                    
                    if (data.image) {
                        $(".upload_label").empty();
                        $("#category_image_path").val(data.image);
                        $(".upload_label")
                                    .append("<img style='height:70px;' src="+base_url+"/"+data.image+">");
                    }

                    $("#category_name").val(data.title);
                    $("#sub_category").val(data.parent_id);
                    if( 0 == data.parent_id ) {
                        //$('#sub_category').index(data.parent_id).remove();
                        //var index = $('#sub_category').selectedIndex;
                        //$('#sub_category option:eq(' + index + ')').empty();
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
            'category_id',
            'category_name',
            'category_image_path',
            'sub_category'
        ];
        var i = 0;
        var length = reset_arr.length;
        for (var i = 0; i < length; i++) {
            $("#"+reset_arr[i]).val("");
        }
        $("#action").val("insert");
        $(".upload_label").html(`<?php echo $lang->upload;?>
                        <i class="fas fa-cloud-upload-alt"></i>`);
        $("#action").val("insert");
        $("#status").val(0)
        .prop("checked", false);
    }
    $('.overlay, .modal').show();
}
</script>

<?php include_once("footer.php"); ?>
