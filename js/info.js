(function($){$(function(){



$('#show_feed').click(function(){
	$('#feedback').toggle();
	$('#item_info').toggle();
	if ($('#show_feed').val()=='отзывы') $('#show_feed').val('ИНФО');
		else $('#show_feed').val('отзывы');
	return false;
});


})})(jQuery)