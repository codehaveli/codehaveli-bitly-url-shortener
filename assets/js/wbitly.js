( function( $, window, undefined ) {


	$(".copy_bitly").mouseout(function(){
	   $('.copy_bitly_tooltiptext').html("Click to Copy"); 
	});


	$('body').on('click', '.copy_bitly', function(event) {
		 event.preventDefault();
		 $url = $(this).parent().find('p').html();
		 var $temp = $("<input>");
		 $("body").append($temp);
		 $temp.val($url).select();
		 document.execCommand("copy");
		 $temp.remove();
		 $('.copy_bitly_tooltiptext').html("Copied: "+$url); 

	});

}( jQuery, window ));