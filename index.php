<?php
/**
 *------------------------------------------------------
 * 3rood - coupons offer.
 *
 * @author Soliman Adel (Mr-simple)
 * @email {soliman.adelzx@gmail.com}
 * @version v1.0
 *------------------------------------------------------
 */

error_reporting(0);
require("core.php");

if( !ob_start("ob_gzhandler") ) ob_start();

try {
    application::run();
    date_default_timezone_set(settings()->timezone);
} catch (Exception $e) {
    echo $e->getMessage();
}

ob_end_flush();
?>
