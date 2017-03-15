<?php 
include("../lib/JSONHandler.php");

$monarchsfile = "../database/monarchs.json";
$jh = new JSONHandler;

$readertest = $jh->getFileContents($monarchsfile);

echo var_dump($readertest);

?>