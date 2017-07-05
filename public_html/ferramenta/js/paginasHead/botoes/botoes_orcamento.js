$(document).ready(function(){

	 
	$('#btn_next01').click(function(){                
        $("#u251935").hide();
        $("#u251873").show();
    });

    $("#btn_preview02").click(function(){
        $("#u251873").hide();
        $("#u251935").show();                
    });

    $("#btn_next02").click(function(){
       $("#u251873").hide();
       $('#u251949').show();
    });

    $("#btn_preview03").click(function(){
       $('#u251949').hide();
       $("#u251873").show(); 
    });


});