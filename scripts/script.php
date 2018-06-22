<?php 
include("connectVT.php");
//bağlantı sağlandı

$tip = @$_POST["tip"];

switch($tip){
	case "blog":
		$data =  json_decode(@$_POST["tag"]);
		$tag = "";
		foreach($data as $f){$tag.=$f.",";}
		$konubaslik = @$_POST["konubaslik"];
		$kategori = @$_POST["kategori"];
		$icerik = @$_POST["icerik"];

		$konu_link =  $konubaslik;
		$konu_link = mb_strtolower($konu_link,"UTF-8");
		$konu_link = str_replace("ı","i", $konu_link);
		$konu_link = str_replace("ş","s", $konu_link);
		$konu_link = str_replace("ç","c", $konu_link);
		$konu_link = str_replace("ü","u", $konu_link);
		$konu_link = str_replace("ö","o", $konu_link);
		$konu_link = str_replace("ğ","g", $konu_link);
		$konu_link = str_replace(" ","-", $konu_link);
		$konu_link = mb_strtolower($konu_link,"UTF-8");

		$konu_id = rand(000,999999);
		$konu_yazan = "@admin";

		$konu_link = $konu_link."-".$konu_id;
		if(!empty($konubaslik) && !empty($icerik) && !empty($kategori) && !empty($tag)){
				$ekle=$db->prepare("INSERT INTO blog SET subject_id = :si,
												 subject_title = :st,
												 subject_content = :sc,
												 subject_author = :sa,
												 subject_category = :subc,
												 subject_link = :sl,
												 subject_tag = :stag");

				$sonuc = $ekle->execute(array("si"=>$konu_id,
									  "st"=>$konubaslik,
									  "sc"=>$icerik,
									  "sa"=>$konu_yazan,
										"subc"=>$kategori,
										"sl"=>$konu_link,
										"stag"=>$tag));

			if($sonuc){
				$json["durum"] = true;
				$json["link"] = $konu_link;
				$json["baslik"] = $konubaslik;
			}
			else{
				$json["durum"] = false;
				$json["link"] = "";
				$json["baslik"] = "";
				
			}
		}else{
			$json["durum"] = false;
			$json["link"] = "";
			$json["baslik"] = "";
		}
		echo json_encode($json);
		$db=null;
	break;

	case "newblog":
		$title_link = @$_POST["url"];
		try{
		$query = $db->query("SELECT * FROM blog WHERE subject_link = '$title_link'")->fetch();
		$id = (int)($query["id"]) - 1;
		$sql = $db->query("SELECT * FROM blog WHERE id='$id'")->fetch();

		$json["link"] = $sql["subject_link"];
		$json["title"] = $sql["subject_title"];
		$json["content"] = $sql["subject_content"];
		$json["author"] = $sql["subject_author"];
		$json["category"] = $sql["subject_category"];
		$json["image"] = $sql["subject_image"];
		$json["date"] = $sql["subject_date"];
		$json["subject_tag"] =$sql["subject_tag"];
		}catch(Exception $e){
		$json["link"] = "";
		$json["title"] = "";
		$json["content"] ="";
		$json["author"] = "";
		$json["category"] = "";
		$json["image"] = "" ;
		$json["date"] = "";
		$json["subject_tag"] = "";
		}

		echo json_encode($json);


	break;

	case "comment":
		$id = $_REQUEST["id"];
		$parcala = explode("-",$id);

		$id = $parcala[count($parcala)-1];
		
		$comment = $_REQUEST["comment"];
		$author = $_REQUEST["author"];
		$machine = $_REQUEST["machine"];

		function GetIP(){
			if(getenv("HTTP_CLIENT_IP")) {
		 		$ip = getenv("HTTP_CLIENT_IP");
		 	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
		 		$ip = getenv("HTTP_X_FORWARDED_FOR");
		 		if (strstr($ip, ',')) {
		 			$tmp = explode (',', $ip);
		 			$ip = trim($tmp[0]);
		 		}
		 	} else {
		 	$ip = getenv("REMOTE_ADDR");
		 	}
			return $ip;
		}

		$b = $db->prepare("INSERT INTO blogcomment SET blog_id = :id, author = :author, comment = :comment, author_Ip = :aip, author_machine = :author_machine");
		$b = $b->execute(array("id" => $id,
							   "author" => $author,
							    "comment" => $comment,
							 	"aip" => GetIP(),
							 	"author_machine" => $machine ));
		


	break;

	default:
		echo "İletilen mesaj bulunamadı";
		$db=null;
	break;

}

?>