<?php 
class JSONHandler {
	
	public function getFileContents($filename){
		
		#check that file exists else throws an exception
		if (!file_exists($filename))
			throw new Exception($filename . " does not exist.");
		
		$contents = file_get_contents($filename);
		
		$JSONArray = json_decode($contents, TRUE);
		
		#checks to see if json_decode returns anything, else throws a format exception
		if (!$JSONArray)
			throw new Exception($filename . " is not in correct JSON format.");
		
		return $JSONArray;
	}
	
	public function addToFile($filename, $data) {
		
		if (file_exists($filename)) {

			$existing = $this->getFileContents($filename);

			$data = array_merge($existing, $data);
			
		}
		
		$json = json_encode($data);
		
		file_put_contents($filename, $json);
	}
	
	public function search($filename, $targetfield, $targetString){
		$arr = $this->getFileContents($filename);
		
		#array search which returns the index of the value in which was found
		$val = array_search($targetString, array_column($arr,$targetfield));
		
		if (!$val)
			return NULL;
		
		return $arr[$val];
	}
}
?>