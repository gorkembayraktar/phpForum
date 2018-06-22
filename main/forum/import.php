<?php 


$tip = @$_POST["tip"];


switch ($tip) {
	case 'update':
		include("../../scripts/connectVT.php");
		$veri = @$_POST["id"];
		$sql = $db->prepare("UPDATE forumsection SET sectionShow = !sectionShow WHERE frm_id = :frm_id");

		$sonuc= $sql->execute(array("frm_id"=>$veri));
		if($sonuc){$json["sonuc"] = true;}
		else{$json["sonuc"] = false;}
		$db=null;
		echo json_encode($json);
	break;

	case 'parent':

			include("../../scripts/connectVT.php");
			$veri = $_POST["parentid"];
			$sql = $db->prepare("UPDATE forumsectionparent SET parent_show = !parent_show WHERE fsp_id = :fsp_id");
			$sonuc=$sql->execute(array("fsp_id"=> $veri));
			if($sonuc){$json["sonuc"] = true;}else{$json["sonuc"] = false;}
			$db=null;

			echo json_encode($json);

	break;
	
	case "save":
		include("../../scripts/connectVT.php");
		for($i=0;$i<count($_POST["data"]);$i++){
			$exp = explode(',',$_POST["data"][$i]); // exp[0]->indis,   exp[1]->id
			//echo $exp[1];		
			
			$update = $db->prepare("UPDATE forumsection SET sectionIndis = :indis WHERE frm_id = :id");
			$sonuc = $update->execute(array("indis" => $exp[0],
											"id" => $exp[1] ));
			
		}
		echo $sonuc ? true : false;

	break;

	default:
		# code...
		echo "hata var ?";
		break;
}


?>