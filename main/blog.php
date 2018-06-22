<?php include("../scripts/connectVT.php");
//setcookie("nightOrDay","default",time()-(86400*30),"/");
 ?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
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

   
 $(document).ready(function() {

    var array = [];

    $(document).on('keyup','#etiket',function(e){

        if(e.keyCode == 32){

           var veri = $(this).html().replace(/&nbsp;/gi,'');
           array.push(veri);
           this.innerHTML = "";
            document.getElementById("etiketler").innerHTML ="";
          for(var l = 0;l<array.length;l++){
            document.getElementById("etiketler").innerHTML += "<div class='label label-info'>"+array[l]+"</div>  ";
          }
        }
        else if(e.keyCode == 13){
          document.getElementById("etiket").innerHTML = "";
    
        }
    });

      var konubaslik = "";
      var kategori = "";
      var metin = "";
      var d = "";

    $("#olustur").click(function(){
       
      konubaslik = $("input[name=baslik]").val();
      kategori = $("select[name=kategori]").val();
      metin = $("textarea[name=metin]").val();
      var d = new Date();
      var dizin = "";
      array.forEach(function(element){ dizin +="<div class='label label-info'>"+element+"</div>   ";});
      //alert(array);
        /*$.ajax({
            type:"post",
            url:"../scripts/script.php",
            data:{"tip":"blog","konubaslik":konubaslik,"kategori":kategori,"icerik":metin,"tag":JSON.stringify(array)},
            cache:false, // önbelleğe alınmasını önler
            success: function(data){
             
              var veri = JSON.parse(data);

              if(veri.durum){
                */

               document.getElementById("blog-panel").innerHTML = onizleme(konubaslik,kategori,metin,dizin,d,"Yayınlandı..");
             

           /*   }

            }

        });*/


    });

 

    $(document).on('click','#onizleme',function(){
  
      konubaslik = $("input[name=baslik]").val();
      kategori = $("select[name=kategori]").val();
      metin = $("textarea[name=metin]").val();
      d = new Date();
      var dizin = "";
      array.forEach(function(element){ dizin +="<div class='label label-info'>"+element+"</div>   ";});
      document.getElementById("blog-panel").innerHTML = onizleme(konubaslik,kategori,metin,dizin,d,"Önizlenim");


    });
    function onizleme(konubaslik,kategori,metin,dizin,d,durum){
      return '<div class="well well-sm" style="text-align: center">Ön İzleme-<span class="label label-info" style="float:right">'+durum+'</span></div>'+
                 '<div class="well well-sm">'+
                 ' <div class="panel panel-default">'+
                      '<div class="panel panel-body" >'+
                  
                      '<div class="col-sm-12 col-md-12 col-lg-12"><h4 style="font-weight: bold;">'+
                    '<a data-ajax="true">'+ konubaslik +'</a></h4></div>'+

                      '<ul class="list-inline" style="text-align: center;">'+

                        '<li class="list-inline-item">Tarih :<b>'+d.toDateString() +'</b></li>'+
                        '<li class="list-inline-item">Kategori :<b>'+ kategori +'</b></li>'+
                        '<li class="list-inline-item">Yazar :<b class="text text-success">ben</b></li>'+
                        

                     '</ul>'+
                   '<div class="panel panel-default"></div>'+

                  '<div class="col-sm-12 col-md-12 col-lg-12" style="display:inline-block;"><img src="../image/subjectImage/1.jpg" height="200" width="100%"/>'+ metin +'<br>'+dizin+'</div>'+
                '</div>'+
              '</div></div>'+
              '<div class="well well-sm" style="text-align: left" id="gizle"><div class="btn-group btn-group-justified"><a href="#" class="btn btn-danger" id="duzenle">Düzenle</a>'+
             '<a href="#" class="btn btn-success" id="yayinla">Yayınla</a></div></div>';

    }

    $(document).on('click','#yayinla',function(){

      var d = new Date();
      var dizin = "";
      array.forEach(function(element){ dizin +="<div class='label label-info'>"+element+"</div>   ";});
      
        $.ajax({
            type:"post",
            url:"../scripts/script.php",
            data:{"tip":"blog","konubaslik":konubaslik,"kategori":kategori,"icerik":metin,"tag":JSON.stringify(array)},
            cache:false, // önbelleğe alınmasını önler
            success: function(data){
             
              var veri = JSON.parse(data);

              if(veri.durum){

                document.getElementById("gizle").innerHTML = "YAYINA ALINDI.<BR>"+
                "<a href='"+(veri.link)+"'>"+(veri.baslik)+"</a>";


              }

            }

        });
      
    });

    $(document).on('click','#duzenle',function(){

         document.getElementById("blog-panel").innerHTML = duzenleme();
    });


    function duzenleme(){
      var dizin = "";
      array.forEach(function(element){ dizin +="<div class='label label-info'>"+element+"</div>   ";});

      return '<div class="well well-sm" style="text-align: center">'+
             '<input class="form-control" type="text" name="baslik" placeholder="Konu Başlığı" autocomplete="off" value="'+konubaslik+'">'+
        '</div>'+
       
        '<div class="well well-sm" style="text-align: center">'+
          '<div class="form-group" style="float:left;width:200px;">'+
              '<select name="kategori" class="form-control" id="kategorisec">'+
                '<option>KATEGORİ</option>'+
                '<option '+(kategori == "teknoloji"?"selected":"")+'>teknoloji</option>'+
                '<option '+(kategori == "programlama"?"selected":"")+'>programlama</option>'+
                '<option '+(kategori == "webmaster"?"selected":"")+'>webmaster</option>'+
              '</select>'+
          '</div>'+
          '<button class="btn btn-info" style="font-weight:bold;">B</button>'+
          '  <button class="btn btn-info" style="text-decoration: underline;">U</button>    <button class="btn btn-info"><a href="">LİNK</a></button>    <button class="btn btn-info">IMAGE</button>'+
        '</div>'+
         '<div class="well well-sm" style="">'+
            '<textarea class="form-control" style="resize: none;" rows="12" autocomplete="off" name="metin">'+metin+'</textarea>'+
            '<br>'+
            

            '<p class="form-control" contenteditable="true" id="etiket"></p>'+
            '<p class="form-control" id="etiketler">'+dizin+'</p>'+
         '</div>'+
         '<div class="well well-sm" style="text-align: left">'+
            '<div class="btn-group btn-group-justified">'+
                '<a href="#" class="btn btn-danger" id="onizleme">Önizleme</a>'+
              
            '</div>'+
          
          
         '</div>'+
    '</div>';
    }


});
     
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
        <li><a href="">Blog</a></li>
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
    <div class="col-sm-4 col-md-4 col-lg-4">
       <div class="well well-sm" style="text-align: center">
        Diğer Konular
       </div>
        <div class="well well-sm">
          <?php 
           $veriler = $db->query("SELECT * FROM blog ORDER BY id DESC limit 0,10");
           foreach($veriler as $veri){
             
             echo "<div class='label label-info'>".mb_substr($veri["subject_title"],0,35,'UTF-8')."</div><br>";
           } 

          ?>
       </div>

    </div>

    <div class="col-sm-8 col-md-8 col-lg-8" style="" id="blog-panel">
        <div class="well well-sm" style="text-align: center">
             <input class="form-control" type="text" name="baslik" placeholder="Konu Başlığı" autocomplete="off">
        </div>
       
        <div class="well well-sm" style="text-align: center">
          <div class="form-group" style="float:left;width:200px;">
              <select name="kategori" class="form-control" id="kategorisec">
                <option>KATEGORİ</option>
                <option>teknoloji</option>
                <option>programlama</option>
                <option>webmaster</option>
              </select>
          </div>
          <button class="btn btn-info" style="font-weight:bold;">B</button>
          <button class="btn btn-info" style="text-decoration: underline;">U</button>
          <button class="btn btn-info"><a href="">LİNK</a></button>
          <button class="btn btn-info">IMAGE</button>
        </div>
         <div class="well well-sm" style="">
            <textarea class="form-control" style="resize: none;" rows="12" autocomplete="off" name="metin"></textarea>
            <br>
            <!--<input type="text" id="etiket" class="form-control" placeholder="Etiket ['tenoloji','uzay']" /> -->

            <?="   --"?>Etiketler->
            <p class="form-control" contenteditable="true" id="etiket"></p>
            <p class="form-control" id="etiketler"></p>
         </div>
         <div class="well well-sm" style="text-align: left">
            <div class="btn-group btn-group-justified">
                <a href="#" class="btn btn-danger" id="onizleme">Önizleme</a>
                <!--<a href="#" class="btn btn-success" id="olustur">Yayınla</a>-->
            </div>
          
          
         </div>
    </div>
    <div class=" col-sm-4 col-md-4 col-lg-4" style="background-color:">
     
    

    </div>
  </div>  
</div>
<footer class="container-fluid" style="width:100%;position: relative;height: auto;background-color:black;line-height: 60px;text-align: center;display:inline-block;color:green;" id="footer">
  <p>Desingner Bayraktar#</p>
</footer> 

    

</body>
</html>
<script>getCookie("nightorday") == "night" ? nightMode():dayMode();</script>

<script>
 



</script>