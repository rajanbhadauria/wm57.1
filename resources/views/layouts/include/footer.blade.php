    @if(Route::getCurrentRoute()->getPath() != "login")
    <footer id="footer" class="<?php if(isset($footerNotFixed) && $footerNotFixed=='set'){ echo 'position-relative';} ?>">
        <div class="footer-inner-container pt0">
            <div class="fa-width33">
                <a href="#" onclick="window.history.back();" class="footer-anchor fl">
                    <i class="fa fa-chevron-left fa-lg" aria-hidden="true"></i><br/>
                    Back
                </a>
            </div>
            <div class="fa-width33">
                <a href="{{URL::to('home')}}" class="footer-anchor">
                    <i class="fa fa-home fa-lg" aria-hidden="true"></i><br/>
                    Home
                </a>
            </div>
            <div class="fa-width33 hide">
                <a href="update.php" class="footer-anchor fr">
                    <i class="fa fa-chevron-right fa-lg" aria-hidden="true"></i><br/>
                    Next
                </a>
            </div>             
            <div class="clearfix"></div>
        </div>
    </footer>
    @endif
  <!--  Scripts-->
  <!-- <script type="text/javascript" src="/assets/js/jquery.2.2.0.min.js"></script> -->
  <script type="text/javascript" src="/assets/js/materialize.min.js"></script>
  <script type="text/javascript" src="/assets/js/menu-backdrop.js"></script>
  <script type="text/javascript" src="/assets/js/init.js"></script>
  <script type="text/javascript" src="/assets/js/main.js"></script>
<!--   <?php $resize = true; ?>
  <?php if($resize){ ?>
  <script type="text/javascript" src="/assets/js/resize.js"></script>
  <?php } ?> -->
  <script>
    // $("document").ready(function($){
    //     var nav = $('.title-bar');
    //     var header = $('.header');

    //     $(window).scroll(function () {
    //         if ($(this).scrollTop() > 1) {
    //             nav.addClass("f-nav");
    //             header.addClass("f-nav");
    //             nav.css({'top':48+'px'});
    //             //header.css({'marginBottom':48+'px'});
    //         } else {
    //             nav.removeClass("f-nav");
    //             header.removeClass("f-nav");
    //             nav.css({'top': 0+'px'});
    //             //header.css({'marginBottom':0+'px'});
    //         }
    //     });
    // });
  </script>
  </body>
</html>