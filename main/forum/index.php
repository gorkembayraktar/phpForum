<?php include("../../scripts/connectVT.php");
//setcookie("nightOrDay","default",time()-(86400*30),"/");
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">

 	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bootstrap/css/mystil.css">

  <!--SWEET ALERT 2 Library-->
 <!-- <link rel="stylesheet" href="https://limonte.github.io/sweetalert2/dist/sweetalert2.min.css">
  <script src="https://limonte.github.io/sweetalert2/dist/sweetalert2.all.min.js"></script>
 -->
<!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- THE END--> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../../bootstrap/js/custom.js"></script>
  <!--                 DRAGGABLE                             -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
  </script>
<!--                THE END DRAGGABLE            -->
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

     function sectionStatus(veri){
       
       
        $.ajax({
              type:"post",
              url:"import.php",
              data:{"tip":"update","id":veri.getAttribute("data-id")},
              success: function(data){
                var sonuc = JSON.parse(data)
                if(sonuc.sonuc === true){ 
                  veri.innerHTML = veri.getAttribute("data-status") == 1 ?"KAPALI":"AÇIK";
                  var degistir = veri.getAttribute("data-status") == 1 ? "0" : "1";
                  veri.style = degistir == 0 ? "background-color:red;width:85px;opacity:.7;":"background-color:green;width:85px;opacity:.7;";
                  veri.setAttribute("data-status",degistir);  

                }
                
              }


        });

     }
     function parentStatus(veri2){

            $.ajax({
                type:"post",
                url:"import.php",
                data:{"tip":"parent","parentid":veri2.getAttribute("data-parent")},
                success: function(data){
                  var cevir = JSON.parse(data);
                   if(cevir.sonuc === true){
                     veri2.innerHTML = veri2.getAttribute("data-ps") == 1 ?"KAPALI":"AÇIK";
                      var degistir = veri2.getAttribute("data-ps") == 1 ? "0" : "1";
                      veri2.style = degistir == 0 ? "background-color:red;width:85px;opacity:.7;":"background-color:green;width:85px;opacity:.7;";
                      veri2.setAttribute("data-ps",degistir);  

                   }
                }

            });

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
      <a class="navbar-brand" href="http://localhost/uygulamalar/myForum/main/">MyForum</a>
    </div>


    <div id="myUser">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Kayıt Ol</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Giriş</a></li>
          </ul>
   </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../anasayfa">Anasayfa</a></li>
        <li><a href="../blog">Blog</a></li>
        <li><a href="" class="mybtn btn-disabled" onclick="">Forum</a></li>
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
        <li><a  onclick="var nod = new dayOrNightFunc();nod.nightorDay();nod.cookieSet('nightorday','night',5);nod.anime(this);"><img src="../../image/forumImage/night-day-icon.png" height="30" width="30"></a></li>
        
      </ul>

    </div>

     
    
    

  </div>
</nav>
  
<div class="container-fluid">
  <div class="row">
    
    <div class="col-sm-12 col-md-12 col-lg-12" style="">
        <div class="panel-group" id="accordion">
          
                <!--<div class="well well-sm">
                  <a href="../admin/">Detaylı kullanıcı istatistikleri.</a>
                </div>-->
                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <a href="../admin/" style="text-decoration: none;"><strong>HOŞ GELDİN ADMİN !</strong><span><br> Detaylı kullanıcı istatistiklerine ulaşman için şöyle bir yönetim paneli hazırlandık..</span></a>
                  
                </div>
                                

               <div class="panel panel-success">
                  
                  <div class="panel-heading">Admin Konu Ayarları<span class="label label-success" style="float:right;color:red;cursor:pointer;" onclick="location.reload();">Güncelle</span>
                   </div>
                  <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <th class="col-sm-9 col-md-9 col-lg-9">Konu Başlıkları</th>
                                <th class="col-sm-1 col-md-1 col-lg-1" style="text-align: center;">Tarih</th>
                                <th class="col-sm1 col-md-1 col-lg-1" style="text-align: center;">Indis</th>
                                <th class="col-sm-1 col-md-1 col-lg-1" >Açık/Kapalı</th>
                              </thead>
                              <tbody>
                                <?php $vericek = $db->query("SELECT * FROM forumsection ORDER BY sectionShow DESC,sectionIndis ASC ");
                                 $collapse =0;
                                  foreach($vericek as $v){
                                 
                                  $collapse += 1;

                                 ?>
                                <tr>
                                  <td class="col-sm-7 col-md-7 col-lg-7" >

                                      <div class="panel-heading">
                                        <h4 class="panel-title">
                                          <a data-toggle="collapse" href="#collapse<?=$collapse?>" class="label label-warning"><?=$v["sectionTitle"]?></a>
                                        </h4>
                                      </div>
                                      <div id="collapse<?=$collapse?>" class="panel-collapse collapse">
                                          <div class="panel-body">
                                              <table class="table table-hover">
                                                <thead><th class="col-sm-10 col-md-10 col-lg-10">İçerik Başlıkları</th><th class="col-sm-2 col-md-2 col-lg-2">Yayınlanma</th></thead>
                                                <tbody>
                                                      <?php 
                                                      $frm_id = $v["frm_id"];
                                                      $sorgu0=$db->query("SELECT * FROM forumsectionparent WHERE fs_id='$frm_id'");foreach($sorgu0 as $for){?>
                                                      <tr>
                                                        <td><?=$for["parent_title"]?></td>
                                                        <td><button <?=$v['sectionShow'] == 0 ? "disabled":""?> onclick="parentStatus(this)" data-parent="<?=$for['fsp_id']?>" data-ps="<?=$for['parent_show']?>" style="width:85px" class="btn btn-<?=$for['parent_show'] == 0? "danger":"success"?><?=$v["sectionShow"] == 1 ? " active":" disabled"?>" ><?=$for["parent_show"]==0?"KAPALI":"AÇIK"?></button></td>
                                                      </tr>
                                                      <?php  }?>
                                                </tbody>
                                              </table>

                                          </div>
                                      </div> 
                                  </td>
                                  <td class="col-sm-3 col-md-3 col-lg-3"><?=$v["sectionDate"]?></td>
                                  <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Modal-<?=$v["sectionIndis"]?></button></td>
                                  <td class="col-sm-1 col-md-1 col-lg-1"><button onclick="sectionStatus(this)" data-status='<?=$v["sectionShow"]?>' data-id='<?=$v["frm_id"]?>' style="width:85px" class="btn btn-<?=$v['sectionShow'] == 0? "danger":"success"?>"><?=$v["sectionShow"]==0?"KAPALI":"AÇIK"?></button></td>
                                </tr>
                                   
                                <?php } ?>


                              </tbody>
                            </table>
                       </div>

                  </div>
              </div>
              <?php
               $veriler=$db->query("SELECT * FROM forumsection INNER JOIN forumsectionparent ON forumsection.frm_id = forumsectionparent.fs_id");
               $baslik = $db->query("SELECT * FROM forumsection  WHERE sectionShow = 1 ORDER BY sectionIndis ASC ");

              foreach($baslik as $veri){ ?>
                 
               
             
              <div class="panel panel-info">
                  <div class="panel-heading"><?=$veri["sectionTitle"]?></div>
                  <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <th>#</th>
                                <th>Forum</th>
                                <th>Son Mesaj</th>
                                <th style="text-align: center">Konu</th>
                                <th style="text-align: center">Mesajlar</th>
                              </thead>
                              <tbody>
                                <?php $id = $veri["frm_id"];$sorgu=$db->query("SELECT * FROM forumsectionparent WHERE fs_id='$id' && parent_show = 1 ORDER BY fsp_id ASC ");foreach($sorgu as $konu){?>
                                <tr>
                                  <td class="col-sm-1 col-md-1 col-lg-1"><img src="../../image/subjectImage/<?=$konu['parent_image']?>" height="50" width="50" /></td>
                                  <td class="col-sm-6 col-md-6 col-lg-6"><?=$konu["parent_title"]?></td>
                                  <td class="col-sm-3 col-md-3 col-lg-3">@admin</td>
                                  <td class="col-sm-1 col-md-1 col-lg-1" style="text-align: center">1</td>
                                  <td class="col-sm-1 col-md-1 col-lg-1" style="text-align:center">1</td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                       </div>
                  </div>
              </div>

              <?php } ?>
        </div>
    </div>

  </div>  
</div>
<footer class="container-fluid" style="width:100%;position: relative;height: auto;background-color:black;line-height: 60px;text-align: center;display:inline-block;color:green;" id="footer">
  <p>Desingner Bayraktar#</p>
</footer>



<div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="color:red;opacity:.8;">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel">İndis Ayarları </h5>
      </div>
      <div class="modal-body">
          <ul id="sortable" style="list-style: none;cursor: move;" class="list-group">

            <?php $drag =$db->query("SELECT * FROM forumsection ORDER BY sectionIndis ASC,sectionShow DESC ");
            $datax = "";
            foreach($drag as $dr){
                if($dr["sectionShow"] == 1){
                echo '<li class="ui-state-default list-group-item list-group-item-success" data-frmsc="'.$dr["sectionIndis"].'" data-parentid="'.$dr["frm_id"].'">'.$dr["sectionTitle"].'</li>';
                }else{
                  $datax .= '<li class="list-group-item list-group-item-danger">'.$dr["sectionTitle"].'</li>';
                }
              }?>
          </ul>
          <?php 
           echo $datax;
          ?>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-primary" id="indisSave">Kaydet</button>
      </div>
      
    </div>
  </div>
</div>

</body>
</html>
<script>getCookie("nightorday") == "night" ? nightMode():dayMode();</script>

<script>
$("#indisSave").click(function() {
    var vt = $(".modal-body .ui-state-default");
   
     
   
    var arttir = 0;
    var dizin = [];
    for(var y = 0;y<vt.length;y++){

     
     var  data =  y+","+vt[y].getAttribute("data-parentid");
     dizin.push(data);
                                  
              
      //console.log("YENİ :"+ y +" -> ESKİ :"+vt[y].getAttribute("data-frmsc")  );
    }
    //console.log(JSON.stringify(jsonb["veriler"][1]["eski"]));
    $.ajax({
        type: "POST",
        url : "import.php",

        data:{"tip":"save","data":dizin},
        success: (sonuc) =>{
           if(sonuc == true){
              $('#myModal').modal('hide')
           }
        }

    });


});

</script>