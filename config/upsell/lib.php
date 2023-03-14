<?php

function serialize_products($data) {
	$result = '';
	
	if(!is_array($data) || count($data) == 0) {
		return $result;
	}
	
	foreach($data as $id => $row) {
		$result .= "~#" . $id . "#~\r\n";
		foreach($row as $key => $val) {
			$result .= $key . "::" . $val . "\r\n";
		}
	}
	
	return trim($result);
}

function unserialize_products($data) {
	$result = array();
	
	$data = trim($data);
	if($data == '') {
		return $result;
	}
	
	$data_rows = explode("\n", $data);
	foreach($data_rows as $row) {
		$row = trim($row);
		if($row == '') {
			continue;
		}
		if(preg_match('/^~#([0-9]+)#~$/', $row, $matches)) {
			$id = intval($matches[1]);
		}
		elseif(isset($id)) {
			$row_split = explode('::', $row);
			$key = trim($row_split[0]);
			unset($row_split[0]);
			$val = trim(implode('::', $row_split));
			if($key != '') {
				$result[$id][$key] = $val;
			}
		}
	}
	
	return $result;
}

function serialize_text_blocks($data) {
	$result = '';
	
	if(!is_array($data) || count($data) == 0) {
		return $result;
	}
	
	foreach($data as $key => $val) {
		$result .= $key . "::" . $val . "\r\n";
	}
	
	return trim($result);
}

function unserialize_text_blocks($data) {
	$result = array();
	
	$data = trim($data);
	if($data == '') {
		return $result;
	}
	
	$data_rows = explode("\n", $data);
	foreach($data_rows as $row) {
		$row = trim($row);
		if($row == '') {
			continue;
		}
		$row_split = explode('::', $row);
		$key = trim($row_split[0]);
		unset($row_split[0]);
		$val = trim(implode('::', $row_split));
		if($key != '') {
			$result[$key] = $val;
		}
	}
	
	return $result;
}

function normalize_file_name($name, $image_id) {
	
	$name = trim($name);
	$image_id = intval($image_id);
	
	if($name != '' && $image_id > 0) {
		$n = explode('.', $name);
		$name = 'i' . $image_id . '.' . $n[count($n) - 1];
	}
	
	return $name;
}
