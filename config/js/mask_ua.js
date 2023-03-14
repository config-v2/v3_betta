$(document).ready(function(){
	let max=18;
   $("input[name=phone]").mask("\+38(999) 999-99-99", {placeholder: "+38(___) ___-__-__"}).attr("maxlength",max).attr("minlength",max);   
   $("input[name=tel]").mask("\+38(999) 999-99-99", {placeholder: "+38(___) ___-__-__"}).attr("maxlength",max).attr("minlength",max);
  
  
  });


   
   