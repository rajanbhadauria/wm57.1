$(document).ready(function(){


	$(".alphainput").on("keypress", function (evt) {
		var keyCode = (evt.which) ? evt.which : evt.keyCode
	    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 8){
			return false;
		}else{
			return true;
		}
	});

	$(".numeric").on("keypress", function(e) {
		var unicode=e.charCode? e.charCode : e.keyCode
		if (unicode && unicode!=8 && unicode!=9){
			if (unicode<48||unicode>57)
				return false
		}
	});
	$(".alpha").on("keypress", function(e) {
		var keyCode=e.charCode? e.charCode : e.keyCode;
		console.log(keyCode);
		if (keyCode && keyCode!=8 && keyCode!=9){
			if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
				return false
		}
	});
	$(".alphanumeric").on("keypress", function(e) {
		var keyCode=e.charCode? e.charCode : e.keyCode
		if (keyCode && keyCode!=8 && keyCode!=9){
			if (((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) && (keyCode<48||keyCode>57))
				return false
		}
	});

	$(".validaddress").on("keypress", function(e) {
		var keyCode=e.charCode? e.charCode : e.keyCode

		if (keyCode && keyCode!=8 && keyCode!=9){
			if (((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) && (keyCode<48||keyCode>57) && keyCode!=44 && keyCode!=45 && keyCode!=46 && keyCode!=47)
				return false
		}
	});

	$(".companyname").on("keypress", function(e) {
		var keyCode=e.charCode? e.charCode : e.keyCode
		if (keyCode && keyCode!=8 && keyCode!=9){
			console.log(keyCode);
			if (((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) && (keyCode<48||keyCode>57) && keyCode!=45 && keyCode!=46 && keyCode!=38)
				return false
		}
	});
	$(".cgpa").on("keypress", function(e) {

		var keyCode=e.charCode? e.charCode : e.keyCode

		if (keyCode && keyCode!=8 && keyCode!=9){

			if (((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) && (keyCode<48||keyCode>57) && keyCode!=43 && keyCode!=45 && keyCode!=46 && keyCode!=37)
				return false
		}
	});


	$(".emailvalidate").on("keypress", function(e) {
		var keyCode=e.charCode? e.charCode : e.keyCode
		console.log(keyCode);
		if (keyCode && keyCode!=8 && keyCode!=9){
			if(keyCode == 32)
				return false
			if (((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) && (keyCode<48||keyCode>57) && !(keyCode==64 || keyCode==45 || keyCode==46 || keyCode==95) )
				return false
		}
	});
	$(".nospace").on("keypress", function(e) {
		var keyCode=e.charCode? e.charCode : e.keyCode
		if (keyCode==32){
			return false
		}
	});

	$(".alphanumericplusper").on("keypress", function(e) {
		var keyCode=e.charCode? e.charCode : e.keyCode
		if (keyCode==32){
			return false
		}
		if (((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) && (keyCode<48 || keyCode>57))
			return false
	});


	$('.check_condition').on("keypress",function(event) {
//		if(event.which==44 || event.which==47 || event.which==45 || event.which==92 || event.which==37 || event.which==38 || event.which==33 || event.which==126 || event.which==64 || event.which==35 || event.which==36 || event.which==42 || event.which==123 || event.which==125 || event.which==91 || event.which==93 || event.which==40 || event.which==41 || event.which==60 || event.which==62 || event.which==59 || event.which==58 || event.which==39 || event.which==34 || event.which==43 || event.which==95 || event.which==94 || event.which==92 || event.which==63 || event.which==46){
//			return false;
//		}

	});
	$(".check_condition").bind("paste", function(e) {
		return false;
	});
	$(".nopaste").bind("paste", function(e) {
		return false;
	});
	$(".numeric").bind("paste", function(e) {
		return false;
	});


	$('.onelength').on("keypress",function(event) {
		if(event.which){
			var skillarr = $(this).val().split(" ");
			if(skillarr.length>1 && event.which!=8){
				return false;
			}
		}
	});

	$('.twolength').on("keypress",function(event) {
		if(event.which){
			var skillarr = $(this).val().split(" ");
			if(skillarr.length>2 && event.which!=8){
				return false;
			}
		}
	});

	$('.threelength').on("keypress",function(event) {
		if(event.which){
			var skillarr = $(this).val().split(" ");
			if(skillarr.length>3 && event.which!=8){
				return false;
			}
		}
	});
	$('.fourlength').on("keypress",function(event) {
		if(event.which){
			var skillarr = $(this).val().split(" ");
			if(skillarr.length>4 && event.which!=8){
				return false;
			}
		}
	});

	$('.fivelength').on("keypress",function(event) {
		if(event.which){
			var skillarr = $(this).val().split(" ");
			if(skillarr.length>5 && event.which!=8){
				return false;
			}
		}
	});

	$('.sixlength').on("keypress",function(event) {
		if(event.which){
			var skillarr = $(this).val().split(" ");
			if(skillarr.length>6 && event.which!=8){
				return false;
			}
		}
    });

    $('.tenlength').on("keypress",function(event) {
		if(event.which){
			var skillarr = $(this).val().split(" ");
			if(skillarr.length>10 && event.which!=8){
				return false;
			}
		}
    });

    $('[type=text].select3-multiple-input').bind("keypress",function(event) {
		if(event.which){
			var skillarr = $(this).val().split(" ");
			if(skillarr.length>5 && event.which!=8){
				return false;
			}
		}
	});

});
