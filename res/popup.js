/*
 * res/popup.js
 * LHS Math Club Website
 */

function popup(title,content){
	window.popupdiv = $('<div/>',{
		text:'<div>'+title+'</div>'+content
	}).appendTo('body');
}
function popin(){
	window.popupdiv.remove();
}