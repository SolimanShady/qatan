<!DOCTYPE html>
<html dir="<?php echo ( 'ar' == strtolower(settings()->site_language) ) ? 'rtl' : '';?>">
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo (!empty($title)) ? $title : $lang->home;?></title>
  <noscript><meta http-equiv="refresh" content="0; URL=<?php echo href('home/badbrowser');?>"></noscript>
  <link rel="shortcut icon" href="<?php echo href(settings()->site_icon);?>?v=1.0" type="image/x-icon">
  <link rel="icon" href="<?php echo href(settings()->site_icon);?>?v=1.0" type="image/x-icon">

<!-- Css FILES Start -->
<?php foreach (["framework", "admin", "responsive", "fontawesome/all", "flags/flags.min"] as $css): ?>
  <link rel="stylesheet" type="text/css" href="<?php echo URL;?>/css/<?php echo $css;?>.css">
<?php endforeach; ?>
<!-- End Css Files -->

<script type="text/javascript">var base_url = "<?php echo URL;?>";</script>

<!-- Javascript FILES Start -->
<?php foreach (['jquery', 'jquery.cookie', 'highchart', 'admin'] as $js): ?>
  <script type="text/javascript" src="<?php echo URL;?>/js/<?php echo $js;?>.js"></script>
<?php endforeach; ?>
<!-- End Javascript Files -->

<?php if ( isset($css_files) ): ?>
<?php foreach ($css_files as $css): ?>
  <link rel="stylesheet" href="<?php echo URL;?>/css/<?php echo $css;?>.css">
<?php endforeach; ?>
<?php endif; ?>

<?php if ( isset($js_files) ): ?>
<?php foreach ($js_files as $js): ?>
  <script type="text/javascript" src="<?php echo URL;?>/js/<?php echo $js;?>.js"></script>
<?php endforeach; ?>
<?php endif; ?>

  <!--[if lt ie 9]>
  <script src="<?php echo URL;?>/js/html5.js" type="text/javascript"></script>
  <![endif]-->

</head>
<body>
<header>
    <?php include_once("navbar.php") ?>
</header>
<div class="msgbox"></div>
