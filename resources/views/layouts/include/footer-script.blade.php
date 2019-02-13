  <!--  Scripts-->
  <script type="text/javascript" src="js/jquery.2.2.0.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/jquery.mask.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/select3-full.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/menu-backdrop.js"></script>
  <script type="text/javascript" src="js/init.js"></script>
  <?php if($resize){ ?>
  <script type="text/javascript" src="js/resize.js"></script>
  <?php } ?>
  <script>
    $("document").ready(function($){
        var nav = $('.title-bar');
        var header = $('.header');
        $(window).scroll(function () {
            if ($(this).scrollTop() > 62) {
                nav.addClass("f-nav");
                header.css({'marginBottom':48+'px'});
            } else {
                nav.removeClass("f-nav");
                header.css({'marginBottom':0+'px'});
            }
        });
    });
  </script>
  </body>
</html>