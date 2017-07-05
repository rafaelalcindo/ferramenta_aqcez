$(document).ready(function(){
       // alert('Recebendo Paramentro pela URL!');

        let = searchParams = new URLSearchParams(window.location.search);


        if(searchParams.has('demobilizacao')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(2)').attr('selected', true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(2)').val());
          
          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(2)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(2)').val());


        }else if(searchParams.has('turnkey')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(3)').attr('selected',true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(3)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(3)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(3)').val());

        }
        else if(searchParams.has('outros')){

          $('#sele_segmento option:selected').removeAttr('selected');
          $('#sele_segmento option:nth-child(4)').attr('selected',true);

          atualizarEstrutura( $('#sele_segmento option:nth-child(4)').val());

          // mobile size

          $('#sele_segmento2 option:selected').removeAttr('selected');
          $('#sele_segmento2 option:nth-child(4)').attr('selected', true);

          atualizarEstruMobile($('#sele_segmento2 option:nth-child(4)').val());

        }



        // Is it equal to "yes"?
        //let param = searchParams.get('sent')

          function atualizarEstrutura(segmento){

              $("#sele_estrutura").children().remove();

                  $.getJSON("json_file/outros.json",function(data){
                        $.each(data, function(key, val){

                            if(key == segmento && key != "desmobilizacao"){                            
                                $.each(val, function(key02,val02){
                                    $('#u261675').show();
                                    $("#sele_estrutura").show();
                                    $('#u261680-4').children().remove();
                                    $('#u261680-4').append('<p>QUAL É A ESTRUTURA?</p>');            
                                    var option = "<option value="+val02+">"+val02+"</option>";
                                    $("#sele_estrutura").append(option);
                                });
                            }else if(segmento == "outros" || segmento == "desmobilizacao"){
                                $("#sele_estrutura").hide();
                                $('#u261675').hide();
                                $('#u261680-4').children().remove();
                                $('#u261680-4').append('<p>Especifíque no Campo Abaixo</p>');
                            }

                        });
                    });
          } // Fim da Função.

          function atualizarEstruMobile(segmento){
            $("#sele_estrutura2").children().remove();

                  $.getJSON("json_file/outros.json",function(data){
                        $.each(data, function(key, val){

                            if(key == segmento && key != "desmobilizacao"){                            
                                $.each(val, function(key02,val02){
                                    $('#u261588').show();
                                    $("#sele_estrutura2").show();
                                    $('#u261568-4').children().remove();
                                    $('#u261568-4').append('<p>QUAL É A ESTRUTURA?</p>');                             
                                    var option = "<option value="+val02+">"+val02+"</option>";
                                    $("#sele_estrutura2").append(option);
                                });
                            }else if(segmento == "outros" || segmento == "desmobilizacao"){
                                $("#sele_estrutura2").hide();
                                $('#u261588').hide();
                                $('#u261568-4').children().remove();
                                $('#u261568-4').append('<p>Especifíque no Campo Abaixo</p>');
                            }

                        });
                    });

          }// fim da função tamanho mobile.

      });