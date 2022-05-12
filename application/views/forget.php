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
    <link rel="stylesheet" href="<?php echo href('css/fontawesome/all.css');?>">
    <script type="text/javascript" src="<?php echo href('js/jquery.js');?>"></script>
</head>
<body>
    <div class="content">

        <div class="login">

            <div style="text-align:center;">
                <img src="<?php echo href("images/logo.png");?>" style="height:100px;" alt="" />
            </div>

            <ul class="errors" style="display:none;">

            </ul>

            <form class="" id="login" name="login"
                    action="<?php echo href("ajax/login");?>"
                    method="post"
                    autocomplete="off">

                <p>
                    <i class="fa fa-user" style="position:absolute;margin: 8px;"></i>
                    <input type="text" class="field"
                            id="username"
                            name="username"
                            pattern="^[^ ].+[^ ]$"
                            placeholder="<?php echo $lang->username;?> *"
                            required>
                </p>
                <p>
                    <i class="fas fa-eye-slash" style="position:absolute;margin: 8px;"></i>
                    <input type="password" class="field"
                            id="password"
                            name="password"
                            pattern="^[^ ].+[^ ]$"
                            placeholder="<?php echo $lang->password;?> *"
                            required>
                </p>
                <i class="fas fa-lock"></i>
                <a href="<?php echo href('account/forget');?>">
                    <?php echo $lang->forget;?>
                </a>
                <p>
                <input type="submit" class="btn btn-submit" name="submit" value="<?php echo $lang->login;?>">
            </form>
        </div>

    </div>
    <script type="text/javascript">
    var base_url = "<?php echo URL;?>";

    $("form[name=login]").on("submit", function(e){
        e.preventDefault();
        var options = {
            type: 'POST',
            url: $(this).attr("action"),
            data:{
                username: window.btoa(
                    unescape(
                        encodeURIComponent($("#username").val())
                    )
                ),
                password: window.btoa(
                    unescape(
                        encodeURIComponent($("#password").val())
                    )
                )
            },
            success: function(data)
            {
                var data = JSON.parse(data);
                if( data.message != "ok" )
                {
                    $(".errors").fadeIn()
                    .html("<li>"+data.message+"</li>");
                } else {
                    location.href = base_url+"/admin";
                }
            }
        }
        $.ajax(options);
    });
    </script>
</body>
</html>
