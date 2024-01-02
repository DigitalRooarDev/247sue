<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('bunnycdn-storage.php');

if(isset($_REQUEST['submit'])){ 
$bunnyCDNStorage = new BunnyCDNStorage("247sue", "6b769d6b-7baf-4c60-901e24d7dda9-aa61-4ff2");

$reponse = $bunnyCDNStorage->uploadFile($_FILES['url']['tmp_name'], "/247sue/video/". time().'_'.$_FILES['url']['name']);

print_r($reponse);
}
?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="url" />
<input type="submit" name="submit" value="save"/> 
</form>