$(function(){$.fn.clearTextLimit=function(){return this.each(function(){this.onkeydown=this.onkeyup=null})},$.fn.textLimit=function(t,e){if("function"!=typeof e)var e=function(){};return this.each(function(){this.limit=t,this.callback=e,this.onkeydown=this.onkeyup=function(){return this.value=this.value.substr(0,this.limit),this.reached=this.limit-this.value.length,this.reached=0==this.reached,this.callback(this.value.length,this.limit,this.reached)}})}}),$(document).ready(function(){var t,e=$("#cabinet-article").val(),i=255;void 0!=e&&e.length>0&&void 0!=e&&(t=i-e.length,$(".count").text(t+" caractères restants")),$("#cabinet-article").textLimit(i,function(e,i,n){t=i-e,e==i?$(".count").text(t+" caractère restant"):$(".count").text(t+" caractères restants")}),$(".delete").click(function(){if(!confirm("Êtes-vous sur de vouloir supprimer l'élément?"))return!1}),$(".add").click(function(){var t=$(".to_add").val();0==!t.length&&($(".story__form ul").append('<li class="list__item"><span>'+t+'</span><span class="delete"><i class="material-icons">clear</i></span></li>'),$(".story__form").append('<input type="hidden" name="item[]" value="'+t+'"/>'),$(".to_add").val(""))}),window.location.href.indexOf("admin/storytelling/edit")!==-1&&($(document).on("click",".story__form .delete",function(){var t=$(this).prev().text();$('input[value="'+t+'"]').remove(),$(this).parent().remove()}),$(document).on("keydown",function(t){var e=t.keyCode||t.which;13==e&&t.preventDefault()}),$(".to_add").on("keydown",function(t){var e=t.keyCode||t.which;if(13==e){var i=$(this).val();$(".story__form ul").append('<li class="list__item"><span>'+i+'</span><span class="delete"><i class="material-icons">clear</i></span></li>'),$(".story__form").append('<input type="hidden" name="item[]" value="'+i+'"/>'),$(".to_add").val("")}}))});