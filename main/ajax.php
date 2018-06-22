<?php 
include("../scripts/connectVT.php");
//$href = explode('/',rtrim($_POST["href"],'/'));
$href = trim(@$_POST["href"]);
//$href = explode('.',@$_POST["href"]);

switch($href){
	case 'anasayfa':
		
		$json['title'] = "Hoş geldin gardaş";
		$json['content'] = "content";
		$json['author'] = "author";
		$json['category'] = "catregory";
		$json['image'] = "image";
		$json['date'] = "date";
		$json['link'] = "anasayfa";
	break;

	case 'blog':
		
		$json['title'] = "Blog Konusu";
		$json['content'] = "blog";
		$json['author'] = "author";
		$json['category'] = "catregory";
		$json['image'] = "image";
		$json['date'] = "date";
		$json['link'] = "blog";
	break;
	
	default:
		$bul = $db->query("SELECT * FROM blog WHERE subject_link = '$href'")->fetch();
		if($bul){
			
			$json['title'] = $bul["subject_title"];
			$json['content'] = $bul["subject_content"];
			$json['author'] = $bul['subject_author'];
			$json['category'] = $bul['subject_category'];
			$json['image'] = $bul['subject_image'];
			$json['date'] = $bul['subject_date'];
			$json['link'] = $bul['subject_link'];
		}else{

			$json['title'] = "404 Hatası-İstenilen sayfa bulunmadı";
			$json['content'] = "İstenilen Sayfa bulunamadi";
			$json['author'] = "none";
			$json['category'] = "none";
			$json['image'] ="../image/forumImage/404.png";
			$json['date'] = "none";
			$json['link'] = $href;

			$kontrol = explode('.',$href);
			if(end($kontrol) == "php"){$json["hata"] = true;}
			else{$json["hata"] = false;}
		}
	break;
	
		
}	
	
	
if($href != null){
echo json_encode($json);
}




?>