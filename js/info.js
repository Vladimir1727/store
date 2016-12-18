(function($){$(function(){

$('#add_r').click(function(){
	if ($('#add_r').hasClass('disabled')){
			return false
		}
		else{
			if (parseInt($('sel_r').val())>0) return true;
		}
});

})})(jQuery)