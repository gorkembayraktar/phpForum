<?php 
include("../scripts/connectVT.php");
$sayfa = (is_numeric(@$_GET["sayfa"])?$_GET["sayfa"]:1) | 1;


$kacar = 1;
$nereden = ($sayfa * $kacar) - $kacar;
$ksayisi = $db->query("SELECT * FROM blog")->rowCount();
$ssayisi = ceil($ksayisi/$kacar);

$listele = $db->query("SELECT * FROM blog ORDER BY id DESC  limit $nereden,$kacar");
foreach($listele as $liste){
	echo $liste["subject_title"]."<br>";
}
echo "<br>SAYFA SAYISI:".$ssayisi."<br>";
$forlimit = 3;

if($sayfa >1){
	echo "<a style='padding:3px;color:white;background-color:black;margin-left:5px;text-decoration:none;' href='listeleme.php?sayfa=1'>İlk</a>";
	$up = $sayfa-1;
	echo "<a style='padding:3px;color:white;background-color:black;margin-left:5px;text-decoration:none;' href='listeleme.php?sayfa=$up'>Önceki</a>";
}

for($i = $sayfa - $forlimit;$i<$sayfa+$forlimit+1;$i++){
	if($i>0 && $i<$ssayisi){
		if($i==$sayfa){
			echo "<a style='padding:3px;color:white;background-color:red;margin-left:5px;text-decoration:none;' href='listeleme.php?sayfa={$i}'>$i</a>";
		}else{
			echo "<a style='padding:3px;color:white;background-color:black;margin-left:5px;text-decoration:none;' href='listeleme.php?sayfa={$i}'>$i</a>";
		}
	}
	
}
if($ssayisi != $sayfa){
	$up = $sayfa+1;
	echo "<a style='padding:3px;color:white;background-color:black;margin-left:5px;text-decoration:none;' href='listeleme.php?sayfa=$up'>Sonraki</a>";
	echo "<a style='padding:3px;color:white;background-color:black;margin-left:5px;text-decoration:none;' href='listeleme.php?sayfa=$ssayisi'>Son</a>";
	
}


?>