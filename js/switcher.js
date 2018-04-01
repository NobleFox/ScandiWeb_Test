$(document).ready(function(){
 	$("select").change(function(){
        $(this).find("option:selected").each(function(){
        	$(".form-group.switched").hide();
            var gg = $(this).attr("value");
            if(gg){
            	$("." + gg).show(1000);
               	$(".form-group.switched").not("." + gg).hide();
            } else{
            	$(".form-group.switched").hide();
            }
        });
    }).change();
});