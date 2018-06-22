<?php include("../scripts/connectVT.php");
//setcookie("nightOrDay","default",time()-(86400*30),"/");
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">

 	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/css/mystil.css">

  <!--SWEET ALERT 2 Library-->
 <!-- <link rel="stylesheet" href="https://limonte.github.io/sweetalert2/dist/sweetalert2.min.css">
  <script src="https://limonte.github.io/sweetalert2/dist/sweetalert2.all.min.js"></script>
 -->
<!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- THE END--> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../bootstrap/js/custom.js"></script>
  <script>
   
    
    var position = $(window).scrollTop();

    $(window).scroll(function() {
      var scroll = $(window).scrollTop();

      if(scroll >500){
        if (scroll > position) {
          $(".navbar-inverse").css({"position":"relative","width":""});
           $(".row").css("margin-top","70px");
        } else {
          $(".navbar-inverse").css({"position":"fixed","width":"100%","top":"0px"});
          $(".container").css({"margin-top":"50px"});
          $(".row").css("margin-top","70px");
        }
        position = scroll;
      }
    });


    var deger = getCookie("nightorday") == "default" ? true:false;
    var arttir = 180;
    var dayOrNightFunc = function(){

        this.cookieSet = function(cname,cvalue,exdays){
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires="+ d.toUTCString();
            var veri1 = deger == true ? "default":"night";
            document.cookie = cname + "=" + veri1 + ";" + expires + ";path=/";
         }
      
      this.nightorDay =function(){
          if(deger){
            nightMode();
            deger = !deger; 
            this.cookieSet("nightorday","night",5);
            console.log("GECE MODU");
          }else{  
            dayMode();
            deger = !deger; 
            this.cookieSet("nightorday","default",5);
            console.log("GÜNDÜZ MODU");
          }

      }

      this.anime = function(veri){
       
        arttir += 180;
        veri.style ="transform:rotate("+(parseInt(arttir))+"deg);";


      }
  
    }
    
     function getCookie(name){
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length == 2) return parts.pop().split(";").shift();
            else return "none";
          }
     function nightMode(){
            $(".panel").css({"backgroundColor":"black"});
            $(".panel-body").css({"backgroundColor":"black"});
            $("body").css({"backgroundColor":"black","color":"white"});
            $(".well").css({"backgroundColor":"black","color":"white"});
            $("#footer").css({"backgroundColor":"white"});

     }
     function dayMode(){
            $(".panel").css({"backgroundColor":"white"});
            $(".panel-body").css({"backgroundColor":"white"});
            $("body").css({"backgroundColor":"white","color":"black"});
            $(".well").css({"backgroundColor":"white","color":"black"});
            $("#footer").css({"backgroundColor":"black"});
     }     

   
     
  </script>
</head>

<body>
<nav class="navbar navbar-inverse" style="z-index: 3">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myUser">
         <a href="#" onclick="return false;">
          <span class="glyphicon glyphicon-user" style="color:green;"></span>
        </a>
      </button>
      <a class="navbar-brand" href="../main">MyForum</a>
    </div>


    <div id="myUser">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Kayıt Ol</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Giriş</a></li>
          </ul>
   </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../main">Anasayfa</a></li>
        <li><a href="blog">Blog</a></li>
        <li><a href="forum/" class="mybtn btn-disabled" onclick="">Forum</a></li>
      </ul>
      <form class="navbar-form navbar-right">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Aranılan ..">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>
      </form>

      <ul class="nav navbar-right">
        <li><a  onclick="var nod = new dayOrNightFunc();nod.nightorDay();nod.cookieSet('nightorday','night',5);nod.anime(this);"><img src="../image/forumImage/night-day-icon.png" height="30" width="30"></a></li>
        
      </ul>

    </div>

     
    
    

  </div>
</nav>
  
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8 col-md-8 col-lg-8" style="" id="appendChild">
      
        <div class="well well-sm">Blog-Son Haberler <b class="text text-danger" style="float:right;font-size:11px;font-style:italic;">
          <a href="#" onclick="return false;">Tümünü gör</a></b></div>

        <?php if(isset($_GET["par"]) && $_GET["par"] != "anasayfa") { 
              $link = $_GET["par"];
              $sorgula = $db->query("SELECT * FROM blog WHERE subject_link = '$link'")->fetch();
              if($sorgula){ $nowblogid=$sorgula["id"];?>

              <div class="panel panel-default">
                <div class="panel panel-body" >
                  
                  <div class="col-sm-12 col-md-12 col-lg-12"><h4 style="font-weight: bold;">
                    <a data-ajax="true" href="<?=$sorgula['subject_link']?>">
                      <?=$sorgula["subject_title"]?></a></h4></div>

                      <ul class="list-inline" style="text-align: center;">

                        <li class="list-inline-item">Tarih :<b><?=$sorgula["subject_date"]?></b></li>
                        <li class="list-inline-item">Kategori X:<b><?=$sorgula["subject_category"]?></b></li>
                        <li class="list-inline-item">Yazar :<b class="text text-success"><?=$sorgula["subject_author"]?></b></li>
                        

                      </ul>
                   <div class="panel panel-default"></div>
                  <div data-img="myimg" class="col-sm-12 col-md-12 col-lg-12" style="clear:left;top:10px;bottom:20px;"><img src="../image/subjectImage/<?=$sorgula['subject_image']?>" onerror="this.src='../image/subjectImage/5.jpg'" height="300" width="100%" style="padding-bottom:35px;"></div>    
                  <div class="col-sm-12 col-md-12 col-lg-12" style="display:inline-block;"><?=$sorgula["subject_content"]?></div>
                </div>
              </div>

              <!--Önerilen içerik--> 
               <!--<div class="well well-sm" style="text-align:center;"><span class="text-success">Yorumlar</span></div> -->
               
              
               <div class="panel panel-success">
                  <div class="panel-heading">Yorumlar</div>
                  <div class="panel-body">
                      <div class="panel-group">

                        <div class="panel panel-default">
                          <div class="panel-heading" style="background-color: skyblue;color:white">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" href="#collapse1" id="commentWrite">Yorum yaz ...</a>
                            </h4>
                          </div>
                          <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                  <div class="table-responsive">
                                      <table class="table table-hover">
                                        <tr>
                                          <td><label class="form-control" style="text-align: center;">Adınız :</label></td>
                                          <td><input type="text" class="form-control" name="author"></td>
                                        </tr>
                                        <tr>
                                          <td><label class="form-control" style="text-align: center;">Yorumunuz :</label></td>
                                          <td><textarea name="comment" class="form-control" style="resize: none;height:100px"></textarea></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2"><div class="alert alert-danger" role="alert" id="commentAlert">
                                           Kullanıcı adı ve yorum alanı uzunluğun en az 5 karakter olmalıdır.
                                          </div></td>
                                        </tr>

                        
                                      </table>
                                   </div>
                            </div>
                            <div class="panel-footer">
                                  <div class="table-responsive">
                                      <table class="table table-hover">
                                        <tr>
                                          
                                          <td><button type="button" id="yayinSubmit" class="btn btn-success" style="width: 100%;">Yayınla</button></td>
                                        </tr>
                                      </table>
                                   </div>
                            </div>

                            <script>
                              $("#yayinSubmit").click(() =>{ 
                                    $("#commentAlert").css({"display":"none"});
                                   $data = "<?=$_GET['par']?>";
                                   $author = $("input[name=author]").val();
                                   $comment = $("textarea[name=comment]").val();
                                   $machine = navigator.appVersion;
                                  if($author.length > 5 && $comment.length > 5 && $data != ""){
                                       $.ajax({
                                        type:"post",
                                        url:"../scripts/script.php",
                                        data:{"tip":"comment","id":$data,"author":$author,"comment":$comment,"machine":$machine},
                                        success: (r) => {

                                            $author = $("input[name=author]").val("");
                                            $comment = $("textarea[name=comment]").val("");
                                            $("#commentAlert").css({"display":"inherit"});
                                            $("#commentAlert").removeClass('alert-danger');
                                            $("#commentAlert").addClass('alert-success');
                                            $("#commentAlert").html("Yorumunuz admin onayı bekliyor..");
                                        }
                                       });

                                  }else{
                                     $("#commentAlert").css({"display":"inherit"});
                                     $("#commentAlert").removeClass('alert-success');
                                     $("#commentAlert").addClass('alert-danger');
                                     $("#commentAlert").html("Gerekli alanları doldurun.");
                                  }

                               });  

                              $("#commentWrite").click(() => {
                                  
                                  var animeScroll = () =>{
                                    //window.scrollTo(0,document.body.scrollHeight);
                                    
                                    /*var doc = document.documentElement;
                                    var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);

                                    window.scrollTo(0,top+250);*/

                                    
                                  };
                                  setTimeout(animeScroll,350);
                               });

                            </script>

                          </div>
                        </div>

                      </div>   

                       <?php    
                                $veri =  $_GET["par"];
                                $last = explode('-',$veri);
                                $last = $last[count($last)-1];
                                $bul = $db->query("SELECT * FROM blogcomment WHERE blog_id = '$last' && commentShow = 1 && karantina = 0 ORDER BY commentDate DESC");
                                if($bul->rowCount()){
                                  $add = "";
                                  foreach($bul as $b){
                                    $add .= '<div class="well well-sm col-sm-12 col-md-12 col-lg-12">';
                                    $add .= '<img src="https://www.w3schools.com/css/trolltunga.jpg" height="50" width="50" class="col-sm-2 col-md-2 col-lg-2">';
                                    $add .= '<div class="col-sm-7 col-md-7 col-lg-7"><span class="form-control" style="display:inline;">'.$b["author"].'</span></div>';
                                    $add .= '<div class="col-sm-3 col-md-3 col-lg-3"><span class="form-control" style="display:inline;">'.date("j / n / Y", strtotime($b["commentDate"])).'</span></div>';
                                    $add .= '<div class="col-sm-10 col-md-10 col-lg-10" style="margin-top:10px;">';
                                    $add .= '<span>'.$b["comment"].'</span>';
                                    $add .= '</div>';
                                    $add .= '</div>';
                                  }
                                  echo $add;
                                }
                        ?>   

                  </div>
                </div>
               


               
                



               <!----> 


              <?php }else{ ?>
               <div class="panel panel-default">
                  <div class="panel panel-body">
                  
                  <div class="col-sm-12 col-md-12 col-lg-12"><h4 style="font-weight: bold;">
                    <a data-ajax="true" href="<?=$sorgula['subject_link']?>">
                      <?=$sorgula["subject_title"]?></a></h4></div>

                      <ul class="list-inline" style="text-align: center;"></ul>
                   <div class="panel panel-default"></div>
                   <div data-img="myimg" class="col-sm-12 col-md-12 col-lg-12" style="clear:left;top:10px;bottom:20px;"><img src="../image/forumImage/404.png" onerror="this.src='../image/forumImage/404.png'" height="300" width="100%" style="padding-bottom:35px;"></div>    
                   <div class="col-sm-12 col-md-12 col-lg-12" style="display:inline-block;color:red">İstenilen sayfa içeriği bulunamadi</div>
                </div>
              </div>
                      

                             <div class="text text-danger well well-sm">Diğer konulara göz atabilirsiniz. <b class="text text-danger" style="float:right;font-size:11px;font-style:italic;">
                             
                              <span class="icon-bar" style="border-left:1px solid;padding-left: 3px;"></span>
                              <span class="icon-bar" style="border-left:1px solid;padding-left: 3px;"></span>
                              <span class="icon-bar" style="border-left:1px solid;padding-left: 3px;"></span>     
                            </b></div>

                      <?php $veri=$db->query("SELECT * FROM blog ORDER BY id DESC limit 0,3"); // order by id DESC   limit 0,5
                          if($veri->rowCount()){
                             foreach($veri as $oku){ ?>
                                  <div class="panel panel-default">
                                    <div class="panel panel-body">
                                      
                                      <div class="col-sm-12 col-md-12 col-lg-12"><h4 style="font-weight: bold;">
                                        <a data-ajax="true" href="<?=$oku['subject_link']?>">
                                          <?=$oku["subject_title"]?></a></h4></div>

                                          <ul class="list-inline" style="text-align: center;">

                                            <li class="list-inline-item">Tarih :<b><?=$oku["subject_date"]?></b></li>
                                            <li class="list-inline-item">Kategori :<b><?=$oku["subject_category"]?></b></li>
                                            <li class="list-inline-item">Yazar :<b class="text text-success"><?=$oku["subject_author"]?></b></li>
                                            

                                          </ul>
                                       <div class="panel panel-default"></div>
                                      <div data-img="myimg" class="col-sm-3 col-md-3 col-lg-3" style="clear:left;top:10px;bottom:20px;"><img src="../image/subjectImage/<?=$oku['subject_image']?>" onerror="this.src='../image/subjectImage/2.jpg'" height="100" width="100"></div>    
                                      <div class="col-sm-9 col-md-9 col-lg-9"> 
                                        <?php $metin = explode(' ',$oku["subject_content"]);
                                                  $say = count($metin);
                                                  $sinir =40;
                                                  if($say <=$sinir){$kes = $say*50/100;}
                                                  else{$kes = $sinir;}
                                                  for($i=0;$i<=$kes;$i++){echo $metin[$i].' ';}
                                                  echo '<b><a href="'.$oku["subject_link"].'" class="text text-danger">Devamını gör</a></b>'; 
                                              ?></div>
                                    </div>
                                  </div>
                              

                        <?php }}?>

              <?php } 
        }else if(isset($_GET["par"]) && $_GET["par"] == 'anasayfa' || !isset($_GET["par"])){ ?>  

          <?php 
          $sayfa  = @$_GET["sayfa"];
          $kacar = 5;
          $ksayisi = $db->query("SELECT * FROM blog ")->rowCount();
          $ssayisi = ceil($ksayisi/$kacar);
          $nereden = ($sayfa * $kacar) - $kacar;
          if($sayfa > $ssayisi || !isset($_GET["sayfa"]) || $sayfa < 1){
            $nereden = 0;

            if(isset($_GET["sayfa"])){
            ?>
              <div class="well well-sm"><b style="color:red">İstenilen Sayfa bulunamadğından ilk sayfaya yönlendirildi.</b></div>
              
            <?php
          	}
          }


          $veri=$db->query("SELECT * FROM blog ORDER BY id DESC limit $nereden,$kacar"); // order by id DESC   limit 0,5
          if($veri->rowCount() == 0){echo "";}
          else if($veri->rowCount()){
          foreach($veri as $oku){ ?>

                   
                  <div class="panel panel-default">
                    <div class="panel panel-body">
                      
                      <div class="col-sm-12 col-md-12 col-lg-12"><h4 style="font-weight: bold;">
                        <a data-ajax="true" href="<?=$oku['subject_link']?>">
                          <?=$oku["subject_title"]?></a></h4></div>

                          <ul class="list-inline" style="text-align: center;">

                            <li class="list-inline-item">Tarih :<b><?=$oku["subject_date"]?></b></li>
                            <li class="list-inline-item">Kategori :<b><?=$oku["subject_category"]?></b></li>
                            <li class="list-inline-item">Yazar :<b class="text text-success"><?=$oku["subject_author"]?></b></li>
                            

                          </ul>
                       <div class="panel panel-default"></div>
                      <div data-img="myimg" class="col-sm-3 col-md-3 col-lg-3" style="clear:left;top:10px;bottom:20px;"><img src="../image/subjectImage/<?=$oku['subject_image']?>" onerror="this.src='../image/subjectImage/2.jpg'" height="100" width="100"></div>    
                      <div class="col-sm-9 col-md-9 col-lg-9"> 
                        <?php $metin = explode(' ',$oku["subject_content"]);
                                  $say = count($metin);
                                  $sinir =40;
                                  if($say <=$sinir){$kes = $say*50/100;}
                                  else{$kes = $sinir;}
                                  for($i=0;$i<=$kes;$i++){echo $metin[$i].' ';}
                                  echo '<b><a href="'.$oku["subject_link"].'" class="text text-danger">Devamını gör</a></b>'; 
                              ?></div>
                    </div>
                  </div>

           
                 <?php }}?>
                 <div class="well well-sm" style="text-align: center"><?php 
                  $forlimit = 2;
                  if(!isset($_GET["sayfa"])){
                    $sayfa = 1;
                  }  

                  if($sayfa>1){
                    echo "<a href='?sayfa=1' style='padding:5px;margin-left:5px;background-color:purple;color:white;text-decoration:none;'>İlk</a>";
                    if($sayfa <= $ssayisi){
                    $onceki = $sayfa - 1;
                    echo "<a href='?sayfa=$onceki' style='padding:5px;margin-left:5px;background-color:purple;color:white;text-decoration:none;'>Önceki</a>";}
                  }
                  if($sayfa < 0 || $sayfa > $ssayisi){}else{
                    for($i=$sayfa-$forlimit;$i<$sayfa+$forlimit;$i++){
                        if($i == $sayfa){
                          echo "<a style='padding:5px;margin-left:5px;background-color:black;color:white;text-decoration:none;'>$i</a>";
                        }
                        else if($i>0 && $i<=$ssayisi){
                        echo "<a href='?sayfa=$i' style='padding:5px;margin-left:5px;background-color:purple;color:white;text-decoration:none;'>$i</a>";
                        }
                    }
                 }
                  if($sayfa < $ssayisi){
                    $next = $sayfa +1;
                      echo "<a href='?sayfa=$next' style='padding:5px;margin-left:5px;background-color:purple;color:white;text-decoration:none;'>Sonraki</a>";
                   
                    echo "<a href='?sayfa=$ssayisi' style='padding:5px;margin-left:5px;background-color:purple;color:white;text-decoration:none;'>Son</a>";

                   
                  }

                 ?></div>

          <?php }?>


        
       



    </div>
    <div class=" col-sm-4 col-md-4 col-lg-4" style="background-color:">
     
     <!-- <div class="col-sm-12 col-md-12 col-lg-12">
         <img src="https://image.freepik.com/free-icon/facebook-logo-with-rounded-corners_318-9850.jpg" height="100" width="100">
      </div>-->

      <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="well well-sm">Forumdan Konular</div>
      </div>

    </div>
  </div>  
</div>
<footer class="container-fluid" style="width:100%;position: relative;height: auto;background-color:black;line-height: 60px;text-align: center;display:inline-block;color:green;margin-top:150;" id="footer">
  <p>Desingner Bayraktar#</p>
</footer>

	  

</body>
</html>
<script>getCookie("nightorday") == "night" ? nightMode():dayMode();</script>

<script>

/*
$(window).scroll(function(){

  if($(window).scrollTop() + $(window).height() == $(document).height()){
   
    var path = location.pathname.replace('/uygulamalar/myForum/main/','');
    
      $.ajax({
        type:"post",
        url:"../scripts/script.php",
        data:{"tip":"newblog","url":path},
        success: function(data){
             
            var format = JSON.parse(data);

            if(format.link != null && format.link != ""){
                  var cikti = '<div class="panel panel-default">'+
                      '<div class="panel panel-body" >'+
                        
                        '<div class="col-sm-12 col-md-12 col-lg-12"><h4 style="font-weight: bold;">'+
                          '<a data-ajax="true" href="'+format.link+'">'+format.title+'</a></h4></div>'+

                            '<ul class="list-inline" style="text-align: center;">'+

                              '<li class="list-inline-item">Tarih :<b>'+format.date+'</b></li>'+
                              '<li class="list-inline-item">Kategori X:<b>'+format.category+'</b></li>'+
                              '<li class="list-inline-item">Yazar :<b class="text text-success">'+format.author+'</b></li>'+
                              

                            '</ul>'+
                         '<div class="panel panel-default"></div>'+
                        '<div data-img="myimg" class="col-sm-12 col-md-12 col-lg-12" style="clear:left;top:10px;bottom:20px;"><img src="../image/subjectImage/'+format.image+'" onerror="this.src=\'../image/subjectImage/1.jpg\'" height="300" width="100%" style="padding-bottom:35px;"></div>'+    
                        '<div class="col-sm-12 col-md-12 col-lg-12" style="display:inline-block;">'+format.content+'</div>'+
                      '</div>'+
                    '</div>';
                 $("#appendChild").append(cikti);
                 $('title').text(format.title); // title cahange
                 history.pushState('','',''+format.link);//statu link compenent
             } // if
        } // success
       


      }); // ajax
  
  }else{ // if



  }

});

*/

</script>