<?php include_once("header.php"); ?>

<div class="page">

    <div class="page-heading">
        <h3><?php echo $lang->smtp; ?></h3>
    </div>

    <?php if (!empty($msg)): ?>
        <div class="info">
            <strong><?php echo $msg; ?></strong>
        </div>
    <?php endif; ?>

    <div class="">
        <form method="post">
            <fieldset>
                <label for=""><?php echo $lang->smtp_sever; ?></label>
                <input type="text" class="field" name="smtp_server" value="<?php echo $smtp->smtp_server;?>" required>
            </fieldset>

            <fieldset>
                <label for=""><?php echo $lang->smtp_username; ?></label>
                <input type="text" class="field" name="smtp_username" value="<?php echo $smtp->smtp_username;?>" required>
            </fieldset>

            <fieldset>
                <label for=""><?php echo $lang->smtp_password; ?></label>
                <input type="password" class="field" name="smtp_password" value="<?php echo $smtp->smtp_password;?>" required>
            </fieldset>

            <fieldset>
                <label for=""><?php echo $lang->smtp_port; ?></label>
                <input type="text" class="field" name="smtp_port" value="<?php echo $smtp->smtp_port;?>" required>
            </fieldset>

            <fieldset>
                <label for=""><?php echo $lang->smtp_secure; ?></label>
                <select class="field" id="smtp_secure" name="smtp_secure" required>
                    <option value="tls">tls</option>
                    <option value="ssl">ssl</option>
                </select>
            </fieldset>

            <script type="text/javascript">
            (function(){
                var select = document.querySelector("#smtp_secure");
                for (i=0;i<select.length;i++) {
                    if (select.options[i].value == '<?php echo $smtp->smtp_secure;?>') {
                        select.selectedIndex = i;
                    }
                }
            })();
            </script>

            <fieldset>
                <button type="submit" class="btn btn-submit" name="submit">
                    <?php echo $lang->submit; ?>
                </button>
            </fieldset>
        </form>
    </div>

</div>


<?php include_once("footer.php"); ?>
