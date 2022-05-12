<thead>
    <tr>
        <th>
            <input type="checkbox"
                    onclick="(this.checked)
                    ? admin.check()
                    : admin.uncheck();">
        </th>
        <th>
            <?php echo $lang->menu_name; ?>
        </th>
        <th>
            <?php echo $lang->menu_url; ?>
        </th>
        <th>
            <?php echo $lang->menu_order; ?>
        </th>
        <th>
            <?php echo $lang->menu_header; ?>
        </th>
        <th>
            <?php echo $lang->menu_footer; ?>
        </th>
        <th>
            <?php echo $lang->active; ?>
        </th>
        <th>
            <?php echo $lang->actions; ?>
        </th>
    </tr>
</thead>
<tbody>

    <?php foreach ($menus as $menu): ?>
        <tr>
            <td>
                <input type="checkbox"
                        onclick="admin.checked(this);"
                        class="checkbox"
                        value="<?php echo $menu->id;?>">
            </td>
            <td>
                <?php echo $menu->menu_name; ?>
            </td>
            <td>
                <a href="<?php echo $menu->menu_url; ?>">
                    <?php echo $menu->menu_url; ?>
                    <i style="color:#064685;" class="fa fa-external-link-alt"></i>
                </a>
            </td>
            <td>
                <?php echo $menu->menu_order; ?>
            </td>
            <?php
                $status = $lang->inactive;
                $color = "#c00;";
                if(1 == $menu->menu_status) {
                    $color = "#5CB85C;";
                    $status = $lang->active;
                }
            ?>
            <td>
                <?php echo $menu->menu_header; ?>
            </td>
            <td>
                <?php echo $menu->menu_footer; ?>
            </td>
            <td>
                <span class="active" style="background:<?php echo $color;?>">
                    <?php echo $status; ?>
                </span>
            </td>
            <td>
                <a href="javascript:void(0);"
                    data-id="<?php echo $menu->id;?>"
                    onclick="modal_open($(this).data('id'));">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</tbody>
<script type="text/javascript">
$('.pagination').html('<?php echo $pagination; ?>');
</script>
