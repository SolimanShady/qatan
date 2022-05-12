var admin = {},
box = [];

;(function($){

    var checked = 0;

    $.tip = function(e, text)
    {
        var target = e.target;
        $('body').append('<div id="tip"></div>')
        $('#tip').html(text)
        .css("top",(e.pageY - 50) + "px")
        .css("left", (e.pageX + 0) + "px")
        .css("z-index", $(".menu").css("z-index"))
        .fadeIn('fast');
    }

    admin.check = function()
    {
        var checkbox = document.querySelectorAll('.checkbox');
        for (var i = 0; i < checkbox.length; i++)
        {
            if (checkbox[i].checked)
            {
                continue;
            }
            else
            {
                box.push(checkbox[i].value);
                checkbox[i].checked = true;
            }
        }
        $(".snack-bar").slideDown('fast');
    }

    admin.uncheck = function()
    {
        var checkbox = document.querySelectorAll('.checkbox');
        for (var i = 0; i < checkbox.length; i++)
        {
            box.pop(checkbox[i].value);
            checkbox[i].checked = false;
        }
        $(".snack-bar").slideUp('fast');
    }

    admin.checked = function(id)
    {
        if(id.checked)
        {
          box.push(id.value);
          $(".snack-bar").slideDown('fast');
        }
        else
        {
          box.pop(id.value);
          if(box.length == 0)
          {
            $(".snack-bar").slideUp('fast');
          }
        }
    }

    admin.edit = function(table, data) {
        $.ajax({
            url: base_url+"/ajax/edit",
            type: "POST",
            data: {
                table: table,
                data: data
            },
            success: function(data) {
                data = $.parseJSON(data);
                if (200 == data.status) {
                    $.msgbox(data.msg, 1500);
                }
            }
        });
    }

    admin.delete = function(table, data)
    {
        array = box.toString();
        $.ajax({
            url: base_url+'/ajax/delete',
            type: 'POST',
            data: {
                table: table,
                ids: array
            },
            success: function(data)
            {
                data = $.parseJSON(data);
                if(200 == data.status)
                {
                    $('.snack-bar').slideUp('fast');
                    var length = box.length;
                    for(var i = 0; i < length; i++)
                    {
                        $('input[value='+box[i]+']')
                        .parent()
                        .parent()
                        .remove();
                    }
                    box = [];
                    $.msgbox(data.msg, 1500);
                }
            }
        });
    }

    $.msgbox = function(txt, time)
    {
        var msgbox = $('.msgbox');
        msgbox.html(txt).fadeIn();
        setTimeout(function(){msgbox.fadeOut();}, time);
    }

})(jQuery);
