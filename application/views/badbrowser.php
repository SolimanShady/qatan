<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title;?></title>
    <!--Css Files Start-->
<?php foreach (['style'] as $css): ?>
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/<?php echo $css;?>.css">
<?php endforeach; ?>
    <!--End Css Files-->

    <style type="text/css">
    .content{
        border-radius: 4px;
        text-align: center;
        height: 300px !important;
        min-height: 300px !important;
        overflow: hidden;
        padding: 0px !important;
    }
    .content p{
        font-size: 13px;
        width: 50%;
    }
    .head{
        background: #0E4194;
        color: #fff;
        width: 100%;
        height: 40px;
    }
    .good_browsers{
        padding: 20px 0 24px;
        margin: 0 auto;
        width: 50%;
        overflow-x: auto;
    }
    .good_browsers a{
        font-weight: bold;
    }
    .good_browsers ul{
        display: flex;
    }
    .good_browsers li{
        margin-left: 10px;
    }

    .browser_icon{
        margin-bottom: 10px;
        width: 80px;
        height: 80px;
        background-image: url('../images/browsers.png');
    }
    img{
        display: block;
        min-width: 100%;
    }
    .firefox{
        background-position: 0px -80px;
    }
    .chrome{
        background-position: 0px -160px;
    }
    .opera{
        background-position: 0px -240px;
    }
    .yandex{
        background-position: 0px -320px;
    }
    .atom{
        background-position: 0px -400px;
    }
    </style>
</head>
<body>

    <div class="content">
        <div class="head">

        </div>
        <center>
            <h2>please enable javascript or update your browser.</h2>
            <p>
                This may cause this site to work slowly or experience errors. For speed and stability, we recommend you install the latest version of one of the following browsers:
            </p>
            <div class="good_browsers">
                <ul>
                    <li>

                        <a href="https://www.google.com/chrome/">
                            <img src="<?php echo href('images/blank.gif');?>"
                            alt="Chrome"
                            class="browser_icon chrome"/>
                            Chrome
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="<?php echo href('images/blank.gif');?>" alt="Firefox" class="browser_icon firefox" />
                            Firefox
                        </a>
                    </li>
                    <li>
                        <a href="https://www.opera.com/">
                            <img src="<?php echo href('images/blank.gif');?>" alt="Opera" class="browser_icon opera" />
                            Opera
                        </a>
                    </li>
                    <li>
                        <a href="https://browser.yandex.com">
                            <img src="<?php echo href('images/blank.gif');?>" alt="Yandex" class="browser_icon yandex"/>
                            Yandex
                        </a>
                    </li>
                    <li>
                        <a href="https://browser.ru">
                            <img src="<?php echo href('images/blank.gif');?>" alt="Atom" class="browser_icon atom"/>
                            Atom
                        </a>
                    </li>
                </ul>
            </div>
        </center>
    </div>

</body>
</html>
