<?php 
class JSONHandler {
	
	public function getFileContents($filename){
		$contents = file_get_contents($filename);
		
		$JSONArray = json_decode($contents, TRUE);
		
		return $JSONArray;
	}
	
	public function addToFile($filename, $data) {
		$json = json_encode($data);
		$sucess;
		
		if ($json)
			$sucess = file_put_contents($filename, $json, FILE_APPEND);
		
		if ($success)
			return TRUE;
		else
			return FALSE;
	}
	
	public function search($filename, $targetfield, $targetString){
		$arr = $this->getFileContents($filename);
		
		$val = array_search($targetString, array_column($arr,$targetfield));

		return $arr[$val];
	}
	
}
?>