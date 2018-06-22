<?php 

include("../scripts/connectVT.php");


class Uye{

	public function user(){
		return $this->username;
	}
	public function rutbe(){
		if($this->rank == 1){
			return '<span style="color:red">Yetkili</span>';
		}else{
			return 'Kullanıcı';
		}
	}
	public function id(){
		return $this->id;
	}
	public function tarih(){
		return $this->dateTime;
	}
	function delete($veri){
		include("../scripts/connectVT.php");
		$sil = $db->prepare("DELETE FROM uyeler WHERE id= :id");
		$sonuc = $sil->execute(array("id"=>$veri));
		if($sonuc){
			return $veri.'id\'li kullanıcı yeryüzünden silindi';
		}else{
			return '1 hata olabilir';
		}


	}

}
?>

<?php
$query = $db->query("SELECT * FROM uyeler ORDER BY id ASC limit 0,20 ");
$query->setFetchMode(PDO::FETCH_CLASS,'Uye');
foreach($query as $row){
	echo $row->id()."-/".$row->user()."\t".$row->rutbe()."\t".$row->tarih()."<form method='post'><input type='hidden' name='test' value='$row->id'><input type='submit' value='Sil'></form>";
}

if(!empty($_POST)){
	$str = new Uye();
	echo $str->delete($_POST["test"]);

}

?>
