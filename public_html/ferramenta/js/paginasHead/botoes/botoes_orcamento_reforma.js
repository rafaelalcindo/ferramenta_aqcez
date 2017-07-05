$(document).ready(function(){

	 
	$('#btn_next01').click(function(){                
        $("#u255132").hide();
        $("#u255146").show();
    });

    $("#btn_preview02").click(function(){
        $("#u255146").hide();
        $("#u255132").show();                
    });

    $("#btn_next02").click(function(){
       $("#u255146").hide();
       $('#u255097').show();
    });

    $("#btn_preview03").click(function(){
       $('#u255097').hide();
       $("#u255146").show(); 
    });


});