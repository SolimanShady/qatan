<?php require_once("header.php"); ?>


<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->sms; ?></h3>
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


    <form method="post" autocomplete="off">

        <fieldset>
            <p>
                <label for="provider"><?php echo $lang->provider; ?></label>
                <input type="text"
                    id="provider"
                    class="field"
                    name="provider"
                    value="<?php echo $sms->provider;?>"
                    placeholder="<?php echo $lang->provider;?>">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="test_token"><?php echo $lang->test_token; ?></label>
                <input type="password"
                    id="test_token"
                    class="field"
                    name="test_token"
                    value="<?php echo $sms->test_token;?>"
                    placeholder="<?php echo $lang->test_token;?>">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="live_token"><?php echo $lang->live_token; ?></label>
                <input type="password"
                    id="live_token"
                    class="field"
                    name="live_token"
                    value="<?php echo $sms->live_token;?>"
                    placeholder="<?php echo $lang->live_token;?>">
            </p>
        </fieldset>

        <fieldset>
                <label for=""><?php echo $lang->status; ?></label>
                <input type="checkbox" id="status"
                    name="is_live"
                    value="<?php echo $sms->is_live;?>"
                    <?php echo ($sms->is_live) ? "checked" : ""; ?>
                    onclick="(0 == this.value)
                    ? this.value=1
                    : this.value=0;">
        </fieldset>

        <fieldset>
            <p>
                <input type="submit" class="btn btn-submit" name="submit" value="<?php echo $lang->update;?>">
            </p>
        </fieldset>

    </form>
</div>





<?php require_once("footer.php"); ?>
