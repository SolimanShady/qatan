<?php include("header.php"); ?>

<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->account; ?></h3>
    </div>

    <?php if (!empty($msg)): ?>

        <div class="info">
            <strong><?php echo $msg; ?></strong>
        </div>

    <?php endif; ?>

    <form method="post" autocomplete="off">
        <fieldset>
            <p>
                <label for="username">
                    <?php echo $lang->username; ?>
                    <span class="required">*</span>
                </label>
                <input type="text" class="field" name="username" id="username"
                        value="<?php echo $_SESSION["username"];?>"
                        placeholder="<?php echo $lang->username;?>" required>
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="current_password">
                    <?php echo $lang->current_password; ?>
                    <span class="required">*</span>
                </label>
                <input type="password" class="field" id="current_password"
                        name="current_password"
                        placeholder="<?php echo $lang->current_password;?>" required>
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="new_password">
                    <?php echo $lang->new_password; ?>
                    <span class="required">*</span>
                </label>
                <input type="password" class="field"
                        id="new_password"
                        name="new_password"
                        placeholder="<?php echo $lang->new_password;?>" required>
            </p>
        </fieldset>
        <fieldset>
            <p>
                <button type="submit" class="btn btn-submit" name="submit">
                    <?php echo $lang->update; ?>
                </button>
            </p>
        </fieldset>
    </form>
</div>


<?php include("footer.php"); ?>
