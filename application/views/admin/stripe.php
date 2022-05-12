<?php include_once("header.php"); ?>


<div class="page">

    <div class="page-heading">
        <h3><?php echo $lang->stripe_settings;?></h3>
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


    <form method="post">

        <fieldset>
            <p>
                <label for=""><?php echo $lang->stripe_publish_key;?></label>
                <textarea class="field" name="publish_key" placeholder="<?php echo $lang->stripe_publish_key;?>"><?php echo config("stripe")->stripe_publish_key;?></textarea>
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for=""><?php echo $lang->stripe_secret_key;?></label>
                <textarea class="field" name="secret_key" placeholder="<?php echo $lang->stripe_secret_key;?>"><?php echo config("stripe")->stripe_secret_key;?></textarea>
            </p>
        </fieldset>

        <fieldset>
            <input type="submit" class="btn btn-submit" value="<?php echo $lang->submit;?>">
        </fieldset>

    </form>
</div>



<?php include_once("footer.php");?>
