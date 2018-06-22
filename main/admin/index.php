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
  <!-- <link rel="stylesheet" href="../bootstrap/css/mystil.css"> -->

  <!--SWEET ALERT 2 Library-->
 <!-- <link rel="stylesheet" href="https://limonte.github.io/sweetalert2/dist/sweetalert2.min.css">
  <script src="https://limonte.github.io/sweetalert2/dist/sweetalert2.all.min.js"></script>
 -->
 <script src="dataUpdate.js?v=00101"></script>
 <script src="proccessClass.js"></script>
<!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- THE END--> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- <script src="../bootstrap/js/custom.js"></script> -->
  <script>
   



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

   
     
window.onload = function () {

  var chart = new CanvasJS.Chart("chartWebTraffic", {
  animationEnabled: true,
  title:{
    text: "Website Traffic"
  },
  axisX:{
    valueFormatString: "DD MMM"
  },
  axisY: {
    title: "Number of Visitors",
    includeZero: false,
    scaleBreaks: {
      autoCalculate: true
    }
  },
  data: [{
    type: "line",
    xValueFormatString: "DD MMM",
    color: "#F08080",
    dataPoints: [
      { x: new Date(2017, 0, 1), y: 610 },
      { x: new Date(2017, 0, 2), y: 680 },
      { x: new Date(2017, 0, 3), y: 690 },
      { x: new Date(2017, 0, 4), y: 700 },
      { x: new Date(2017, 0, 5), y: 710 },
      { x: new Date(2017, 0, 6), y: 658 },
      { x: new Date(2017, 0, 7), y: 734 },
      { x: new Date(2017, 0, 8), y: 963 },
      { x: new Date(2017, 0, 9), y: 847 },
      { x: new Date(2017, 0, 10), y: 853 },
      { x: new Date(2017, 0, 11), y: 869 },
      { x: new Date(2017, 0, 12), y: 943 },
      { x: new Date(2017, 0, 13), y: 970 },
      { x: new Date(2017, 0, 14), y: 869 },
      { x: new Date(2017, 0, 15), y: 890 },
      { x: new Date(2017, 0, 16), y: 930 },
      { x: new Date(2017, 0, 17), y: 1850 },
      { x: new Date(2017, 0, 18), y: 1905 },
      { x: new Date(2017, 0, 19), y: 1980 },
      { x: new Date(2017, 0, 20), y: 1858 },
      { x: new Date(2017, 0, 21), y: 1034 },
      { x: new Date(2017, 0, 22), y: 963 },
      { x: new Date(2017, 0, 23), y: 847 },
      { x: new Date(2017, 0, 24), y: 853 },
      { x: new Date(2017, 0, 25), y: 869 },
      { x: new Date(2017, 0, 26), y: 943 },
      { x: new Date(2017, 0, 27), y: 970 },
      { x: new Date(2017, 0, 28), y: 869 },
      { x: new Date(2017, 0, 29), y: 890 },
      { x: new Date(2017, 0, 30), y: 930 },
      { x: new Date(2017, 0, 31), y: 750 }
    ]
  }]
});
chart.render();
  
  


  $.ajax({
      type:"post",
      url : "islemler.php",
      data:{"tip":"data"},
      success: (veri) => {
        
         var json = JSON.parse(veri);

         var dJason = [
                  {
                    Jan: 0,
                    Feb: 0,
                    Mar: 0,
                    Apr: 0,
                    May: 0,
                    Jun: 0,
                    Jul: 0,
                    Aug: 0,
                    Sep: 0,
                    Oct: 0,
                    Nov: 0,
                    Dec: 0
                  }
                ];

          var eJason = [
                  {
                    Jan: 0,
                    Feb: 0,
                    Mar: 0,
                    Apr: 0,
                    May: 0,
                    Jun: 0,
                    Jul: 0,
                    Aug: 0,
                    Sep: 0,
                    Oct: 0,
                    Nov: 0,
                    Dec: 0
                  }
                ];

          var dJason2018 = [
                  {
                    Jan: 0,
                    Feb: 0,
                    Mar: 0,
                    Apr: 0,
                    May: 0,
                    Jun: 0,
                    Jul: 0,
                    Aug: 0,
                    Sep: 0,
                    Oct: 0,
                    Nov: 0,
                    Dec: 0
                  }
                ];

          var eJason2018 = [
                  {
                    Jan: 0,
                    Feb: 0,
                    Mar: 0,
                    Apr: 0,
                    May: 0,
                    Jun: 0,
                    Jul: 0,
                    Aug: 0,
                    Sep: 0,
                    Oct: 0,
                    Nov: 0,
                    Dec: 0
                  }
                ];                  
        
        

         json.onaylananDate.forEach((b)=>{ var ty = b.split(' ')[1]; dJason[0][ty] = dJason[0][ty]+1; });

         json.digerDate.forEach((y)=>{ var by = y.split(' ')[1]; eJason[0][by] = eJason[0][by]+1; });

         json.onaylananDate2018.forEach((a)=>{ var ey = a.split(' ')[1]; dJason2018[0][ey] = dJason2018[0][ey]+1;  });

         json.digerDate2018.forEach((a)=>{ var ey = a.split(' ')[1]; eJason2018[0][ey] = eJason2018[0][ey]+1;  });



          var totalVisitors = json.total;
          var visitorsData = {
            "New vs Returning Visitors": [{
              click: visitorsChartDrilldownHandler,
              cursor: "pointer",
              explodeOnClick: false,
              innerRadius: "75%",
              legendMarkerType: "square",
              name: "New vs Returning Visitors",
              radius: "100%",
              showInLegend: true,
              startAngle: 90,
              type: "doughnut",
              dataPoints: [
                { y: json.onaylanan, name: "Onaylanan", color: "#007700" },
                { y: json.diger, name: "Diger", color: "#ff0000" }
              ]
            }],
            "Onaylanan": [{
              color: "#E7823A",
              name: "Onaylanan",
              type: "column",
              xValueFormatString: "MMM YYYY",
              dataPoints: [
                { x: new Date("1 Jan 2017"), y: dJason[0].Jan },
                { x: new Date("1 Feb 2017"), y: dJason[0].Feb },
                { x: new Date("1 Mar 2017"), y: dJason[0].Mar },
                { x: new Date("1 Apr 2017"), y: dJason[0].Apr },
                { x: new Date("1 May 2017"), y: dJason[0].May },
                { x: new Date("1 Jun 2017"), y: dJason[0].Jun },
                { x: new Date("1 Jul 2017"), y: dJason[0].Jul },
                { x: new Date("1 Aug 2017"), y: dJason[0].Aug },
                { x: new Date("1 Sep 2017"), y: dJason[0].Sep },
                { x: new Date("1 Oct 2017"), y: dJason[0].Oct },
                { x: new Date("1 Nov 2017"), y: dJason[0].Nov },
                { x: new Date("1 Dec 2017"), y: dJason[0].Dec }
              ]
            }],
            "Diger": [{
              color: "#546BC1",
              name: "Diger",
              type: "column",
              xValueFormatString: "MMM YYYY",
              dataPoints: [
                { x: new Date("1 Jan 2017"), y: eJason[0].Jan },
                { x: new Date("1 Feb 2017"), y: eJason[0].Feb },
                { x: new Date("1 Mar 2017"), y: eJason[0].Mar },
                { x: new Date("1 Apr 2017"), y: eJason[0].Apr },
                { x: new Date("1 May 2017"), y: eJason[0].May },
                { x: new Date("1 Jun 2017"), y: eJason[0].Jun },
                { x: new Date("1 Jul 2017"), y: eJason[0].Jul },
                { x: new Date("1 Aug 2017"), y: eJason[0].Aug },
                { x: new Date("1 Sep 2017"), y: eJason[0].Sep },
                { x: new Date("1 Oct 2017"), y: eJason[0].Oct },
                { x: new Date("1 Nov 2017"), y: eJason[0].Nov },
                { x: new Date("1 Dec 2017"), y: eJason[0].Dec }
              ]
            }]
          };

          var newVSReturningVisitorsOptions = {
            animationEnabled: true,
            theme: "light2",
            title: {
              text: "2017 Kullanıcı İstatistikleri"
            },
            subtitles: [{
              text: "Detaylar",
              backgroundColor: "#2eacd1",
              fontSize: 16,
              fontColor: "white",
              padding: 5
            }],
            legend: {
              fontFamily: "calibri",
              fontSize: 14,
              itemTextFormatter: function (e) {
                return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitors * 100) + "%";  
              }
            },
            data: []
          };

          var visitorsDrilldownedChartOptions = {
            animationEnabled: true,
            theme: "light2",
            axisX: {
              labelFontColor: "#717171",
              lineColor: "#a2a2a2",
              tickColor: "#a2a2a2"
            },
            axisY: {
              gridThickness: 0,
              includeZero: false,
              labelFontColor: "#717171",
              lineColor: "#a2a2a2",
              tickColor: "#a2a2a2",
              lineThickness: 1
            },
            data: []
          };

          newVSReturningVisitorsOptions.data = visitorsData["New vs Returning Visitors"];
          $("#chartContainer").CanvasJSChart(newVSReturningVisitorsOptions);

          function visitorsChartDrilldownHandler(e) {
            e.chart.options = visitorsDrilldownedChartOptions;
            e.chart.options.data = visitorsData[e.dataPoint.name];
            e.chart.options.title = { text: e.dataPoint.name }
            e.chart.render();
            $("#backButton").toggleClass("invisible");
          }

          $("#backButton").click(function() { 
            $(this).toggleClass("invisible");
            newVSReturningVisitorsOptions.data = visitorsData["New vs Returning Visitors"];
            $("#chartContainer").CanvasJSChart(newVSReturningVisitorsOptions);
          });




        // ---------------------------------------   CHART   2       --------------------------------------------


        var totalVisitorsDiger = json.totalDate2018;
          var visitorsDataDiger = {
            "New vs Returning": [{
              click: visitorsChartDrilldownHandlerDiger,
              cursor: "pointer",
              explodeOnClick: false,
              innerRadius: "75%",
              legendMarkerType: "square",
              name: "New vs Returning",
              radius: "100%",
              showInLegend: true,
              startAngle: 90,
              type: "doughnut",
              dataPoints: [
                { y: json.onaylananDate2018.length, name: "Onaylanan", color: "#007700" },
                { y: json.digerDate2018.length, name: "Diger", color: "#ff0000" }
              ]
            }],
            "Onaylanan": [{
              color: "#E7823A",
              name: "Onaylanan",
              type: "column",
              xValueFormatString: "MMM YYYY",
              dataPoints: [
                { x: new Date("1 Jan 2017"), y: dJason2018[0]["Jan"] },
                { x: new Date("1 Feb 2017"), y: dJason2018[0]["Feb"] },
                { x: new Date("1 Mar 2017"), y: dJason2018[0]["Mar"] },
                { x: new Date("1 Apr 2017"), y: dJason2018[0]["Apr"] },
                { x: new Date("1 May 2017"), y: dJason2018[0]["May"] },
                { x: new Date("1 Jun 2017"), y: 10 },
                { x: new Date("1 Jul 2017"), y: 10 },
                { x: new Date("1 Aug 2017"), y: 10 },
                { x: new Date("1 Sep 2017"), y: 10 },
                { x: new Date("1 Oct 2017"), y: 10 },
                { x: new Date("1 Nov 2017"), y: 10 },
                { x: new Date("1 Dec 2017"), y: 10 }
              ]
            }],
            "Diger": [{
              color: "#546BC1",
              name: "Diger",
              type: "column",
              xValueFormatString: "MMM YYYY",
              dataPoints: [
                { x: new Date("1 Jan 2017"), y: eJason2018[0]["Jan"] },
                { x: new Date("1 Feb 2017"), y: eJason2018[0]["Feb"] },
                { x: new Date("1 Mar 2017"), y: eJason2018[0]["Mar"] },
                { x: new Date("1 Apr 2017"), y: eJason2018[0]["Apr"] },
                { x: new Date("1 May 2017"), y: eJason2018[0]["May"] },
                { x: new Date("1 Jun 2017"), y: 10 },
                { x: new Date("1 Jul 2017"), y: 10 },
                { x: new Date("1 Aug 2017"), y: 10 },
                { x: new Date("1 Sep 2017"), y: 10 },
                { x: new Date("1 Oct 2017"), y: 10 },
                { x: new Date("1 Nov 2017"), y: 10 },
                { x: new Date("1 Dec 2017"), y: 10 }
              ]
            }]
          };

          var newVSReturningVisitorsOptionsDiger = {
            animationEnabled: true,
            theme: "light2",
            title: {
              text: "2018 Kullanıcı İstatistikleri"
            },
            subtitles: [{
              text: "Detaylar",
              backgroundColor: "#2eacd1",
              fontSize: 16,
              fontColor: "white",
              padding: 5
            }],
            legend: {
              fontFamily: "calibri",
              fontSize: 14,
              itemTextFormatter: function (e) {
                return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitorsDiger * 100) + "%";  
              }
            },
            data: []
          };

          var visitorsDrilldownedChartOptionsDiger = {
            animationEnabled: true,
            theme: "light2",
            axisX: {
              labelFontColor: "#717171",
              lineColor: "#a2a2a2",
              tickColor: "#a2a2a2"
            },
            axisY: {
              gridThickness: 0,
              includeZero: false,
              labelFontColor: "#717171",
              lineColor: "#a2a2a2",
              tickColor: "#a2a2a2",
              lineThickness: 1
            },
            data: []
          };

          newVSReturningVisitorsOptionsDiger.data = visitorsDataDiger["New vs Returning"];
          $("#chartContainerx").CanvasJSChart(newVSReturningVisitorsOptionsDiger);

          function visitorsChartDrilldownHandlerDiger(e) {
            e.chart.options = visitorsDrilldownedChartOptionsDiger;
            e.chart.options.data = visitorsDataDiger[e.dataPoint.name];
            e.chart.options.title = { text: e.dataPoint.name }
            e.chart.render();
            $("#backButtonx").toggleClass("invisible");
          }

          $("#backButtonx").click(function() { 
            $(this).toggleClass("invisible");
            newVSReturningVisitorsOptionsDiger.data = visitorsDataDiger["New vs Returning"];
            $("#chartContainerx").CanvasJSChart(newVSReturningVisitorsOptionsDiger);
          });

  },
      error: (da,dd) =>{
        alert("hata var");
      }


  });

  // AJAX SONU 
          
          


} 




  </script>


  <style>
  #backButton {
    border-radius: 4px;
    padding: 8px;
    border: none;
    font-size: 16px;
    background-color: #2eacd1;
    color: white;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
  }
  .invisible {
    display: none;
  }
</style>  

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

      <button type="button" class="navbar-toggle collapsed" aria-expanded="false" data-toggle="collapse" data-target="#myUser">
         <a href="#" onclick="return false;">
          <span class="glyphicon glyphicon-user" style="color:green;"></span>
        </a>
      </button>
      <a class="navbar-brand" href="">Yönetim#</a>
    </div>


    <div id="myUser">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Kayıt Ol</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Giriş</a></li>
          </ul>
   </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="">Anasayfa</a></li>
        <li><a href="">Blog</a></li>
        <li><a href="../forum/" class="mybtn btn-disabled">Forum</a></li>
      </ul>
      <form class="navbar-form navbar-right">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Aranılan .." name="search" autocomplete="off">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit" onclick="ara(); return false;">
              <i class="glyphicon glyphicon-search"></i>
            </button>

            <script>
              const ara = () =>{
                    $aranilan = $("input[name=search]").val();
                    if($aranilan.length > 0){
                    $.ajax({
                      type:"post",
                      url :"islemler.php",
                      data:{"tip":"ara","kelime":$aranilan},
                      success: (x) =>{
                        $myData = JSON.parse(x);

                        $("#uyelerData").html("");

                          $newData = "";
                          $myData.data.forEach((e)=>{
                              $newData += e.userConfirm > 0 ? "<tr class='success'>" : "<tr class='danger'>";
                              $newData += "<td>"+e.id+"</td>";
                              $newData += "<td>"+e.username+"</td>";
                              $newData += "<td>"+e.email+"</td>";
                              $newData += "<td>"+e.dateTime+"</td>";
                              $newData += "<td>"+(e.userConfirm == 0 ? "<img src='https://cdn1.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/thumbs-down-circle-red-512.png' height='30' width='30'":"<img src='http://www.ppm-construction.co.uk/wp-content/uploads/2016/03/thumbs-up.png' height='30' width='30'")+"</td>";
                              $newData += '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm" id="myModal" onclick="detail(this)" data-user="'+e.username+'">Detaylar</button></td>';
                              $newData += "</tr>";              

                          });

                          if($myData.data.length == 0 ){ 
                             $newData += "<tr class='danger'>";
                              $newData += "<td>0</td>";
                              $newData += "<td>NONE</td>";
                              $newData += "<td>NONE</td>";
                              $newData += "<td>NONE</td>";
                              $newData += "<td>NONE</td>";
                              $newData += "<td>NONE</td>";
                              $newData += "</tr>";   


                          }
                          
                          $("#uyelerData").html($newData);

                           $( "tbody#uyelerData tr" ).hide();
                           $( "tbody#uyelerData tr" ).first().show(500, function showNext() {
                              $( this ).next( "tbody#uyelerData tr" ).show( 100, showNext );
                           });

                      }


                    });
                  }//if
  
                };
            </script>

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
   <div class="col-md-3">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a data-toggle="tab" href="#home">İstatistikler</a></li>
        <li ><a data-toggle="tab" href="#menu1">Üyeler</a></li>
        <li><a data-toggle="tab" href="#menu2">Blog Detaylar</a></li>
        <li><a data-toggle="tab" href="#menu3">Blog Yorumları <span id="bcInfoSpan" class="badge"><?php echo $db->query("SELECT * FROM blogcomment WHERE commentShow = 0 && karantina = 0")->rowCount(); ?></span></a></li>
      </ul>
    </div>
    <div class="tab-content col-md-9">
          <div id="home" class="tab-pane fade in active">
                <div class="col-sm-12 col-md-12 col-lg-12">
                   <div id="chartWebTraffic" style="height: 250px; width: 100%;"></div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6">
                  <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                  <button class="btn invisible" id="backButton"> Back</button>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6">

                  <div id="chartContainerx" style="height: 300px; width: 100%;"></div>
                  <button class="btn invisible" id="backButtonx" style="top:10px;position: absolute;right: 30px;background-color:red;color:white;"> Back</button>
                </div>


                <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
                <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
          </div>
          <div id="menu1" class="tab-pane fade">


             <div class="table-responsive">          
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kullanıcı ADI</th>
                    <th>Email Adresi</th>
                    <th>Kayıt Tarihi</th>
                    <th>Onay</th>
                    <th>Detaylar</th>
                  </tr>
                </thead>
                <tbody id="uyelerData">
                 
                    <?php
                      if(!isset($_GET["search"])){
                      $data = $db->query("SELECT * FROM uyeler  ORDER BY id,userConfirm DESC LIMIT 0,9 ");
                      $say = 1;
                      if($data->rowCount()){
                        foreach($data as $dt){

                          echo $dt["userConfirm"] ? "<tr class='success'>" : "<tr class='danger'>";
                          echo "<td>".($dt["id"])."</td>";
                          echo "<td>".$dt["username"]."</td>";
                          echo "<td>".$dt["email"]."</td>";
                          $date = date('D M j',strtotime($dt["dateTime"]));
                          echo "<td>".$date."</td>";
                          echo "<td>".($dt["userConfirm"] == 0 ? "<img src='https://cdn1.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/thumbs-down-circle-red-512.png' height='30' width='30'":"<img src='http://www.ppm-construction.co.uk/wp-content/uploads/2016/03/thumbs-up.png' height='30' width='30'")."</td>";
                          echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm" id="myModal" onclick="detail(this)" data-user='.$dt["username"].'>Detaylar</button></td>';
                          echo "</tr>";
                        }
                      }
                    }else if(isset($_GET["search"])){

                      $ar = $_GET["search"];
                      $data = $db->query("SELECT * FROM uyeler  WHERE username LIKE '%$ar%' ");
                      $say = 1;
                      if($data->rowCount()){
                        foreach($data as $dt){

                          echo $dt["userConfirm"] ? "<tr class='success'>" : "<tr class='danger'>";
                          echo "<td>".($dt["id"])."</td>";
                          echo "<td>".$dt["username"]."</td>";
                          echo "<td>".$dt["email"]."</td>";
                          $date = date('D M j',strtotime($dt["dateTime"]));
                          echo "<td>".$date."</td>";
                          echo "<td>".($dt["userConfirm"] == 0 ? "<img src='https://cdn1.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/thumbs-down-circle-red-512.png' height='30' width='30'":"<img src='http://www.ppm-construction.co.uk/wp-content/uploads/2016/03/thumbs-up.png' height='30' width='30'")."</td>";
                          echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm" id="myModal" onclick="detail(this)" data-user='.$dt["username"].'>Detaylar</button></td>';
                          
                        }
                      }else{
                        echo "<tr class='danger'><td>NONE</td><td>NONE</td><td>NONE</td><td>NONE</td><td>NONE</td><td>NONE</td></tr>";
                      }
                    }
                    ?>
                </tbody>
              </table>
              <div id="listele">
                <nav aria-label="Page navigation example" style="float:right">
                    <ul class="pagination justify-content-end">
                      <li class="page-item disabled">
                        <a class="page-link" tabindex="-1">Previous</a>
                      </li>
                      <li class="page-item active"><a class="page-link" id="start" >1</a></li>
                      <li class="page-item"><a class="page-link"  onclick="al(this)">2</a></li>
                      <li class="page-item"><a class="page-link"  onclick="al(this)">3</a></li>
                      <li class="page-item disabled">
                        <a class="page-link">Next</a>
                      </li>
                    </ul>
                </nav>
              </div>

            </div>
            
          </div>
          <div id="menu2" class="tab-pane fade">
              <div class="col-sm-8 col-md-8 col-lg-8">
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filtrele
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a onclick="blogTip('yazar');return false;" style="cursor:pointer;">Blog Yazarı</a></li>
                    <li><a onclick="blogTip('kategori');return false;" style="cursor:pointer;">Blog Kategori</a></li>
                    <li><a onclick="blogTip('Goruntuleme');return false;" style="cursor:pointer;">Görüntüleme</a></li>
                    <li><a onclick="blogTip('Yayinlanan');return false;" style="cursor:pointer;">Yayınlanan</a></li>
                    <li><a onclick="blogTip('Tarih');return false;" style="cursor:pointer;">Yayın Tarihi</a></li>
                  </ul>
                  <button type="button" class="btn btn-success" id="filtreTag" style="">Filtre+baslik</button>

                  <button type="button" class="btn btn-primary" id="secimKaldir" style="visibility:hidden">Seçilenleri Kaldır</button> 
                  <button type="button" class="btn btn-danger" id="yayindanKaldir" style="visibility:hidden">Yayından Kaldır</button> 

                
                </div>

              </div>

              <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group" style="width:100px;float:left;margin-right:15px">
                    <select class="form-control" id="sel1">
                      <option selected>25</option>
                      <option>50</option>
                      <option>100</option>
                    </select>
                  </div>
                <button type="button" class="btn btn-info btn-md" id="blogPrev">
                  <span class="glyphicon glyphicon-backward"></span> 
                </button>
                <button type="button" class="btn btn-info btn-md" id="blogNext">
                  <span class="glyphicon glyphicon-forward"></span> 
                </button>
              </div>
              
              <div class="col-sm-11 col-md-11 col-lg-11">
                <div class="table-responsive">          
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Blog Fotoğrafı</th>
                      <th>Blog Başlığı</th>
                      <th>Blog Yazarı</th>
                      <th>Blog Kategori</th>
                      <th>Görüntülenme</th>
                      <th>Blog Yayın</th>
                    </tr>
                  </thead>
                  <tbody id="blogData">
                    <?php 
                    $blog = $db->query("SELECT * FROM blog ORDER BY id DESC");
                    if($blog->rowCount()){
                      foreach($blog as $bs){
                        ?>
                        <tr>
                          <td><div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" data-id="<?=$bs["subject_id"]?>" id="customCheck1" style="width:20px;height:20px;">
                              <label class="custom-control-label" for="customCheck1"></label>
                            </div>
                          </td>
                          <td><img src="../../image/subjectImage/<?=$bs['subject_image']?>" height="30" width="30"></td>
                          <td><?=$bs["subject_title"]?></td>
                          <td><?=$bs["subject_author"]?></td>
                          <td><?=$bs["subject_category"]?></td>
                          <td style="text-align:center;"><?=$bs["subject_view"]?></td>
                          <td><?=($bs["subject_show"] == 1 ? "YAYINDA" : "DEĞİL")?></td>
                        </tr>
                    <?php }
                    }

                    ?>

                    <script>
                      
                      $("#secimKaldir").click(() => {
                          $("input").removeAttr("checked");
                          $("#secimKaldir").css({"visibility":"hidden"});
                          $("#yayindanKaldir").css({"visibility":"hidden"});
                      });

                      $("#yayindanKaldir").click( () => {

                          yayindanKaldir();
                      });

                      const blogTip = (tip)=>{                   
                          $.ajax({
                                  type:"post",
                                  url : "islemler.php",
                                  data:{"tip":"blogFiltre","filtre":tip},
                                  success: (d) => {

                                    $("#filtreTag").html("Filtre+"+tip);
                                    if(d != "hata"){
                                       $("#blogData").html(d);
                                    }

                                  }
                                }); 
                      }

                      $(document).on("click","input[type=checkbox]",() =>{
                         if($("input:checked").length > 0 ){
                            $("#secimKaldir").css({"visibility":"inherit"});
                            $("#yayindanKaldir").css({"visibility":"inherit"});
                          }else{
                            $("#secimKaldir").css({"visibility":"hidden"});
                            $("#yayindanKaldir").css({"visibility":"hidden"});
                          }
                      });
                    </script>
                    
                  </tbody>
                </table>
              </div>
            </div>




          </div>
          <div id="menu3" class="tab-pane fade">
            <div class="table-responsive">          
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Konu Başlığı</th>
                    <th>Yazar</th>
                    <th>Yorumu</th>
                    <th>Tarihi</th>
                    <th>Detaylar</th>
                    
                  </tr>
                </thead>
                <tbody id="blogCommmentData">
                 
                  
                </tbody>
              </table>
              <script>

                blogYorumPanelUpdate(); // dataUpdate.js include
                
                const blogCommentDetail = (data) =>{

                  $id = data.getAttribute("data-id");
                  $.ajax({
                    type:"post",
                    url:"islemler.php",
                    data:{"tip":"blogCommentData","cid":$id},
                    success: (bc)=>{
                      var js = JSON.parse(bc);
                      $("#blogCommentData").html(js["comment"]);
                      $("#commentBaslik").html(" - "+js["konubaslik"]);


                      $("#blogCommentOnayla").click(() => {

                          $.ajax({
                            type:"post",
                            url:"islemler.php",
                            data:{"tip":"bcUp","uid":$id},
                            success: (cc) => {
                                
                               blogYorumPanelUpdate(); // dataUpdata.js include
                               successAnime();
                               
                            }

                          });

                      }); //  onayla

                      $("#blogCommentDelete").click(() => {
                          $.ajax({
                            type:"post",
                            url:"islemler.php",
                            data:{"tip":"bcDel","uid":$id},
                            success: (vv) => {
                                blogYorumPanelUpdate();
                                successAnime();
                            }

                          });


                      });// delete

                    }// SUCCESS

                  }); // AJAX
                    
                }// FUNCTİON
              </script>
            
                
          </div>
    </div>
   
    <div class="clearfix visible-lg"></div>
  </div>
</div>


<!-- ################################ MODAL ####################################- -->
<div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="color:red;opacity:.8;">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Bilgileri</h5>
      </div>
      <div class="modal-body" id="detailData">
        
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="detailSave">Kaydet</button>
      </div>
      
    </div>
  </div>
</div>
<!-- ################################# MODAL 2 ################################ -->

<div class="modal fade modal-sm2" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="color:red;opacity:.8;">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel">Blog Yorumları <span style="color:purple" id="commentBaslik"></span></h5>
      </div>
      <div class="modal-body" id="blogCommentData">
  
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="blogCommentDelete">Sil</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" id="blogCommentOnayla">Onayla</button>
      </div>
      
    </div>
  </div>
</div>
<!--  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ ALERT ###########################-->

<div class="alert alert-success" role="alert" style="position: fixed;bottom:35px;left:20px;display:none;" id="successAlert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
        <strong>İşleminiz gerçekleşmiştir.  </strong><span><br>
        <span id="alertIntervalClose">5</span> saniye sonra kapanacak.</span>
</div>


</body>
</html>


<script>getCookie("nightorday") == "night" ? nightMode():dayMode();</script>
<script>


const al = (data)=>{

  userListele(data); // include(dataupdate.js)

};


const listele = (konum) =>{

     return userSayfalama(konum);
}


const detail = (data) => {
  $user = data.getAttribute("data-user");
  userDetailvyz(); //dataUpdate.js include
 
}

</script>