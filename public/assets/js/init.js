(function($){
  $(function(){
    $('.button-collapse').sideNav();
    if(window.innerWidth > 768) {
        $('select').material_select();
    } else {
       $('select').addClass("browser-default");
    }
	

  }); // end of document ready
})(jQuery); // end of jQuery name space


$(document).ready(function() {
    
    $('.disable-bubble').on('click',function(e){
        e.stopPropagation();
    });
    
    $('.datepicker').pickadate({
        selectMonths: false, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,
    });

    $('.start-date').pickadate({
        selectMonths: false, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,
    });

    $('.end-date').pickadate({
        selectMonths: false, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,
    });
    
    $('.addnewform').on('click',function(e){
        var event = e || window.event;
        event.stopPropagation ? event.stopPropagation() : (event.cancelBubble=true);
        var src = $(this).attr('href');
        window.location.href = src;
        return false;
    });

  $(window).scroll(function() {    
//      var scroll = $(window).scrollTop();
//      if (scroll >= 56) {
//          $(".unfix_header").addClass("fixattop");
//      } else {
//          $(".unfix_header").removeClass("fixattop");
//      }
  });

});