<?php
require_once(__DIR__ . '/lib.php');

$result = '';

$action = trim($_REQUEST['action']);

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	switch($action) {
		case 'get_products':
			
			$data = file_get_contents(__DIR__ . '/products.data');
			$products = unserialize_products($data);
			
			foreach($products as $product_id => $product) {
				$result .= '<form class="products-form card card-body">
					<div class="form-group row">
						<label for="product-name" class="col-sm-2 col-form-label">Название товара</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="product-name-' . $product_id . '" name="product-name" value="' . str_replace("<br>", "\r\n", $product['name']) . '">
						</div>
					</div>
					<div class="form-group row">
						<label for="product-description" class="col-sm-2 col-form-label">Описание товара</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="product-description-' . $product_id . '" name="product-description" rows="3">' . str_replace("<br>", "\r\n", $product['description']) . '</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="product-old-price" class="col-sm-2 col-form-label">Старая цена</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="product-old-price-' . $product_id . '" name="product-old-price" value="' . str_replace("<br>", "\r\n", $product['old_price']) . '">
						</div>
					</div>
					<div class="form-group row">
						<label for="product-price" class="col-sm-2 col-form-label">Цена</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="product-price-' . $product_id . '" name="product-price" value="' . str_replace("<br>", "\r\n", $product['price']) . '">
						</div>
					</div>
					<div class="form-group row">
						<label for="product-discount" class="col-sm-2 col-form-label">Скидка</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="product-discount-' . $product_id . '" name="product-discount" value="' . str_replace("<br>", "\r\n", $product['discount']) . '">
						</div>
					</div>
					<div class="form-group row">
						<label for="product-image" class="col-sm-2 col-form-label">Изображения</label>
						<div class="col-sm-1">
							<img class="product-image" src="' . $product['image1'] . '">
							<img class="product-image" src="' . $product['image2'] . '">
							<img class="product-image" src="' . $product['image3'] . '">
							<img class="product-image" src="' . $product['image4'] . '">
							<img class="product-image" src="' . $product['image5'] . '">
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-secondary btn-sm del-image" data-image-id="1" title="Удалить"' . ($product['image1'] == '' ? ' disabled' : '' ) . '><i class="fa fa-times" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-secondary btn-sm del-image" data-image-id="2" title="Удалить"' . ($product['image2'] == '' ? ' disabled' : '' ) . '><i class="fa fa-times" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-secondary btn-sm del-image" data-image-id="3" title="Удалить"' . ($product['image3'] == '' ? ' disabled' : '' ) . '><i class="fa fa-times" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-secondary btn-sm del-image" data-image-id="4" title="Удалить"' . ($product['image4'] == '' ? ' disabled' : '' ) . '><i class="fa fa-times" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-secondary btn-sm del-image" data-image-id="5" title="Удалить"' . ($product['image5'] == '' ? ' disabled' : '' ) . '><i class="fa fa-times" aria-hidden="true"></i></button>
						</div>
						<div class="col-sm-4">
							<input type="file" class="form-control-file" name="product-image[1]">
							<input type="file" class="form-control-file" name="product-image[2]">
							<input type="file" class="form-control-file" name="product-image[3]">
							<input type="file" class="form-control-file" name="product-image[4]">
							<input type="file" class="form-control-file" name="product-image[5]">
						</div>
						
					</div>
					<div class="form-group text-center">
						<input type="hidden" name="product-id" value="' . $product_id . '">
						<button class="btn btn-primary" type="submit">Сохранить</button>
						<button class="btn btn-primary del-product" type="button">Удалить</button>
					</div>
				</form><br>';
			}
			
			$result .= '<form class="card card-body">
				<div class="text-center">
					<button class="btn btn-primary add-product" type="button">Добавить новый товар</button>
				</div>
			</form>';
			
		break;
		
		case 'add_product':
			
			$data = file_get_contents(__DIR__ . '/products.data');
			$products = unserialize_products($data);
			
			if(is_array($products) && count($products) > 0) {
				$product_id_new = max(array_keys($products)) + 1;
			}
			else {
				$product_id_new = 1;
			}
			
			$products[$product_id_new] = array(
				'name' => '',
				'description' => '',
				'old_price' => '',
				'price' => '',
				'discount' => '',
				'image1' => '',
				'image2' => '',
				'image3' => '',
				'image4' => '',
				'image5' => '',
			);
			ksort($products);
			$data = serialize_products($products);
			$res = file_put_contents(__DIR__ . '/products.data', $data);
			if($res !== false) {
				$result = 'Товар успешно добавлен!';
			}
			else {
				$result = 'Ошибка!';
			}
			
		break;
		
		case 'del_product':
			
			$data = file_get_contents(__DIR__ . '/products.data');
			$products = unserialize_products($data);
			
			$product_id = intval($_POST['product_id']);
			
			if($product_id > 0) {
				unset($products[$product_id]);
				ksort($products);
				$data = serialize_products($products);
				$res = file_put_contents(__DIR__ . '/products.data', $data);
				if($res !== false) {
					$result = 'Товар успешно удален!';
				}
				else {
					$result = 'Ошибка!';
				}
			}
			else {
				$result = 'Ошибка!';
			}
			
		break;
		
		case 'edit_product':
			
			$data = file_get_contents(__DIR__ . '/products.data');
			$products = unserialize_products($data);
			
			$product_id = intval($_POST['product-id']);
			
			$product_images = $_FILES['product-image'];
			$valid_image_types = array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif');
			$images = array();
			
			if($product_id > 0) {
				
				if(is_array($product_images['name']) && count($product_images['name']) > 0) {
					foreach($product_images['name'] as $image_id => $image_name) {
						if($image_name != '' 
							&& $product_images['tmp_name'][$image_id] != '' 
							&& $product_images['error'][$image_id] == 0 
							&& $product_images['size'][$image_id] > 0
							&& in_array($product_images['type'][$image_id], $valid_image_types)
						) {
							$image_name = normalize_file_name($image_name, $image_id);
							$image_path = 'img/p' . $product_id;
							$image_file = $image_path . '/' . $image_name;
							if(!is_dir($image_path)) {
								mkdir($image_path);
								chmod($image_path, 0777);
							}
							if(copy($product_images['tmp_name'][$image_id], __DIR__ . '/' . $image_file)) {
								$images[$image_id] = $image_file;
							}
						}
					}
				}
				
				$products[$product_id] = array(
					'name' => str_replace("\r\n", "<br>", $_POST['product-name']),
					'description' => str_replace("\r\n", "<br>", $_POST['product-description']),
					'old_price' => str_replace("\r\n", "<br>", $_POST['product-old-price']),
					'price' => str_replace("\r\n", "<br>", $_POST['product-price']),
					'discount' => str_replace("\r\n", "<br>", $_POST['product-discount']),
					'image1' => isset($images[1]) ? $images[1] : $products[$product_id]['image1'],
					'image2' => isset($images[2]) ? $images[2] : $products[$product_id]['image2'],
					'image3' => isset($images[3]) ? $images[3] : $products[$product_id]['image3'],
					'image4' => isset($images[4]) ? $images[4] : $products[$product_id]['image4'],
					'image5' => isset($images[5]) ? $images[5] : $products[$product_id]['image5'],
				);
				ksort($products);
				$data = serialize_products($products);
				$res = file_put_contents(__DIR__ . '/products.data', $data);
				if($res !== false) {
					$result = 'Товар успешно сохранен!';
				}
				else {
					$result = 'Ошибка!';
				}
			}
			else {
				$result = 'Ошибка!';
			}
			
		break;
		
		case 'del_image';
		
			$data = file_get_contents(__DIR__ . '/products.data');
			$products = unserialize_products($data);
			
			$product_id = intval($_POST['product_id']);
			$image_id = intval($_POST['image_id']);
			
			if($product_id > 0 && $image_id > 0) {
				$products[$product_id]['image' . $image_id] = '';
				ksort($products);
				$data = serialize_products($products);
				$res = file_put_contents(__DIR__ . '/products.data', $data);
				if($res !== false) {
					$result = 'Изображение успешно удалено!';
				}
				else {
					$result = 'Ошибка!';
				}
			}
			else {
				$result = 'Ошибка!';
			}
		
		break;
		
		case 'get_text_blocks':
			
			$data = file_get_contents(__DIR__ . '/text_blocks.data');
			$text_blocks = unserialize_text_blocks($data);
			
			$result .= '<form class="text-blocks-form card card-body">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="text-block-1">Текстовый блок 1</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="text-block-1" name="text-block-1" rows="2">' . str_replace("<br>", "\r\n", $text_blocks['block1']) . '</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="text-block-2">Текстовый блок 2</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="text-block-2" name="text-block-2" rows="2">' . str_replace("<br>", "\r\n", $text_blocks['block2']) . '</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="text-block-3">Текстовый блок 3</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="text-block-3" name="text-block-3" rows="2">' . str_replace("<br>", "\r\n", $text_blocks['block3']) . '</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="text-block-4">Текстовый блок 4</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="text-block-4" name="text-block-4" rows="2">' . str_replace("<br>", "\r\n", $text_blocks['block4']) . '</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="text-block-5">Текстовый блок 5</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="text-block-5" name="text-block-5" rows="2">' . str_replace("<br>", "\r\n", $text_blocks['block5']) . '</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="text-block-6">Текстовый блок 6</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="text-block-6" name="text-block-6" rows="2">' . str_replace("<br>", "\r\n", $text_blocks['block6']) . '</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="text-block-7">Текстовый блок 7</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="text-block-7" name="text-block-7" rows="2">' . str_replace("<br>", "\r\n", $text_blocks['block7']) . '</textarea>
					</div>
				</div>
				<div class="form-group text-center">
					<button class="btn btn-primary" type="submit">Сохранить</button>
				</div>
			</form>';
			
		break;
		
		case 'edit_text_blocks':
			
			$data = file_get_contents(__DIR__ . '/text_blocks.data');
			$text_blocks = unserialize_text_blocks($data);
			
			$text_blocks = array(
				'block1' => str_replace("\r\n", "<br>", $_POST['text-block-1']),
				'block2' => str_replace("\r\n", "<br>", $_POST['text-block-2']),
				'block3' => str_replace("\r\n", "<br>", $_POST['text-block-3']),
				'block4' => str_replace("\r\n", "<br>", $_POST['text-block-4']),
				'block5' => str_replace("\r\n", "<br>", $_POST['text-block-5']),
				'block6' => str_replace("\r\n", "<br>", $_POST['text-block-6']),
				'block7' => str_replace("\r\n", "<br>", $_POST['text-block-7']),
			);
			$data = serialize_text_blocks($text_blocks);
			$res = file_put_contents(__DIR__ . '/text_blocks.data', $data);
			if($res !== false) {
				$result = 'Успешно сохранено!';
			}
			else {
				$result = 'Ошибка!';
			}
			
		break;
		
		
	}
}

die($result);