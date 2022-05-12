<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo (!empty($title)) ? $title : $lang->login;?></title>
    <noscript><meta http-equiv="refresh" content="0; URL=<?php echo href('home/badbrowser');?>"></noscript>
    <link rel="shortcut icon" href="<?php echo href(settings()->site_icon);?>?v=1.0" type="image/x-icon">
    <link rel="icon" href="<?php echo href(settings()->site_icon);?>?v=1.0" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo href('css/login.css');?>">
    <script type="text/javascript" src="<?php echo href('js/jquery.js');?>"></script>
</head>
<body>
    <div class="content">

        <div class="login">

            <div style="text-align:center;">
                <img src="<?php echo href("images/logo.png");?>" style="height:150px;" alt="" />
            </div>

            <ul class="errors" style="display:none;">

            </ul>

            <p style="background:#000;padding:10px;">
                <?php echo $lang->recover; ?>
            </p>


            <form class="" id="login" name="login"
                    action="<?php echo href("ajax/forget");?>"
                    method="post"
                    autocomplete="off">
                <input type="email" class="field"
                        id="email"
                        name="email"
                        placeholder="<?php echo $lang->email;?>"
                        required>
                <p>
                <a href="<?php echo href('admin/login');?>"><?php echo $lang->login;?></a>
                <p>
                <input type="hidden" id="table" name="table" value="<?php echo TABLE_USERS;?>">
                <input type="submit" class="btn btn-submit" name="submit" value="<?php echo $lang->submit;?>">
            </form>
        </div>

    </div>
    <script type="text/javascript">
    $("form[name=login]").on("submit", function(e){
        e.preventDefault();
        var options = {
            type: 'POST',
            url: $(this).attr("action"),
            data:{
                table: $("#table").val(),
                email: $("#email").val()
            },
            success: function(data)
            {
                var data = JSON.parse(data);
                if( data.message != "ok" )
                {
                    $(".errors").fadeIn()
                    .html("<li>"+data.message+"</li>");
                } else {
                    //location.reload();
                }
            }
        }
        $.ajax(options);
    });
    </script>
</body>
</html>
