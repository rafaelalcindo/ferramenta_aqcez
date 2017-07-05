$(document).ready(function(){

	 
	$('#btn_next01').click(function(){                
        $("#u258037").hide();
        $("#u258051").show(); 
    });

    $("#btn_preview02").click(function(){
        $("#u258051").hide();
        $("#u258037").show();                
    });

    $("#btn_next02").click(function(){
       $("#u258051").hide();
       $('#u258002').show();
    });

    $("#btn_preview03").click(function(){
       $('#u258002').hide();
       $("#u258051").show(); 
    });


});