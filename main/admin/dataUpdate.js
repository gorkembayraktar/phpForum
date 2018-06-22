function blogYorumPanelUpdate(){
	$.ajax({
		type:"post",
		url:"islemler.php",
		data:{"tip":"bcInterval"},
		success: (rc) => {

			var jsn = JSON.parse(rc);	
			$("#blogCommmentData").html(jsn["data"]);
			
			$("#bcInfoSpan").html(jsn["total"]);

            
		}
	});
}

function userDetailvyz(){

	 $.ajax({
    type:"post",
    url: "islemler.php",
    data:{"tip":"detay","user":$user},
    success: (rn) =>{
      $json = JSON.parse(rn);
      $("#detailData").html("");
           if($json.durum){

            $add = "";
            $add += '<div class="table-responsive">';
            $add += '<table class="table table-hover" id="myTable">';
            $add += '<img src="../../image/subjectImage/'+$json.data.profileImage+'" height="100" width="100%"  />';
            $add +=   '<tr>';
            $add +=        '<td>Ad:</td>';
            $add +=        '<td>'+$json.data.name+'</td>';
            $add +=      '</tr>';
            $add +=      '<tr>';
            $add +=        '<td>Soyad:</td>';
            $add +=        '<td>'+$json.data.surname+'</td>';
            $add +=      '</tr>';
            $add +=      '<tr>';
            $add +=        '<td>Cinsiyet:</td>';
            $add +=        '<td>'+($json.data.gender == 1 ? "ERKEK" : "KADIN")+'</td>';
            $add +=     '</tr>';
            $add +=      '<tr>';
            $add +=        '<td>Doğum Yeri:</td>';
            $add +=        '<td>'+$json.data.birthplace+'</td>';
            $add +=      '</tr>';
            $add +=     '<tr>';
            $add +=       '<td>Mesleği:</td>';
            $add +=        '<td>'+$json.data.job+'</td>';
            $add +=     '</tr>';
            $add +=     '<tr>';
            $add +=       '<td>Sosyal Medaya:</td>';
            $add +=        '<td>'+$json.data.socialMedia+'</td>';
            $add +=      '</tr>';
            $add +=      '<tr>';
            $add +=        '<td>Hakkında:</td>';
            $add +=        '<td>'+$json.data.about+'</td>';
            $add +=      '</tr>';
            $add +=    '</table>';
            $add +=  '</div>';

            $("#detailData").html($add);

             $( "table#myTable tr" ).hide();
             $( "table#myTable tr" ).first().show(300, function showNext() {
                 $( this ).next( "table#myTable tr" ).show( 200, showNext );
             });

          }else{
            $("#detailData").html("<b style='color:red'>detay odası açılmadı</b>");
          }
    
      
    }
  });

}

function userListele(data){
	
	$.ajax({
      type:"post",
      url : "islemler.php",
      data:{"tip":"uyeler","id":data.childNodes[0].nodeValue},
      success: (d) => {
        //alert(d)
        $data = JSON.parse(d);
        $("#uyelerData").html("");

        $newData = "";
        $data.data.forEach((e)=>{
            $newData += e.userConfirm > 0 ? "<tr class='success'>" : "<tr class='danger'>";
            $newData += "<td>"+e.id+"</td>";
            $newData += "<td>"+e.username+"</td>";
            $newData += "<td>"+e.email+"</td>";
            $newData += "<td>"+e.dateTime+"</td>";
            $newData += "<td>"+(e.userConfirm == 0 ? "<img src='https://cdn1.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/thumbs-down-circle-red-512.png' height='30' width='30'":"<img src='http://www.ppm-construction.co.uk/wp-content/uploads/2016/03/thumbs-up.png' height='30' width='30'")+"</td>";
            $newData += '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm" id="myModal" onclick="detail(this)" data-user="'+e.username+'">Detaylar</button></td>';
            $newData += "</tr>";              

        });
        $("#uyelerData").html($newData);
        
        if($data.sayfa <= 3){   
            $(".page-item").removeClass('active');
           
            $add = document.querySelectorAll(".page-item")[$data.sayfa];
            $class = "active";
            var arr = $add.className.split(' ');
            if(arr.indexOf($class) == -1){ $add.className += " " + $class; }

        }
        if($data.sayfa > 1 && $data.sayfa <= $data.maxsayfa){ $("#listele").html(listele($data.sayfa)); }
        
          $( "tbody#uyelerData" ).hide();
          $( "tbody#uyelerData" ).first().show(250);

      }
    });

}


function userSayfalama(konum){
		
		$liste = "";
        $liste += '<nav aria-label="Page navigation example" style="float:right;">';
        $liste +=   '<ul class="pagination justify-content-end" style="cursor:pointer">';
        $liste +=     '<li class="page-item disabled">';
        $liste +=           '<a class="page-link" tabindex="-1">Previous</a>';
        $liste +=     '</li>';

        konum > 3 && konum != 1 ? $liste += '<li class="page-item"><a class="page-link" onclick="al(this)">1</a></li>':'';
        konum > 3 && konum != 1 ?  $liste += '<li class="page-item"><a class="page-link">....</a></li>':'';


        $liste +=      '<li class="page-item"><a class="page-link" id="start" onclick="al(this)">'+(parseInt(konum)-1)+'</a></li>';
        $liste +=       '<li class="page-item active"><a class="page-link"  onclick="al(this)">'+(konum)+'</a></li>';
        $liste +=       '<li class="page-item"><a class="page-link"  onclick="al(this)">'+(parseInt(konum)+1 > $data.maxsayfa? "": parseInt(konum)+1)+'</a></li>';

        $liste +=  konum < $data.maxsayfa-1 ? '<li class="page-item"><a class="page-link">.....</a></li>' : '';


        $kontrol = konum >= 1 && (konum != $data.maxsayfa) && konum != $data.maxsayfa-1 ? '<li class="page-item"><a class="page-link"  onclick="al(this)">'+$data.maxsayfa+'</a></li>':'';
        $liste += $kontrol;

        $liste +=       '<li class="page-item disabled">';
        $liste +=            '<a class="page-link">Next</a>';
        $liste +=       '</li>';

       

        $liste +=      '</ul>';
        $liste += '</nav>';
        return $liste;
}

function successAnime(){
    $("#successAlert").css({"display":"inline-block"});
    var alertTime = 5;
    var inAl = setInterval(function(){ 
                    alertTime = alertTime -1;
                    $("#alertIntervalClose").html(alertTime); if(alertTime == 0){deleteInterval();} }, 1000);

    function deleteInterval(){
             clearInterval(inAl);
             $("#successAlert").css({"display":"none"});
             $("#alertIntervalClose").html("5");

            }

}

function yayindanKaldir(){
     if($("input[type=checkbox]").length > 0){
            $length = $("input:checked").length;
            var array = [];
            for(var i=0;i<$length;i++){
                                
                $kaldir = $("input:checked")[i].getAttribute("data-id");
                array.push($kaldir);
            }
                            
            $.ajax({
                type:"post",
                url: "islemler.php",
                data:{"tip":"yayindanKaldir",array:array},
                success: (gelen) =>{
                    if(gelen != false){
                        
                        blogUpdate();
                        successAnime();

                     }
                }

            });

     }
}

function blogUpdate(){
                        var yazar = "Yayinlanan";
                        $.ajax({
                            type:"post",
                            url : "islemler.php",
                            data:{"tip":"blogFiltre","filtre":yazar},
                            success: (d) => {

                                $("#filtreTag").html("Filtre+"+yazar);
                                if(d != "hata"){
                                    $("#blogData").html(d);
                                    $("#secimKaldir").css({"visibility":"hidden"});
                                     $("#yayindanKaldir").css({"visibility":"hidden"});
                                }

                             }
                        }); 
}
