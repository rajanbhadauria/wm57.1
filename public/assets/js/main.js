function chooseSendresumeOption() {
  $(".send-resume-tab").hide();
  $(".send-resume-tab:first").show();
  $("#email-option").prop('checked', true);

  //On Click Event
  $(".send-resume-options li input[type='radio']").click(function () {
    $(".send-resume-options li input[type='radio']").prop('checked', false);
    $(this).prop('checked', true);
    $(".send-resume-tab").hide(); //Hide all tab content
    var activeTab = $(this).val(); //Find the href attribute value to identify the active tab + content
    $('#' + activeTab).fadeIn(); //Fade in the active ID content
  });
}

function chooseRequestresumeOption() {
  $(".request-resume-tab").hide();
  $(".request-resume-tab:first").show();
  $("#email-option").prop('checked', true);

  //On Click Event
  $(".request-resume-options li input[type='radio']").click(function () {
    $(".request-resume-options li input[type='radio']").prop('checked', false);
    $(this).prop('checked', true);
    $(".request-resume-tab").hide(); //Hide all tab content
    var activeTab = $(this).val(); //Find the href attribute value to identify the active tab + content
    $('#' + activeTab).fadeIn(); //Fade in the active ID content
  });
}

function selectLabelColor(select) {
  var selectedVal = select.val();
  var initialVal = select.closest(".select-wrapper").find("ul.select-dropdown li:first-child span").text();
  console.log(select);
  console.log("initial val" + initialVal);
  console.log("selected val" + selectedVal);
  if (selectedVal == initialVal || selectedVal == '') {
    console.log("hi");
    select.css("color", "#9e9e9e");
  } else {
    console.log("hello");
    select.css("color", "#000");
  }
}

/*function textAreaAdaptiveHeight() {
  $('textarea').each(function () {
    this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
  }).on('input', function () {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight + 5) + 'px';
  });
}*/

//Number-Validation
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

  return true;
}


//Upload file lebel
window.pressed = function () {
  var a = document.getElementById('files');
  if (a.value == "") {
    fileLabel.innerHTML = "Choose file";
  } else {
    var theSplit = a.value.split('\\');
    fileLabel.innerHTML = theSplit[theSplit.length - 1];
  }
};

$(document).ready(function () {

  $(".num-col input").keyup(function () {
    if (this.value.length == this.maxLength) {
      $(this).parents('.num-col').next('.num-col').find('input').focus();
    }
  });

  /*Equal height function */
  equalheight = function (container) {

    var currentTallest = 0,
      currentRowStart = 0,
      rowDivs = new Array(),
      $el,
      topPosition = 0;
    $(container).each(function () {

      $el = $(this);
      $($el).height('auto')
      topPostion = $el.position().top;

      if (currentRowStart != topPostion) {
        for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
          rowDivs[currentDiv].height(currentTallest);
        }
        rowDivs.length = 0; // empty the array
        currentRowStart = topPostion;
        currentTallest = $el.height();
        rowDivs.push($el);
      } else {
        rowDivs.push($el);
        currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
      }
      for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
        rowDivs[currentDiv].height(currentTallest);
      }
    });
  }
  equalheight('.widget-container .col .widget-block');

  setTimeout(function () {
    textAreaAdaptiveHeight();
  }, 1000);

  chooseSendresumeOption();
  chooseRequestresumeOption();
  $('.update-resume-modal').modal({
    startingTop: "50%",
    endingTop: "50%"
  });

  $('.delete-acct-modal').modal({
    startingTop: "50%",
    endingTop: "50%"
  });

  $('.otp-success-modal').modal({
    startingTop: "50%",
    endingTop: "50%"
  });

  $('#advance-search').modal({
    startingTop: "50%",
    endingTop: "50%"
  });

  $('.resume-actions-modal').modal({
    startingTop: "50%",
    endingTop: "50%"
  });

  $("input.select-dropdown").each(function (i, select) {
    selectLabelColor($(select));
  });


  $("select").on("change", function () {
    var selectDropDown = $(this).closest(".select-wrapper").find("input.select-dropdown");
    selectLabelColor(selectDropDown);
  })


  $('#skills-input').select3({
    items: ['Html5', 'css3', 'javascript', 'Angular js'],
    multiple: true,
    placeholder: 'Type to search'
  });

});

$(window).on('load', function () {
  $(".notification-ico").addClass("animate-ico");
});

$(window).on('resize', function () {
  textAreaAdaptiveHeight();

  equalheight('.widget-container .col .widget-block');
});



(function($) {
	"use strict";
	function handlePreloader() {
		if($('.preloader').length){
			$('.preloader').delay(500).fadeOut(500);
		}
	}

	$(window).on('load', function() {
		handlePreloader();
		enableMasonry();
	});



})(window.jQuery);
