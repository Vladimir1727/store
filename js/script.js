(function($){$(function(){

$("#tabs").tabs();

$.fn.show_err=function(){//функция подсветки пустых полей
var test=this;
	test.blur(function(){
		test.val(test.val().trim());
		if (test.val().trim().length<1)	test.css({"border":"1px red solid"})
		else test.css({"border":"1px #ccc solid"});	
	});
}

$.fn.try_add=function(arr){//функция проверки на пустые поля при нажатии кнопки
var butt=this;
	butt.click(function(){
		for (var i = arr.length - 1; i >= 0; i--) {
			if (arr[i].val().trim().length<1 || arr[i].val().trim()=="0"){
				console.log('error');
				return false;
			}
		}
	return true;
	});
}

//вкладка категорий
$('#input_cat').show_err();
$('#add_cat').try_add([$('#input_cat')]);
$('#input_sub').show_err();
$('#add_sub').try_add([$('#input_sub'),$('#sel_cat1')]);
//вкладка товара
$('#itemname').show_err();
$('#pricein').show_err();
$('#pricesale').show_err();
$('#info').show_err();
$('#add_item').try_add([$('#itemname'),$('#pricein'),$('#pricesale'),$('#info'),$('#sel_cat2'),$('#subid'),$('#itempic')]);
//вкладка картинки

$('#addpics').try_add([$('#sel_cat3'),$('#subid2'),$('#itemlist'),$('#files')]);

})})(jQuery)