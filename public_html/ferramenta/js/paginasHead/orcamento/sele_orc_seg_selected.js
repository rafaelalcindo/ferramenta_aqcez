$(document).ready(function(){
       // alert('Recebendo Paramentro pela URL!');

        let = searchParams = new URLSearchParams(window.location.search);


        if(searchParams.has('escritorio')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(2)').attr('selected', true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(2)').val());
          
          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(2)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(2)').val());


        }else if(searchParams.has('locais_comerciais')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(3)').attr('selected',true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(3)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(3)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(3)').val());

        }else if(searchParams.has('hoteis')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(4)').attr('selected',true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(4)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(4)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(4)').val());

        }else if(searchParams.has('clinicas')){
          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(5)').attr('selected',true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(5)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(5)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(5)').val());

        }else if(searchParams.has('restaurantes')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(6)').attr('selected',true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(6)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(6)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(6)').val());

        }else if(searchParams.has('escola')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(7)').attr('selected',true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(7)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(7)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(7)').val());

        }else if(searchParams.has('industrias')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(8)').attr('selected',true); 

          atualizarEstrutura( $('#sele_segmento option:nth-child(8)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(8)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(8)').val());

        }else if(searchParams.has('outros')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(9)').attr('selected',true); 

          atualizarEstrutura( $('#sele_segmento option:nth-child(9)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(9)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(9)').val());

        }


        // Is it equal to "yes"?
        //let param = searchParams.get('sent')

          function atualizarEstrutura(segmento){

              $("#sele_estrutura").children().remove();

                  $.getJSON("json_file/construcao.json",function(data){
                      $.each(data, function(key, val){

                          if(key == segmento){                            
                              $.each(val, function(key02,val02){
                                  $('#u251945').show();
                                  $("#sele_estrutura").show();
                                  $('#u251947-4').children().remove();
                                  $('#u251947-4').append('<p>QUAL É A ESTRUTURA?</p>');                           
                                  var option = "<option value="+val02+">"+val02+"</option>";
                                  $("#sele_estrutura").append(option);
                              });
                          }else if(segmento == "outros"){
                                $("#sele_estrutura").hide();
                                $('#u251945').hide();
                                $('#u251947-4').children().remove();
                                $('#u251947-4').append('<p>Especifíque no Campo Abaixo</p>');
                          }

                      });
                  });
          } // Fim da Função.

          function atualizarEstruMobile(segmento){
            $("#sele_estrutura2").children().remove();

                  $.getJSON("json_file/construcao.json",function(data){
                      $.each(data, function(key, val){

                          if(key == segmento){                            
                              $.each(val, function(key02,val02){
                                  $('#u251846').show();
                                  $("#sele_estrutura2").show();
                                  $('#u251819-4').children().remove();
                                  $('#u251819-4').append('<p>QUAL É A ESTRUTURA?</p>');                            
                                  var option = "<option value="+val02+">"+val02+"</option>";
                                  $("#sele_estrutura2").append(option);
                              });
                          }else if(segmento == "outros"){
                              $("#sele_estrutura2").hide();
                                $('#u251846').hide();
                                $('#u251819-4').children().remove();
                                $('#u251819-4').append('<p>Especifíque no Campo Abaixo</p>');
                          }

                      });
                  });

          }// fim da função tamanho mobile.

      });