<?php 
try{
	$db=new PDO("mysql:host=localhost;dbname=forum","root","");
	$db->query("SET NAMES 'utf8'");

}
catch(PDOExpection $e){
	echo $e->Message();
}


?>