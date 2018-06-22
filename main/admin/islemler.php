<?php 
include("../../scripts/connectVT.php");

$tip = @$_POST["tip"];

switch($tip){
	case "data":
		
			$onaylanan = $db->query("SELECT * FROM uyeler WHERE userConfirm = 1 && dateTime BETWEEN '2017-01-01' AND '2017-12-30'");
			$diger = $db->query("SELECT * FROM uyeler WHERE userConfirm = 0 && dateTime BETWEEN '2017-01-01' AND '2017-12-30'");


			$json["onaylanan"] = $onaylanan->rowCount();
			$json["diger"] = $diger->rowCount();

			$json["total"] = $diger->rowCount() + $onaylanan->rowCount();
			
			$date_array = array();
			$diger_array = array();



			foreach($onaylanan as $onay){
				$date = date("j M Y",strtotime($onay["dateTime"]));
				$kontrol = explode(' ',$date);
				if($kontrol[2] == 2017){
					array_push($date_array,$date);
				}
			}
			foreach($diger as $dg){
				$dy = date("j M Y",strtotime($dg["dateTime"]));
				$kontrol = explode(' ',$dy);
				if($kontrol[2] == 2017){
					array_push($diger_array,$dy);
				}
			}

			$json["onaylananDate"] = $date_array;
			$json["digerDate"] = $diger_array;

			
			
			$onaylanan2018 = $db->query("SELECT * FROM uyeler WHERE userConfirm = 1 && dateTime BETWEEN '2018-01-01' AND '2018-12-30'");
			$diger2018 = $db->query("SELECT * FROM uyeler WHERE userConfirm = 0 && dateTime BETWEEN '2018-01-01' AND '2018-12-30'");

			
			$json["totalDate2018"] = $diger2018->rowCount() + $onaylanan2018->rowCount();

			$date_array2018 = array();
			$diger_array2018 = array();

			foreach($onaylanan2018 as $on){
				$dd = date("j M Y",strtotime($on["dateTime"]));
				$kontrol = explode(' ',$dd);
				if($kontrol[2] == 2018){
					array_push($date_array2018,$dd);
				}
			}
			foreach($diger2018 as $do){
				$dl = date("j M Y",strtotime($do["dateTime"]));
				$kontrol = explode(' ',$dd);
				if($kontrol[2] == 2018){
					array_push($diger_array2018,$dl);
				}
			}

			$json["onaylananDate2018"] = $date_array2018;
			$json["digerDate2018"] = $diger_array2018;

			echo json_encode($json);



	break;


	case "uyeler":

		$kacar = 9;

		$nereden = ($_POST["id"] * $kacar) - $kacar;

		$maxsayfa = ceil($db->query("SELECT * FROM uyeler ")->rowCount() / 9);

		$sql = $db->query("SELECT id,username,email,dateTime,userConfirm FROM uyeler ORDER BY id,userConfirm DESC LIMIT $nereden,$kacar");



		$json["data"] = $sql->fetchAll();	
		$json["sayfa"] = $_POST["id"];
		$json["maxsayfa"] = $maxsayfa;
		echo json_encode($json);
	break;
	

	case "ara":
		 $veri = $_REQUEST["kelime"];

		 $ara = $db->query("SELECT id,username,email,dateTime,userConfirm FROM uyeler WHERE username LIKE '%$veri%'");

		 $json["data"] = $ara->fetchAll();

		 echo json_encode($json);



	break;


	case "detay":
			$user = $_REQUEST["user"];
			$sorgula = $db->query("SELECT * FROM uyeler WHERE username = '$user'")->fetch();

			$id = $sorgula["user_id"];
			$detay = $db->query("SELECT name,surname,gender,birthplace,job,socialMedia,about,profileImage FROM uyelerdetay WHERE user_id = '$id'");

			$json["durum"] = $detay->rowCount() ? true : false;
			if($detay->rowCount()){
			$json["data"] = $detay->fetch();
			}else{
				$json["data"] = false;
			}

			echo json_encode($json);

	break;

	case "blogFiltre":

		$tipleme = $_REQUEST["filtre"];
		
		$return = "";
		switch($tipleme){
			case "yazar":
			$return = "subject_author";
			break;

			case "kategori":
			$return = "subject_category";
			break;

			case "Goruntuleme":
			$return = "subject_view";
			break;

			case "Yayinlanan":
			$return = "subject_show";
			break;

			case "Tarih":
			$return = "subject_date";
			break;

			default: 

			$return = "hata";
			break;

		}	
		
		if($return != "hata" || $return != ""){
			$filtre = $db->query("SELECT * FROM blog ORDER BY $return DESC");
			$topla = "";
			if($filtre->rowCount()){
				foreach($filtre as $ft){
						$topla .= "<tr>";
                        $topla .= '<td><div class="custom-control custom-checkbox">';
                        $topla .= '<input type="checkbox" class="custom-control-input" data-id="'.$ft["subject_id"].'" id="customCheck1" style="width:20px;height:20px;">';
                        $topla .= '<label class="custom-control-label" for="customCheck1"></label>';
                        $topla .= '</div>';
                        $topla .= '</td>';
                        $topla .= '<td><img src="../../image/subjectImage/'.$ft["subject_image"].'" height="30" width="30"></td>';
                        $topla .='<td>'.$ft["subject_title"].'</td>';
                        $topla .='<td>'.$ft["subject_author"].'</td>';
                        $topla .='<td>'.$ft["subject_category"].'</td>';
                        $topla .='<td style="text-align:center;">'.($ft["subject_view"]).'</td>';
                        $topla .='<td>'.($ft["subject_show"] == 1 ? "YAYINDA" : "DEĞİL").'</td></tr>';
				}
				echo $topla;
			}
		}else{
			echo $topla;
		}


	break;

	case "yayindanKaldir":

		$data = $_REQUEST["array"];
		$idler ="";
		$sonuc = false;
		foreach($data as $d){
			$guncel =$db->prepare("UPDATE blog SET subject_show = !subject_show WHERE subject_id IN( :idler )");

			$sonuc = $guncel->execute(array("idler"=>$d));
		}
		if($sonuc){echo "başarılı";}else { echo false;}

	break;

	case "blogCommentData":
		$id = $_REQUEST["cid"];
		$sorgu = $db->query("SELECT * FROM blogcomment INNER JOIN blog ON blogcomment.blog_id = blog.subject_id WHERE bc_id = '$id'");
		if($sorgu->rowCount()){
			foreach($sorgu as $s){
				$json["comment"] =  $s["comment"];
				$json["konubaslik"] = $s["subject_title"];
				//$json["id"] = $s[""]
			}
		}
		echo json_encode($json);
		
	break;


	case "bcUp":

		$id = $_REQUEST["uid"];
		$up = $db->prepare("UPDATE blogcomment SET commentShow = 1 WHERE bc_id = :mid ");
		$sonuc = $up->execute(array("mid" => $id));
		if($sonuc){ echo true; }else{ echo false; }

	
	break;

	case "bcDel":
		$id = $_REQUEST["uid"];
		$up = $db->prepare("UPDATE blogcomment SET karantina = 1 WHERE bc_id = :mid ");
		$sonuc = $up->execute(array("mid" => $id));
		if($sonuc){ echo true; }else{ echo false; }

	break;

	case "bcInterval":

		 $data = $db->query("SELECT * FROM blogcomment INNER JOIN blog ON blogcomment.blog_id=blog.subject_id WHERE blogcomment.commentShow = 0 && blogcomment.karantina = 0 ORDER BY commentDate DESC  ");
                      $say = 1;
                      $total = "";
                      if($data->rowCount()){
                        foreach($data as $dt){

                          $total .= "<tr class=''>";
                          $total .= "<td>".($say++)."</td>";
                          $total .= "<td class='col-sm-3 col-md-3 col-lg-3'>".($dt["subject_title"])."</td>";
                          $total .= "<td class='col-sm-1 col-md-1 col-lg-1' style='font-weight: bold;'>".(strlen($dt["author"]) > 10 ? substr($dt["author"],0,10)."..." : $dt["author"] )."</td>";
                          $comment = strlen($dt["comment"]) > 20 ? substr($dt["comment"],0,20)."..." : $dt["comment"];
                          $total .= "<td class='col-sm-3 col-md-3 col-lg-3'>".($comment)."</td>";
                          $date = date('D M j',strtotime($dt["commentDate"]));
                          $date = date('D M j') == $date ? "Bugün" : $date;
                          $total .= "<td class='col-sm-1 col-md-1 col-lg-1'>".$date."</td>";
                          $total .= '<td><button type="button" class="btn btn-primary" data-id="'.$dt["bc_id"].'" data-toggle="modal" data-target=".modal-sm2" id="myModal" onclick="blogCommentDetail(this)">Detaylar</button></td>';
                          $total .= "</tr>";
                        }
                      }else{
                      	  $total .= "<tr class='success'>";
                          $total .= "<td>".($say++)."</td>";
                          $total .= "<td class='col-sm-3 col-md-3 col-lg-3'>NONE</td>";
                          $total .= "<td class='col-sm-1 col-md-1 col-lg-1' style='font-weight: bold;'>NONE</td>";
                          $total .= "<td class='col-sm-3 col-md-3 col-lg-3'>NONE</td>";
                          $total .= "<td class='col-sm-1 col-md-1 col-lg-1'>NONE</td>";
                          $total .= '<td><button type="button" class="btn btn-danger">NONE</button></td>';
                          $total .= "</tr>";

                      }
                      $json["data"] = $total;
                      $json["total"] = $data->rowCount();
                      echo json_encode($json);

	break;
	
	default:

		$total = $db->query("SELECT COUNT(b.subject_id) AS ct ,b.subject_title as konu,bc.author FROM blog AS b ,blogcomment AS bc WHERE b.subject_id = bc.blog_id GROUP BY b.subject_id")->fetchAll();
		foreach($total as $t){
			echo $t["author"];
			echo $t["ct"]." -> ".$t["konu"]."<br>";
		}

	break;
}


?>