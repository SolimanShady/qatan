<?php include("header.php"); ?>

<div class="page">
    
    <div class="page-heading">
        <h3><?php echo $lang->social; ?></h3>
    </div>

    <?php if (!empty($msg)): ?>
        <div class="info">
            <strong><?php echo $msg; ?></strong>
        </div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <fieldset>
            <p>
                <i class="fab fa-facebook" style="color:#3A5898;"></i>
                <label for=""><?php echo $lang->facebook; ?></label>
                <input type="url"
                        class="field"
                        name="facebook"
                        value="<?php echo $social->facebook;?>"
                        placeholder="<?php echo $lang->facebook;?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <i class="fab fa-twitter" style="color:#2BAADF;"></i>
                <label for=""><?php echo $lang->twitter; ?></label>
                <input type="url"
                        class="field"
                        name="twitter"
                        value="<?php echo $social->twitter;?>"
                        placeholder="<?php echo $lang->twitter?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <i class="fab fa-youtube" style="color:#CA1F28;"></i>
                <label for=""><?php echo $lang->youtube; ?></label>
                <input type="url"
                        class="field"
                        name="youtube"
                        value="<?php echo $social->youtube;?>"
                        placeholder="<?php echo $lang->youtube ?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <i class="fab fa-linkedin" style="color:#0A66C2;"></i>
                <label for=""><?php echo $lang->linkedin; ?></label>
                <input type="url"
                        class="field"
                        name="linkedin"
                        value="<?php echo $social->linkedin;?>"
                        placeholder="<?php echo $lang->linkedin ?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <input type="submit"
                        class="btn btn-submit"
                        name="submit"
                        value="<?php echo $lang->update;?>">
            </p>
        </fieldset>
    </form>
</div>

<?php include("footer.php"); ?>
