$(function(){
	

	$.ajaxLoad = function(href){
			
			$.ajax({
			type:"post",
			url :"ajax.php",
			data:{"href":href},
			success:function(cevap){
				
				var veri  = JSON.parse(cevap); // verileri parçala encode et

				if(veri.hata === true){
					$('title').text("BLOG SCRİPTİ");
				}else{
					$('title').text(veri.title); // title cahange
					history.pushState('','',''+veri.link);//statu link compenent
				}
				
			}
			});

	}

	$("a[data-ajax=true]").click(function(){

		var href = $(this).attr('href');

		$.ajaxLoad(href);
		
		document.body.scrollTop = document.documentElement.scrollTop = 0;
		//location.reload();
		//return false;
	});


	var path = location.pathname.replace('/uygulamalar/myForum/main/','');
	if(path){
		$.ajaxLoad(path);
	}

});