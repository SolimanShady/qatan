;(function($){
    $(window).scroll(function(){
        $(window).scrollTop() > 10 ?
        $("#back-to-top").fadeIn() :
        $("#back-to-top").fadeOut()
    });

    Extragram = {

        isEmpty: function(text)
        {
            text = text.replace(/^\s+|\s+$/g,'');
            return text.length == 0;
        },

        download: function(url)
        {
            if(this.isEmpty(url)) {
                $(".alert").css("display", "block");
                return false;
            }

            // Remove previous fetching data
            $(".result").html("<ul><li><div class=\"line animate\"></div></li>"+
            "<li><div class=\"line animate\"></div></li>"+
            "<li><div class=\"line animate\"></div></li>");

            // Check if it's url or not
            var Filter = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/;
            if(!Filter.test(url)) return false;

            // Start ajax download
            var options = {
                url: base_url + "/ajax/download",
                type: 'POST',
                data: {url: url},
                success: function(response)
                {
                    //Nav.end();
                    $("html, body").animate({
                            scrollTop: $(".result").offset().top
                        }, 1e3);
                    $(".result").html(response);
                }
            }
            $.ajax(options);
        },

        setLang: function(val) {
            if(val == $.cookie("lang")) return false;
            $.cookie("lang", "");
            $.removeCookie('lang');
            $.cookie('lang', val, {expires:1, path:"/"});
            location.reload();
        },

        top: function() {
            $("html, body").animate({scrollTop: 0}, 1e3)
        },

        nav: function() {
            if ( parseInt(nav_opened) > 0 ) {
                $('body').css('margin-top', 0);
                nav_opened = 0;
            }
            else {
                $('body').css('margin-top', $('.nav_link').height());
                nav_opened = 1;
            }
            $('.nav_link').slideToggle();
        }

    }
})(jQuery);
