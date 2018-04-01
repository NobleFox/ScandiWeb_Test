$(document).ready(function(){
	$("form").hide();
		$open_add = false;
    	$("#add_btn").click(function(){
    		if($open_add){
        		$("form").hide(1000);
           		$open_add = false;
        	}else{
        		$("form").show(1000);
        		$(".fluid-container.List").hide(1000);
           		$open_list = false;
           		$open_add = true;
           		$('html, body').animate({
           			scrollTop:$('form').offset().top
           		},1000);
        }
    });
	$(".fluid-container.List").hide();
	$open_list = false;
	$("#show_btn").click(function(){
		if($open_list){
   			$(".fluid-container.List").hide(1000);
       		$open_list = false;
   		}else{
       			$(".fluid-container.List").show(1000);
       			$("form").hide(1000);
           		$open_add = false;
           		$open_list = true;
           		$('html, body').animate({
           			scrollTop:$('.fluid-container.List').offset().top
           		},1000);
       		}
   		});
});