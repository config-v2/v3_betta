﻿$(document).ready(function(){
   $("input[name=phone]").mask("\ 8 (999) 999-99-99", {placeholder: "8 (___) ___-__-__"});   
   $("input[name=tel]").mask("\ 8 (999) 999-99-99", {placeholder: "8 (___) ___-__-__"});   
   var max=$("input[name=phone]").attr("maxlength"); $("input[name=phone]").prop("minlength",max);
   var max=$("input[name=tel]").attr("maxlength"); $("input[name=tel]").prop("minlength",max);
 
   });