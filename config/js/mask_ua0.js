﻿$(document).ready(function(){
   $("input[name=phone]").mask("\+38(099) 999-99-99", {placeholder: "+38(0__) ___-__-__"});   
   $("input[name=tel]").mask("\+38(099) 999-99-99", {placeholder: "+38(0__) ___-__-__"});  
	var max=$("input[name=phone]").attr("maxlength"); $("input[name=phone]").prop("minlength",max);
   var max=$("input[name=tel]").attr("maxlength"); $("input[name=tel]").prop("minlength",max);   
   });