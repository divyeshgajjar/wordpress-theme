//When the page is fully loaded
$(function(){
    //Change the opacity to 1
    $("body").css('opacity','1');
});

// ======================================================
   //MENU HIDE & SHOW
// ======================================================
   $(window).scroll(function () {
        
      var scroll = $(window).scrollTop();
      if (scroll < 500) {
        $(".navbar").removeClass("navbar-fixed-top"); }
      else{
        $(".navbar").addClass("navbar-fixed-top"); }
    });  // window scroll function end


	
	
	$( "#acf-field_5c8cafdd34eea" ).keypress(function() {   
		setTimeout(function(){ $('.acf-postbox').find("input[type='hidden']").prop("disabled", false); }, 1000);
	});
    $( "input[type='hidden']" ).change(function() {
		setTimeout(function(){ $('.acf-postbox').find("#acf-field_5c8cafdd34eea").prop("disabled", false); }, 1000);
	});

	
