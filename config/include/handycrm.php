<!-- HandyCRM -->
 <!--<div id="idcrm_vidos" class="form-group">
	 <label class="col-sm-3 control-label" >Видеоинструкция: </label><div class="col-sm-9">
	 <p class="form-control-static"><a target="_blank" href="?page=help#eautopay">Видеоинструкция по подключению (откроется в новой вкладке)</a></p></div></div>
	  <div id="idcrm_group" class="form-group">
    <label class="col-sm-3 control-label"><strong>Примечание.</strong></label><div class="col-sm-9">
<small>Чтобы получить ключи в аккаунте администратора перейдите в раздел <strong>"Настройки"-"Настройки API".</strong><br>
Для получения <strong>user_api_key</strong> отметьте чек-бокс "Разрешить использование API-интерфейсов"<br>
Для получения <strong>customer_api_key</strong> отметьте чек-бокс "Разрешить получение всех заказов через API-интерфейс"</small> </div></div>
 
-->

	 <br><br>
	  <div id="crm_url_group" class="form-group">
	 <label class="col-sm-3 control-label" for="crm_url">Ссылка на СРМ:<br>
	 </label><div class="col-sm-9"><input group="crmt" required class="form-control"  id="crm_url" type="url" name="crm_url" value="<?php echo   $crm_url ?>" placeholder="Ссылка на СРМ"></div>
 </div> 
 
 <div id="uid_group" class="form-group">
	 <label class="col-sm-3 control-label" for="uid">Ключ АПИ:<br><span>uid_key</span> 
	 </label><div class="col-sm-9"><input group="crmt" required class="form-control"  id="uid" type="num" name="uid" value="<?php echo   $uid ?>" placeholder="Ключ доступа"></div>
 </div>
	  <div id="api_key_group" class="form-group">
	 <label class="col-sm-3 control-label" for="api_key">Ваш личный ключ доступа: <br><span>api_key</span>
	
	 </label><div class="col-sm-9"><input class="form-control"  id="idu" type="text" name="idu" group="crmt" required value="<?php echo   $idu ?>" placeholder="Ключ доступа api_key"></div>
 </div>
 <div id="oid_group" class="form-group">
	<? if (isset($oid)) { ?>
<label class="col-sm-3 control-label" for="oid">Оффис:<br> </label><div class="col-sm-9">
	<input class="form-control"  id="oid" type="text" name="oid" group="crmt" required value="<?php echo   $oid ?>" placeholder="Код оффиса">
</div>
	<? } ?>
 </div> 
 <div id="prod_id_group" class="form-group">
	 <? if (isset($prod_id)) { ?>
<label class="col-sm-3 control-label" for="oid">Продукт:<br> </label><div class="col-sm-9">
	<input class="form-control"  id="prod_id" type="text" name="prod_id" group="crmt" required value="<?php echo   $prod_id ?>" placeholder="Код продукта">
</div>
	<? } ?>
 </div> 
 </div>


<div class="form-group">
	<center>
	<a onclick="hcrm(''); return false;" class="btn btn-default">
		<? if (isset($oid)) { ?> Обновить <? } else {?>Получить <? } ?>данные для интеграции</a>
	</center>
</div> 


 <script>
	function hcrm(ofi)
	{
		$('#prod_id_group').html('');
		var uid_key=$("#uid").val();
		var idu_key=$("#idu").val();
		var crm_url=$("#crm_url").val();
		if (ofi!="") {var ofice=ofi;} else {var ofice=0;}
		if ((uid_key!="") || (idu_key!="") || (crm_url!="")) {
			
		 $.ajax({
          type: 'POST',
          url: 'options/hcrm.php',
        ///  dataType: 'json',
          data: {uid_key, idu_key,crm_url, ofice},
          success: function(data) {
          	if (ofice==0){
          $('#oid_group').html(data);
      } else 
      {
      	 $('#prod_id_group').html(data);
      }
            console.log(data);
          },
          error:  function(xhr, str){
    console.log('Возникла ошибка: ' + xhr.responseCode);
          }
        });
		} else {
			console.log('Пусто');
		}
	}
</script>
	

	  