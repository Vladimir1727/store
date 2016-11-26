(function($){$(function(){
$('body').append('<div class="snow"></div>');

$('.snow').css({
	width:'100px',
	height:'100px',
	background:'url("images/snow1.png")',
	backgroundSize:'cover',
	position:'fixed'
});
var x=100;
var dx=0;
var i=0;
var y=-150;
$('.snow').css({top:(y+'px'),left:(x+'px')});
console.log(screen.height);
setInterval(function(){
y = (y>screen.height) ? -150:y+10;
if (i++>5) {
	dx=-10+Math.random()*20;
	i=0;
}
x+=dx;
$('.snow').css({top:(y+'px'),left:(x+'px')});
},100);

})})(jQuery)