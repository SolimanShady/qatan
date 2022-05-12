<?php include("header.php"); ?>

<div class="page">
    <div class="page-heading">
        <h3><?php echo $lang->settings; ?></h3>
    </div>

    <?php if (!empty($msg)): ?>
        <div class="info">
            <strong><?php echo $msg; ?></strong>
        </div>
    <?php endif; ?>

    <form method="post" autocomplete="off" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label for=""><?php echo $lang->site_name; ?></label>
                <input type="text"
                    class="field"
                    name="site_name"
                    value="<?php echo $settings->site_name;?>"
                    required>
            </p>
        </fieldset>
        <fieldset>
            <p>
                <img src="<?php echo href(settings()->site_logo);?>" height="70" alt="" />
                <label for="site_logo" class="upload_label">
                    <?php echo $lang->upload." ".$lang->site_logo;?>
                    <strong>+</strong>
                </label>
                <input type="file"
                        id="site_logo"
                        onchange="$(this).prev().html(this.value);"
                        class="hidden field"
                        name="site_logo" accept="image/*">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <img src="<?php echo href(settings()->site_icon);?>" alt="" />
                <label for="site_icon" class="upload_label">
                    <?php echo $lang->upload." ".$lang->site_icon; ?>
                    <strong>+</strong>
                </label>
                <input type="file"
                        id="site_icon"
                        onchange="$(this).prev().html(this.value);"
                        class="hidden field"
                        name="site_icon" accept="image/*">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="site_language"><?php echo $lang->site_language;?></label>
                <select class="field" id="languages" name="site_language">
                <?php foreach ($languages as $language): ?>

                    <option value="<?php echo $language->code;?>"><?php echo $language->name;?></option>

                <?php endforeach; ?>

                </select>
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for=""><?php echo $lang->site_keywords; ?></label>
                <input type="text" name="site_keywords" value="<?php echo $settings->site_keywords;?>" class="field">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for=""><?php echo $lang->site_description; ?></label>
                <textarea name="site_description" class="field" rows="8" cols="40"><?php echo $settings->site_description;?></textarea>
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for=""><?php echo $lang->google_analytics;?></label>
                <input type="text" class="field" name="google_analytics" value="<?php echo $settings->google_analytics;?>" placeholder="<?php echo $lang->google_analytics;?>">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="timezone"><?php echo $lang->timezone; ?></label>
                <select class="field" id="timezone" name="timezone">
                    <option>--<?php echo $lang->timezone;?>--</option>
                    <?php foreach (DateTimeZone::listIdentifiers(DateTimeZone::ALL) as $timezone): ?>
                        <option value="<?php echo $timezone;?>"><?php echo $timezone;?></option>
                    <?php endforeach; ?>

                </select>
            </p>
        </fieldset>
        
        <fieldset>
            
            <p>
                <label for="">
                <i class="fas fa-shipping-fast"></i>
                <?php echo $lang->shipping_amount;?>
            </label>
            <input type="text" name="shipping_amount" value="<?php echo $settings->shipping_amount;?>" class="field">
            </p>
            
        </fieldset>
        
        <!--
        <fieldset>
            
            <p>
                <label for="">
                    <i class="fas fa-coins"></i>
                    <?php echo $lang->currency;?>
                </label>
            <input type="text" id="currency" class="field" value="SAR" placeholder="SAR" disabled>
            </p>
            
        </fieldset>
        -->
        
        

        <fieldset>
            <p>

                <label for="">
                    <i class="fab fa-android" style="color:#A0BF39;font-size: 25px !important;"></i>
                    <?php echo $lang->app_android_link; ?>
                </label>
                <input type="text" name="app_android_link" value="<?php echo $settings->app_android_link;?>" class="field">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="">
                    <i class="fab fa-apple" style="color:#212529;font-size:25px !important;"></i>
                    <?php echo $lang->app_ios_link; ?>
                </label>
                <input type="text" name="app_ios_link" value="<?php echo $settings->app_ios_link;?>" class="field">
            </p>
        </fieldset>

        <fieldset>
            <p>
                <input type="submit" class="btn btn-submit" name="submit" value="<?php echo $lang->update;?>">
            </p>
        </fieldset>
    </form>
</div>

<script type="text/javascript">
(function(){
    var select = document.querySelector("#languages");
    for (i=0;i<select.length;i++) {
        if (select.options[i].value == '<?php echo settings()->site_language;?>') {
            select.selectedIndex = i;
        }
    }
    /*
    var currency = document.querySelector("#currency");
    for (i=0;i<currency.length;i++) {
        if (currency.options[i].value == '<?php echo settings()->currency;?>') {
            currency.selectedIndex = i;
        }
    }*/
    
    var timeZone = document.querySelector("#timezone");
    for (i=0;i<timeZone.length;i++) {
        if (timeZone.options[i].value == '<?php echo settings()->timezone;?>') {
            timeZone.selectedIndex = i;
        }
    }
})();
</script>

<?php include("footer.php"); ?>
