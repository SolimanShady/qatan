<?php include_once("header.php"); ?>

<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->logs; ?></h3>

    </div>

    <div class="snack-bar">
        <button type="button"
                onclick="deleteBox('<?php echo TABLE__LOGS;?>');"
                name="buttona">
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
                    <?php echo $lang->activity; ?>
                </th>

                <th>
                    <?php echo $lang->username; ?>
                </th>
                <th>
                    <?php echo $lang->ip; ?>
                </th>
                <th>
                    <?php echo $lang->country;?>
                </th>
                <th>
                    <?php echo $lang->flag;?>
                </th>
                <th>
                    <?php echo $lang->browser; ?>
                </th>
                <th>
                    <?php echo $lang->created_at; ?>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($logs as $log): ?>
                <tr>
                    <td>
                        <input type="checkbox"
                                onclick="admin.checked(this);"
                                class="checkbox"
                                value="<?php echo $log->id;?>">
                    </td>
                    <td>
                        <?php echo $log->activity_name; ?>
                    </td>
                    <td>
                        <?php echo $log->username; ?>
                    </td>

                    <td>
                        <?php echo $log->ip; ?>
                    </td>
                    <td>
                        <?php echo $log->country;?>
                    </td>
                    <td>
                        <img src="<?php echo href('images/blank.gif');?>" 
                        class="flag flag-<?php echo strtolower($log->countryCode);?>"
                    </td>
                    <td>
                        <?php echo $log->browser; ?>
                    </td>
                    <td>
                        <?php echo $log->created_at; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <?php echo $pagination; ?>


</div>

<?php include_once("footer.php"); ?>
