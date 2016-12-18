(function($){$(function(){



$("#tabs").tabs();

$.fn.try_add=function(arr){//функция проверки на пустые поля при нажатии кнопки
var butt=this;
	butt.click(function(){
		var f=true;
		for (var i = arr.length - 1; i >= 0; i--){
			test=$("#"+arr[i]);
			if (test.val().length>0) test.val(test.val().trim());
			if (test.val().trim().length<1 || test.val().trim()=="0"){
				test.css({"border":"1px red solid"})
				f=false;
			}
			else test.css({"border":"1px #ccc solid"});
		}
	if (f==true) return true;
	return false;
	});
}

//вкладка категорий
$('#add_cat').try_add(['input_cat']);
$('#add_sub').try_add(['input_sub','sel_cat1']);
//вкладка товара
$('#add_item').try_add(['itemname','pricein','pricesale','info','sel_cat2','subid','itempic']);
//вкладка картинки
$('#addpics').try_add(['sel_cat3','subid2','itemlist','files']);
//регистрация
$('#adduser').try_add(['pass1','pass2','login','file_pic']);
$('#enter').try_add(['login0','pass0']);

var max=parseInt($("#smax").text());
var min=parseInt($("#smin").text());
var bdmin=parseInt($("#bdmin").text());
var bdmax=parseInt($("#bdmax").text());
console.log(min,max,bdmin,bdmax);
$( "#slider" ).slider({
	range: true,
	step:10,
	min:0,
	max:100000
});
$("#slider").slider( "option", "min", bdmin );
$("#slider").slider( "option", "max", bdmax );
$("#slider").slider( "values", [ min, max ] );

$( "#slider" ).slider({
  change: function( event, ui ) {
  	$('#smin').text(ui.values[0]);
  	$('#smax').text(ui.values[1]);
  }
});

$('#showminmax').click(function(){
	document.location='index.php?page=2&min='+$('#smin').text()+'&max='+$('#smax').text();
	return false;
});

})})(jQuery)