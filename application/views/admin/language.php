<?php include("header.php"); ?>


<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->languages; ?></h3>
        <a href="javascript:void(0);" class="btn-new" onclick="modal_open();">
            <?php echo $lang->new." ".$lang->languages;?>
            <i class="fa fa-plus"></i>
        </a>
    </div>


    <?php if (!empty($msg)): ?>
        <div class="info">
            <strong><?php echo $msg; ?></strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <ul class="notify">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>


    <div class="snack-bar">
        <button type="button"
                onclick="deleteBox('<?php echo TABLE__LANGUAGES;?>');"
                name="button">
                <?php echo $lang->delete;?>
        </button>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>
                    <input type="checkbox"
                            onclick="(this.checked) ? admin.check() : admin.uncheck();">
                </th>
                <th>
                    <?php echo $lang->code; ?>
                </th>
                <th>
                    <?php echo $lang->name; ?>
                </th>
                <th>
                    <?php echo $lang->status; ?>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($languages as $language): ?>

                <tr>
                    <td>
                        <input type="checkbox"
                                onclick="admin.checked(this);"
                                class="checkbox"
                                value="<?php echo $language->id;?>">
                    </td>
                    <td>
                        <?php echo $language->code; ?>
                    </td>
                    <td>
                        <?php echo $language->name; ?>
                    </td>
                    <?php
                        $status = $lang->inactive;
                        $color = "#c00;";
                        if(1 == $language->status) {
                            $color = "#5CB85C;";
                            $status = $lang->active;
                        }
                    ?>
                    <td>
                        <span class="active" style="background:<?php echo $color;?>">
                            <?php echo $status; ?>
                        </span>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

    <?php echo $pagination; ?>


    <div class="modal">
        <form class="new" method="post" autocomplete="off" enctype="multipart/form-data">
            <fieldset>
                <p>
                    <label for="">
                        <?php echo $lang->code; ?>
                        <span class="required">*</span>
                    </label>
                    <input type="text" id="code" class="field" name="code" required>
                </p>
            </fieldset>
            <fieldset>
                <p>
                    <label for="">
                        <?php echo $lang->name; ?>
                        <span class="required">*</span>
                    </label>
                    <input type="text" id="name" class="field" name="name" required>
                </p>
            </fieldset>
            <fieldset>
                <p>
                    <span class="badge badge-danger"><?php echo $lang->note; ?></span>
                    <span style="color:#333;"><?php echo $lang->json_accepted;?></span>
                    <label for="lang_file" class="upload_label">
                        <?php echo $lang->upload." ".$lang->lang_file; ?>
                    </label>
                    <input type="file"
                        id="lang_file"
                        accept=".json"
                        onchange="$(this).prev().html(this.value);"
                        class="hidden field"
                        name="lang_file" required>
                    <a href="<?php echo href('admin/download')?>" id="download_sample">
                        <br>
                        <i class="fa fa-download"></i>
                        <?php echo $lang->sample;?>
                    </a>
                </p>
            </fieldset>
            <fieldset>
                <p>
                    <input type="submit"
                            class="btn btn-submit"
                            name="submit"
                            value="<?php echo $lang->submit;?>">
                </p>
            </fieldset>
        </form>
    </div>

</div>

<script type="text/javascript">
function modal_open() {
    $("#code").val("");
    $("#name").val("");
    $("#lang_file").val("");
    $(".upload_label").html("<?php echo $lang->upload." ".$lang->lang_file; ?>");
    $('.overlay, .modal').show();
}
</script>


<?php include("footer.php"); ?>
