<!-- Navigation Start -->
<div class="menu">
    <ul>
        <li>
            <a href="<?php echo href("admin");?>"
                title="<?php echo $lang->home;?>">
                <i class="fa fa-home"></i>
            </a>
        </li>

        <li>
            <a href="<?php echo href("admin/orders");?>"
                title="<?php echo $lang->orders;?>">
                <i class="fa fa-shopping-cart"></i>
            </a>
        </li>

        <li>
            <a href="<?php echo href("admin/payments");?>"
                title="<?php echo $lang->payments;?>">
                <i class="fas fa-money-bill-alt"></i>
            </a>
        </li>

        <li>
            <a href="<?php echo href("admin/customers");?>"
                title="<?php echo $lang->customers;?>">
                <i class="fa fa-users"></i>
            </a>
        </li>

        <li>
            <a href="<?php echo href("admin/categories");?>"
                title="<?php echo $lang->categories;?>">
                <i class="fa fa-list"></i>
            </a>
        </li>

        <li>
            <a href="<?php echo href("admin/products");?>"
                title="<?php echo $lang->products;?>">
                <i class="fas fa-tshirt"></i>
            </a>
        </li>

        <!--
        <li>
            <a href="<?php echo href("admin/coupons");?>"
                title="<?php echo $lang->coupons;?>">
                <i class="fas fa-tags"></i>
            </a>
        </li>
        -->

        <!--
        <li>
            <a href="<?php echo href("admin/media");?>"
                title="<?php echo $lang->media;?>">
                <i class="fas fa-images"></i>
            </a>
        </li>
        -->
        <li>
            <a href="<?php echo href("admin/sms");?>"
                title="<?php echo $lang->sms;?>">
                <i class="fas fa-sms"></i>
            </a>
        </li>
        
        
        <li>
            <a href="<?php echo href("admin/stripe")?>"
                title="<?php echo $lang->stripe_settings;?>">
                <i class="fab fa-cc-stripe"></i>
            </a>
        </li>
        

        <li>
            <a href="<?php echo href("admin/settings");?>"
                title="<?php echo $lang->settings;?>">
                <i class="fa fa-wrench"></i>
            </a>
        </li>

        <li>
            <a href="<?php echo href("admin/languages");?>"
                title="<?php echo $lang->languages;?>">
                <i class="fa fa-language"></i>
            </a>
        </li>

        <li>
            <a href="<?php echo href("admin/logs")?>"
                title="<?php echo $lang->activity_logs;?>">
                <i class="fa fa-history"></i>
            </a>
        </li>

        <li>
            <a href="<?php echo href("admin/account");?>"
                title="<?php echo $lang->account;?>">
                <i class="fa fa-user"></i>
            </a>
        </li>
        
        <!--
        <li>
            <a href="<?php echo href("admin/reports");?>"
                title="<?php echo $lang->reports;?>">
                <i class="fas fa-chart-bar"></i>
            </a>
        </li>
        -->

        <li style="position:relative;" id="notifications">
            
            <?php if( count($_SESSION["totalPendingOrders"]) > 0 ): ?>
            
            <sup id="notification" style="display:block;"><?php echo $_SESSION["totalPendingOrders"];?></sup>
            
            <?php else: ?>
            
            <sup id="notification"><?php echo $_SESSION["totalPendingOrders"];?></sup>
            
            <?php endif; ?>
            
            <a href="<?php echo href("admin/orders");?>"
                title="<?php echo $lang->orders;?>">
                <i class="fa fa-bell"></i>
            </a>
        </li>
        
         <li>
            <a href="<?php echo href("admin/backup");?>"
                title="<?php echo $lang->backup;?>">
                <i class="fa fa-database"></i>
            </a>
        </li>

        <li>
            <a href="<?php echo href("admin/logout");?>"
                title="<?php echo $lang->logout;?>">
                <i class="fa fa-arrow-alt-circle-left"></i>
            </a>
        </li>
    </ul>

</div>
<!-- End Navigation -->

<script type="text/javascript">
$(".menu a").on("mouseover", function(event){
    $.tip(event, $(this).attr("title"));
});

$(".menu a").on("mouseout", function(e){
    $('#tip').remove();
});
</script>
