<?php include_once("header.php"); ?>

<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->media; ?></h3>
    </div>

    <div class="snack-bar">
        <button type="button"
                onclick="deleteBox('<?php echo TABLE__PRODUCTS__IMAGES;?>');"
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
                    <?php echo $lang->media; ?>
                </th>

                <th>
                    <?php echo $lang->created_at; ?>
                </th>
                <th>
                    <?php echo $lang->updated_at; ?>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($images as $image): ?>
                <tr>

                    <td>
                        <input type="checkbox"
                                onclick="admin.checked(this);"
                                class="checkbox"
                                value="<?php echo $image->id;?>">
                    </td>

                    <td>
                        <?php echo $image->product_name; ?>
                    </td>

                    <td>
                        <!-- Product images start -->
                        <?php $imgs = explode(",", $image->path);?>
                        <?php foreach ($imgs as $img): ?>
                            <img onclick="window.open(this.src, 'width=500,height=500', '_blank');"
                                style="cursor:pointer;height:50px;"
                                src="<?php echo href($img); ?>" alt="" />
                        <?php endforeach; ?>
                        <!-- End product images -->
                    </td>

                    <td>
                        <?php echo $image->created_at; ?>
                    </td>

                    <td>
                        <?php echo $image->updated_at; ?>
                    </td>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <?php echo $pagination; ?>

</div>

<?php include_once("footer.php"); ?>
